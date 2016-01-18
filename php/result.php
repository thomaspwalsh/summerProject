<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>search</title>
		
		<link rel="stylesheet" type="text/css" href="../cssStyle/style.css"/>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
		
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>	
    </head>
    
    <body>
		<?php
			$command = "C:\Python27\python.exe ../api/analyse.py \"". $_POST["keyword"]."\" ". $_POST["number"];
			$pid = popen( $command,"r");
			while( !feof( $pid ) ){
				echo fread($pid, 256);
				echo "\r\n";
				flush();
				ob_flush();
				usleep(100000);
			}
			pclose($pid);
		?>
			
		<?php include_once("connect.php"); ?>
			
		<?php include_once("graph.php"); ?>
			
		<?php include_once("pie.php"); ?>
		
		
	
	
    	<div id="wrapper">
    	
			<div id="header">
				<?php include_once("header.php"); ?>
			</div>
			  
			<div id="search_bar">
				<?php include_once("searchBar.php"); ?>
			</div>
			  
			<h1 align="center">Sentiment Analysis of Query</h1>
			<div id="line_graph" style="width: 900px; height: 500px;"></div>
				
			<h1 align="center">Pie Chart of Query</h1>
			<div id="pie_chart" style="width: 900px; height: 500px;"></div>
				
				
			<?php include_once("table.php"); ?>
           
		</div>
    </body>
</html>