#!/usr/bin/env python

#	Copyright 2013 AlchemyAPI
#
#   Licensed under the Apache License, Version 2.0 (the "License");
#   you may not use this file except in compliance with the License.
#   You may obtain a copy of the License at
#
#       http://www.apache.org/licenses/LICENSE-2.0
#
#   Unless required by applicable law or agreed to in writing, software
#   distributed under the License is distributed on an "AS IS" BASIS,
#   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
#   See the License for the specific language governing permissions and
#   limitations under the License.


import sys
import json
import base64
import urllib2
import urllib
import MySQLdb
from alchemyapi import AlchemyAPI

alchemyapi = AlchemyAPI()




def oauth():
	

	try:
		consumer_key = 'weZJfUzpk8zARbqR8LfNWLFrv'
		consumer_secret = 'krIrBEovOm9sG94qQ8CzGXFYZHPNup2RhBQSe5ONiilYZuFHVt'

		
		encoded = base64.b64encode(consumer_key + ':' + consumer_secret)
		url = 'https://api.twitter.com/oauth2/token'
		params = { 'grant_type':'client_credentials' }
		headers = { 'Authorization':'Basic ' + encoded }

		
		request = urllib2.Request(url, urllib.urlencode(params), headers)
		response = json.loads(urllib2.urlopen(request).read())

		
		auth = {}
		auth['access_token'] = response['access_token']
		auth['token_type'] = response['token_type']
		
		
		return auth
	except Exception as e:
		
		sys.exit()


def search(auth, query, number_of_tweets):
	

	
	url = 'https://api.twitter.com/1.1/search/tweets.json'
	headers = { 'Authorization': auth['token_type'] + ' ' + auth['access_token'] }
	tweets = []
	MAX_PAGE_SIZE = 100
	counter = 0
	next_results = ''
	
	
	while True: 
		count = max(MAX_PAGE_SIZE,int(number_of_tweets) - counter)

		
		if next_results:
			request = urllib2.Request(url + next_results, headers=headers)
		else:
			params = { 'q':query, 'lang':'en','count':count }
			request = urllib2.Request(url + '?' + urllib.urlencode(params), headers=headers)

		
		data = json.loads(urllib2.urlopen(request).read())

		
		for status in data['statuses']:
			text = status['text'].encode('utf-8')
			
			
			if text.find('RT ') != 0:
				
				tweet = {}
				tweet['text'] = text
				tweet['screen_name'] = status['user']['screen_name']
				tweet['created_at'] = status['created_at']
				tweets.append(tweet)
				counter += 1
				
				
				if counter >= number_of_tweets:
					
					return tweets

		
		if 'next_results' in data['search_metadata']:
			next_results = data['search_metadata']['next_results']
		else:
			return tweets


def process(query, in_queue, out_queue):
	
	while True:
		
		tweet = in_queue.get()	
		
		
		tweet['sentiment'] = {}

		try:
			
			response = alchemyapi.entities('text',tweet['text'], { 'sentiment': 1 })
			if response['status'] == 'OK':
				for entity in response['entities']:
					
					if entity['text'] == query:
						tweet['sentiment']['entity'] = {}
						tweet['sentiment']['entity']['type'] = entity['sentiment']['type']
						
						
						if 'score' in entity['sentiment']:
							tweet['sentiment']['entity']['score'] = entity['sentiment']['score']
						else:
							tweet['sentiment']['entity']['score'] = 0  
						
						
						break

			
			response = alchemyapi.sentiment('text',tweet['text'])

			if response['status'] == 'OK':
				tweet['sentiment']['doc'] = {}
				tweet['sentiment']['doc']['type'] = response['docSentiment']['type']
				
				
				if 'score' in response['docSentiment']:
					tweet['sentiment']['doc']['score'] = response['docSentiment']['score']
				else:
					tweet['sentiment']['doc']['score'] = 0  
			
			
			out_queue.put(tweet)
		
		except Exception as e:
			pass
			
		
		in_queue.task_done()



def analyze(tweets, query):
	
	import Queue
	import threading

	
	CONCURRENCY_LIMIT = 5

	
	in_queue = Queue.Queue()
	out_queue = Queue.Queue()

	
	for tweet in tweets:
		in_queue.put(tweet)
	
	threads = []
	for x in xrange(CONCURRENCY_LIMIT):
		t = threading.Thread(target=process, args=(query, in_queue, out_queue))
		t.daemon = True
		threads.append(t)
		t.start()

	
	while True:
		
		sys.stdout.flush()

		
		if in_queue.empty():
			break
				
		check = False	
		for t in threads:
			if t.isAlive():
				check = True
				break

		if not check:
			break
		
	
	output = []
	while not out_queue.empty():
		output.append(out_queue.get())

	
	return output


def output(tweets):
	
	if len(tweets) == 0:
	
		sys.exit()
			
		
	
def stats(tweets):
	
 	data = {}
	data['doc'] = {}
	data['doc']['positive'] = 0
	data['doc']['negative'] = 0
	data['doc']['neutral'] = 0
	data['doc']['total'] = 0
	
	data['entity'] = {}
	data['entity']['positive'] = 0
	data['entity']['negative'] = 0
	data['entity']['neutral'] = 0
	data['entity']['total'] = 0
	
	for tweet in tweets:
		if 'entity' in tweet['sentiment']:
			data['entity'][tweet['sentiment']['entity']['type']] += 1
			data['entity']['total'] += 1

		if 'doc' in tweet['sentiment']:
			data['doc'][tweet['sentiment']['doc']['type']] += 1
			data['doc']['total'] += 1

	
	if data['doc']['total'] == 0 and data['entity']['total'] == 0:
		
		sys.exit()

	


def main(query, count):

	auth = oauth()
	tweets = search(auth, query, count)
	tweets = analyze(tweets, query)
	output(tweets)
	stats(tweets)
	
	db = MySQLdb.connect(host = "localhost",
						user = "root",
						passwd = "",
						db = "project"
						)
	db.set_character_set('utf8')
	cursor = db.cursor()
	
	for tweet in tweets:
		query = sys.argv[1]
		input = sys.argv[2]
		cursor.execute(("INSERT INTO sentiment(query, username, tweet, dateTime, sentiment_type, sentiment_score) VALUES (%s, %s, %s, %s, %s, %s)"), (query, tweet['screen_name'], tweet['text'], tweet['created_at'], tweet['sentiment']['doc']['type'], tweet['sentiment']['doc']['score']))
		db.commit()
	
	db.close()
	

	





if not len(sys.argv) == 3:
	
	sys.exit()
main(sys.argv[1], int(sys.argv[2]))