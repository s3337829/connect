<?php
session_start();
include 'tweet.php';
 if(isset($_GET['tweet']))
	{
	$str="";
	$temp=$_SESSION['wine'];
	foreach($temp as $tmp)
	{
		$str=$str.$tmp.", ";
	}
	
	$statusMessage = 'Wine added: '.$str. ' -> ' . $message;
	$tweet->post('statuses/update', array('status' => $statusMessage));
	?><a href="index.php?flag=1">Home</a><br />
	<a href="session.php?flag=1">End Session</a><?php
	}
else if((isset($_GET['flag'])))
{
	$temp=$_SESSION['wine'];
	foreach($temp as $tmp)
	{
		echo $tmp."<br />";
	}

	session_destroy();
}
?>