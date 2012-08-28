<?php
session_start();
define('DB_HOST', 'yallara.cs.rmit.edu.au');
	define('DB_PORT', '58772'); 
	define('DB_NAME', 'winestore');
	define('DB_USER', 's3337829');
	define('DB_PW', 'thumba');
	try 
		{
		$db = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,DB_USER,DB_PW);


?>
<html>
	<head><link rel="stylesheet" type="text/css" href="vino.css" /></head>
	<body>
		<div id="vino">
			<?php
			if(isset($_GET['flag']))
			{
				$_SESSION['flg']=$_GET['flag'];
			}
			else if(isset($_SESSION['flg']))
			{
			}
			else
			{?>
			<a href="index.php?flag=1">Start Session</a> <?php
			}
			 ?>
			<form action="answer.php" method="get" id="wine_frm">
			<table>
				<tr>
					<td><label id="wine_lbl">Wine Name:</label></td>
					<td><input type="text" name="wine" /></td>
				</tr>
				<tr>
					<td><label id="winery_lbl">Winery:</label></td>
					<td><input type="text" name="winery" /></td>
				</tr>
				<tr>
					<td><label id="region_lbl">Region:</label></td>
					<td>
						<select name="region_ddl">
						<?php
						$sql="SELECT * FROM region";
						foreach ($db->query($sql) as $row)
							{
							?> <option value="<?php echo $row['region_name'];?>"><?php echo $row['region_name'];?></option><?php
							}?>
	
						</select>
					</td>
				</tr>
				<tr>
					<td><label id="gv_lbl">Grape Variety:</label></td>
					<td>
						<select name="gv_ddl">
						<?php
						$sql="SELECT * FROM grape_variety";
						foreach ($db->query($sql) as $row)
							{
							?> <option value="<?php echo $row['variety_id'];?>"><?php echo $row['variety'];?></option><?php
							}?>
	
						</select>
					</td>
				</tr>
				<tr>
					<td><label id="yrange_lbl">Year Range:</label></td>
					<td>
						<select name="yrangelower_ddl">
						<?php
						$sql="SELECT MIN(year) FROM wine";
						foreach ($db->query($sql) as $row)
							{
							$i=$row[0];
							}
						$sql="SELECT MAX(year) AS max FROM wine";
						foreach ($db->query($sql) as $row)
							{
							$k=$row[0];
							}
						
						for($j=$i;$j<($k-1);$j++)
							{
							?> <option value='<?php echo $j ?>'><?php echo $j ?></option><?php
							}
						?>
						</select> -
						<select name="yrangeupper_ddl">
						<?php
						for($j=($i+1);$j<($k+1);$j++)
							{
							?> <option value='<?php echo $j ?>'><?php echo $j ?></option><?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><label id="wstock_lbl">Min no. of wines(stock):</label></td>
					<td><input type="text" name="wstock" /></td>
				</tr>
				<tr>
					<td><label id="wordered_lbl">Min no. of wines(ordered):</label></td>
					<td><input type="text" name="wordered" /></td>
				</tr>
				<tr>
					<td><label id="prange_lbl">Price Range:</label></td>
					<td><input type="text" name="prmin" /> - <input type="text" name="prmax" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" id=sbmt /><td>
				</tr>
			</table>
			</form>
		</div>
<?php   }catch(PDOException $e) {
echo $e->getMessage();
} ?>
	</body>
</html>
