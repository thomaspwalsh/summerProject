<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = google.visualization.arrayToDataTable([
		['Type', 'Number'],
		['Positive', <?php echo implode(';', $positive); ?>],
		['Negative', <?php echo implode(';', $negative); ?>],
		['Neutral', <?php echo implode(';', $neutral); ?>]
		]);

		var options = {
			titlePosition: 'none',
			};

		var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
		
		chart.draw(data, options);
		}
</script>