<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN''http://www.w3.org/TR/html4/loose.dtd'>
<?php
include('headerfooter.php');
include('AccountManager.php');
include('Retriever.php');
$hf = new HeaderFooter();
$am = new AccountManager();
$ret = new Retriever();
$hf->header();
//check if user is logged in

if(isset($_COOKIE['user'])){
	$user = $_COOKIE['user'];
	echo "<table align='center'><tr><td><h2>".$user."'s Alcohols</h2></td></tr></table></br>
		<table align='center'>
			<tr>
				<td colspan='7'><h3>Favorite</h3></td>
			</tr>
			<tr>
				<th><b>Name</b></th>
				<th><b>Drink</b></th>
				<th><b>Volume</b></th>
				<th><b>Rating</b></th>
				<th><b>Brand</b></th>
				<th><b>Alcohol Content</b></th>
				<th><b>Country</b></th>
			</tr>";
	$data = $ret->getFavorite($user);
	$rows=0;
	foreach($data as $r){
		$rows++;
		if($rows%2==0)
			echo "<tr class='d0'>";
		else
			echo "<tr class='d1'>";
		foreach($r as $c){
			echo "<td>".$c."</td>";
		}
		echo "</tr>";
	}	
	echo "</table></br>";
	echo "<table align='center'>
			<tr>
				<td colspan='13'><h3>Bought</h3></td>
			</tr>
			<tr>
				<th><b>Name</b></th>
				<th><b>Drink</b></th>
				<th><b>Volume</b></th>
				<th><b>Rating</b></th>
				<th><b>Brand</b></th>
				<th><b>Alcohol Content</b></th>
				<th><b>Country</b></th>
				<th><b>Quantity</b></th>
				<th><b>Price</b></th>
				<th><b>Store Name</b></th>
				<th><b>Store Type</b></th>
				<th><b>Location</b></th>
				<th><b>Time</b></th>
			</tr>";
	$data = $ret->getBought($user);
	$rows=0;
	foreach($data as $r){
		$rows++;
		if($rows%2==0)
			echo "<tr class='d0'>";
		else
			echo "<tr class='d1'>";
		foreach($r as $c){
			echo "<td>".$c."</td>";
		}
		echo "</tr>";
	}	
	echo "</table></br>
		<table align='center'>
			<tr>
				<td><a href='passc.php'>Change Password</a></td>
			</tr>";
	if($am->isAdmin($user)){
		echo "<tr>
				<td><a href='add.php'>Add to database</a></td>
			</tr>";
		
	}
	echo "<tr>
			<td><a href='logout.php'>Logout</a></td>
		</tr>";
}
else
	echo "<table align='center'>
		<tr>
			<td><h2>Login Fail!</h2></td>
		</tr>
		<tr>
			<td>You gots to <a href='login.php'>login</a> first!</td>
		</tr>";
echo "</table>";
$hf->footer();


?>