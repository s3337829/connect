<?php

require_once('db.php');
if ($dbconn = mysql_connect(DB_HOST, DB_USER, DB_PW)) 
	{
	if (!mysql_select_db(DB_NAME, $dbconn)) 
		{
		echo mysql_error() . "\n";
		exit;
		}
	//echo 'Connected to database ' . DB_NAME . "\n";
	
	}
else
	{
	echo "Cannot connect";
	exit;
	}



?>
<html>
	<head><link rel="stylesheet" type="text/css" href="vino.css" /></head>
	<body>
		<div id="vino">
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
						$result=mysql_query("SELECT * FROM region");
						while($row = mysql_fetch_array($result))
							{
							?> <option value="<?php echo $row['region_name'];?>"><?php echo $row['region_name'];?></option><?php
							}
						?>
	
						</select>
					</td>
				</tr>
				<tr>
					<td><label id="gv_lbl">Grape Variety:</label></td>
					<td>
						<select name="gv_ddl">
						<?php
						$result=mysql_query("SELECT * FROM grape_variety");
						while($row = mysql_fetch_array($result))
							{
							?> <option value="<?php echo $row['variety_id'];?>"><?php echo $row['variety'];?></option><?php
							}
						?>
	
						</select>
					</td>
				</tr>
				<tr>
					<td><label id="yrange_lbl">Year Range:</label></td>
					<td>
						<select name="yrangelower_ddl">
						<?php
						$result=mysql_query("SELECT MIN(year) FROM wine");
						$rslt=mysql_query("SELECT MAX(year) AS max FROM wine");
						$row = mysql_fetch_array($result);
						$i=$row[0];
						$row = mysql_fetch_array($rslt);
						for($j=$i;$j<($row[0]-1);$j++)
							{
							?> <option value='<?php echo $j ?>'><?php echo $j ?></option><?php
							}
						?>
						</select> -
						<select name="yrangeupper_ddl">
						<?php
						for($j=($i+1);$j<($row[0]+1);$j++)
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
	</body>
</html>