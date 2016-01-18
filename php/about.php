<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>about</title>
		<link rel="stylesheet" type="text/css" href="../cssStyle/style.css"/>
    </head>
    
    <body>
    	<div id="wrapper">
    	
			<div id="header">
				<?php include_once("header.php"); ?>
			</div>
          
			<div id="main">
          		<h1>Software Engineering Project</h1>
                <p>This project involved creating code to perform sentiment analysis on tweets when given a specific query. The aim for the
                project was to pull these tweets into a database, and have the sentiment analysis performed to see if they
                were positive, negative or neutral. A score was also given to give an idea how positive or negative each tweet was.
    			The tweets were then line graphed to give a visual view of the sentiment on the query a user inputs. A Pie Chart was also used
				to show the percentage of Positive to Negative to Neutral.</p>
                <p> The language used to perform these analysis was python using AlchemyAPI and Google charts to graph the results. After
                each analysis was performed the database was truncated as the twitter terms and conditions does not allow a tweet to be 
                stored for more than twenty-four hours. I used bootstrap to help display the tweets collected in a neat format.</p><br>
                
                <a href="../index.php">Homepage</a>
			</div>    
		</div>
    </body>
</html>