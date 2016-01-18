<div class="container">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Number</th>
				<th>Tweeter</th>
				<th>Tweet</th>
				<th>DateTime</th>
				<th>Sentiment Type</th>
				<th>Sentiment Score</th>
			</tr>
		</thead>
				
		<tbody>
					
			<?php
				$result = mysqli_query($con, "SELECT auto_increment, username, tweet, dateTime, sentiment_type, sentiment_score FROM sentiment");
				$color = null;
						
				while ($trow = mysqli_fetch_array($result)){
					if($trow['sentiment_type']=='positive'){
						$color='#1E90FF';
						}
					else if($trow['sentiment_type']=='negative'){
						$color='#FF0000';
						}
					else{
						$color='#FFA500';
						}
					echo "<tr style ='background:" .$color."'>";
					echo '<td>' . $trow['auto_increment'] . '</td>';
					echo '<td>' . $trow['username'] . '</td>';
					echo '<td>' . $trow['tweet'] . '</td>';
					echo '<td>' . $trow['dateTime'] . '</td>';
					echo '<td>' . $trow['sentiment_type'] . '</td>';
					echo '<td>' . $trow['sentiment_score'] . '</td>';
					}
				$result = mysqli_query($con, "TRUNCATE TABLE sentiment");
				mysqli_close($con);
			?>
						
					
		</tbody>
		<tbody></tbody>
	</table>
</div>