<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
		var data = google.visualization.arrayToDataTable([
		<?php
			echo (implode(",",$lineGraph));
		?>
        ]);

		var options = {
			titlePosition: 'none',
			curveType: 'function'
			};

		var chart = new google.visualization.LineChart(document.getElementById('line_graph'));

		chart.draw(data, options);
		}
</script>