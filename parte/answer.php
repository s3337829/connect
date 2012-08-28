<?php
session_start();
$tmparray=array();

?>
<html>
	<head><link rel="stylesheet" type="text/css" href="vino.css" /></head>
	<body>
<?php

if(isset($_GET))
	{
	
	if(isset($_SESSION['flg']))
	{?>
	<a href="index.php?flag=1">Home</a><br />
	<a href="session.php?flag=1">End Session</a>
	<a href="session.php?tweet=1">Tweet</a>
<?php }
	define('DB_HOST', 'yallara.cs.rmit.edu.au');
	define('DB_PORT', '58772'); 
	define('DB_NAME', 'winestore');
	define('DB_USER', 's3337829');
	define('DB_PW', 'thumba');
	try 
		{
		$db = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,DB_USER,DB_PW);
	
	$wine=$_GET["wine"];
	if(empty($wine))
		{
		$wine="";
		}

	$winery=$_GET["winery"];
	if(empty($winery))
		{
		$winery="";
		}
	
	$region=$_GET["region_ddl"];
	if($region=="All")
		{
		$region="";
		}
	
	$gv=$_GET["gv_ddl"];
	
	$yrangelower=$_GET["yrangelower_ddl"];
	
	$yrangeupper=$_GET["yrangeupper_ddl"];
	
	$prmin=$_GET["prmin"];
	if(empty($_GET["prmin"]))
		{
		$prmin=0;
		}
	
	$prmax=$_GET["prmax"];
	if(empty($_GET["prmax"]))
		{
		$prmax=100;
		}
	
	$wstock=$_GET["wstock"];
	if(empty($_GET["wstock"]))
		{
		$wstock=0;
		}
	
	$wordered=$_GET["wordered"];
	if(empty($_GET["wordered"]))
		{
		$wordered=0;
		}
	
	if($yrangelower>=$yrangeupper)
		{
		echo "Invalid range of year";
		exit;
		}
	
	if($prmin>=$prmax)
		{
		echo "Invalid price range";
		exit;
		}
	
	echo "<div id='vino'>";
	echo "<table border='1'>";
	echo "<tr><th>Wine</th><th>Wine Variety</th><th>Year</th><th>Winery</th><th>Region</th><th>Cost</th><th>Stock</th><th>Total Sold</th><th>Total Revenue</th></tr>";
	$sql="SELECT wine.wine_name AS w1, wine.year AS w2, winery.winery_name AS w3, region.region_name AS w4,  inventory.cost AS w5, inventory.on_hand AS w6,grape_variety.variety AS w7, temp.qty AS w8, (temp.qty*temp.price) AS w9   FROM wine,winery,region,inventory,wine_variety,grape_variety,(SELECT items.wine_id AS wine_id,sum(items.qty) AS qty,items.price AS price FROM items,orders WHERE items.cust_id=orders.cust_id AND items.order_id=orders.order_id GROUP BY wine_id) AS temp WHERE wine.winery_id=winery.winery_id AND region.region_id=winery.region_id AND wine.wine_id=inventory.wine_id AND wine.wine_id=wine_variety.wine_id AND wine_variety.variety_id=grape_variety.variety_id AND wine.wine_id=temp.wine_id AND (wine.wine_name LIKE '".$wine."%' OR wine.wine_name='".$wine."') AND (winery.winery_name LIKE '".$winery."%' OR winery.winery_name='".$winery."') AND (wine.year BETWEEN ".$yrangelower." AND ".$yrangeupper.") AND (region.region_name LIKE '".$region."%' OR region.region_name='".$region."') AND (inventory.cost >= ".$prmin." AND inventory.cost <=".$prmax.") AND (grape_variety.variety_id=".$gv.") AND (inventory.on_hand >= ".$wstock.") AND (temp.qty >= ".$wordered.");";
	foreach ($db->query($sql) as $row)
		{
		echo "<tr><td>".$row['w1']."</td><td>".$row['w7']."</td><td>".$row['w2']."</td><td>".$row['w3']."</td><td>".$row['w4']."</td><td>"."$".$row['w5']."</td><td>".$row['w6']."</td><td>".$row['w8']."</td><td>".$row['w9']."</td></tr>";
		array_push($tmparray,$row['w1']);
		}
	$db=null;
	if(!isset($_SESSION['wine']))
		$_SESSION['wine']=$tmparray;
	else
		$_SESSION['wine']=array_unique(array_merge($_SESSION['wine'], $tmparray));
	echo "</table>";
	echo "</div>";
	} catch(PDOException $e) {
echo $e->getMessage();
}
}

?>

	</body>
</html>