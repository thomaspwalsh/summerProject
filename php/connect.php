<?php
	$con = mysqli_connect("localhost", "root", "", "project");
			
	$result = mysqli_query($con, "SELECT * FROM sentiment");
	$lineGraph[] = "['auto_increment', 'sentiment_score']";
			
			
	while($row = mysqli_fetch_array($result)) {
				
		$auto_increment = $row["auto_increment"];
		$sentiment_score = $row["sentiment_score"];
		$lineGraph[] = "['" .$auto_increment. "'," .$sentiment_score."]";
		}
			
			
	$positive_result = mysqli_query($con, "SELECT COUNT(sentiment_type) FROM sentiment WHERE sentiment_type='positive'");
	$negative_result = mysqli_query($con, "SELECT COUNT(sentiment_type) FROM sentiment WHERE sentiment_type='negative'");
	$neutral_result = mysqli_query($con, "SELECT COUNT(sentiment_type) FROM sentiment WHERE sentiment_type='neutral'");
	$positive = mysqli_fetch_row($positive_result);
	$negative = mysqli_fetch_row($negative_result);
	$neutral = mysqli_fetch_row($neutral_result);
			
?>