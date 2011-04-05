<?php 
//SANITIZE INPUTS!
class Inputer{
	
	/*Inserts a new alcohol entry into the database.
	 * Takes an array of length 12 that has:
	 * (name, drink, volume, brand, did, alcohol_content, country, calories, type, year, flavor, rating)
	 */
	function insertAlcohol($input){
		if(count($input)!=12){
			echo("Invalid input!");
			return false;
		}
		require_once("Validator");
		$val=new Validator();
		if(!$val->valid($input['name'],1,100)){
			echo("Invalid name!<br>");
			return false;
		}
		if(!$val->valid($input['drink'],1,10)){
			echo("Invalid drink!<br>");
			return false;
		}
		if(!is_numeric($input['volume'])){
			echo("Invalid volume!<br>");
			return false;
		}
		if(!$val->valid($input['brand'],1,100)){
			echo("Invalid brand!<br>");
			return false;
		}
		if(!is_numeric($input['did'])){
			echo("Invalid did!<br>");
			return false;
		}
		if(!is_numeric($input['alcohol_content'])){
			echo("Invalid alcohol_content!<br>");
			return false;
		}
		if(!$val->valid($input['country'],1,100)){
			echo("Invalid country!<br>");
			return false;
		}
		if(!is_numeric($input['calories'])){
			echo("Invalid calories!<br>");
			return false;
		}
		if(!$val->valid($input['type'],1,100)){
			echo("Invalid type!<br>");
			return false;
		}
		if(!is_numeric($input['year'])){
			echo("Invalid year!<br>");
			return false;
		}
		if(!$val->valid($input['flavor'],1,100)){
			echo("Invalid flavor!<br>");
			return false;
		}
		if(!is_numeric($input['rating'])){
			echo("Invalid rating!<br>");
			return false;
		}
		
		$query="
		SELECT a.did
		FROM alcohol a
		WHERE a.did=".$input['did'];

		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS);

		if(isset($row[0])){
			echo("Alcohol already exists!");
			return false;
		}
		
		$query="INSERT INTO alcohol VALUES('" . $input['name'] . "','" . $input['drink'] . "'," . $input['volume']
			 . ",'" . $input['brand'] . "'," . $input['did'] . "," . $input['alcohol_content'] . ",'"
			 . $input['country'] . "'," . $input['calories'] . ",'" . $input['type'] . "'," . $input['year']
			 . ",'" . $input['flavor'] . "'," . $input['rating'] . ")";
		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		
		return true;
	}
	
	/*Inserts a new sold_at entry into the database.
	 * Takes an array of length 7 that has:
	 * (location, store_name, store_hours, store_type, did, quantity, price)
	 */
	function insertSold_At($input){
		if(count($input)!=7){
			echo("Invalid input!");
			return false;
		}
		
		require_once("Validator");
		$val=new Validator();
		if(!$val->valid($input['location'],1,200)){
			echo("Invalid location!<br>");
			return false;
		}
		if(!$val->valid($input['store_name'],1,100)){
			echo("Invalid store_name!<br>");
			return false;
		}
		if(!$val->valid($input['store_hours'],1,200)){
			echo("Invalid store_hours!<br>");
			return false;
		}
		if(!$val->valid($input['store_type'],1,100)){
			echo("Invalid store_type!<br>");
			return false;
		}
		if(!is_numeric($input['did'])){
			echo("Invalid did!<br>");
			return false;
		}
		if(!is_numeric($input['quantity'])){
			echo("Invalid quantity!<br>");
			return false;
		}
		if(!is_numeric($input['price'])){
			echo("Invalid price!<br>");
			return false;
		}
		
		$query="
		SELECT s.did
		FROM sold_at s
		WHERE s.location='".$input['location']."' and s.store_name='".$input['store_name']
		."' and s.price=".$input['price']." and s.did=".$input['did'];

		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS);

		if(isset($row[0])){
			echo("sold_at entry already exists!");
			return false;
		}
		
		$query="INSERT INTO sold_at VALUES('" . $input['location'] . "','" . $input['store_name'] . "','"
		. $input['store_hours'] . "','" . $input['store_type'] . "'," . $input['did'] . "," . $input['quantity'] . ","
			 . $input['price'] . ")";
		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		
		return true;
	}
	
	/*Inserts a new favorite entry into the database.
	 * Takes an array of length 2 that has:
	 * (username, did)
	 */
	function insertFavorite($input){
		if(count($input)!=2){
			echo("Invalid input!");
			return false;
		}
		
		require_once("Validator");
		$val=new Validator();
		if(!$val->validUsername($input['username'])){
			echo("Invalid username!<br>");
			return false;
		}
		if(!is_numeric($input['did'])){
			echo("Invalid did!<br>");
			return false;
		}
		
		$query="
		SELECT f.did
		FROM favorite f
		WHERE f.username='".$input['username']."' and f.did=".$input['did'];

		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS);

		if(isset($row[0])){
			echo("favorite entry already exists!");
			return false;
		}
		
		$query="INSERT INTO favorite VALUES('" . $input['username'] . "'," . $input['did'] . ")";
		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		
		return true;
	}
	
	/*Inserts a new bought entry into the database.
	 * Takes an array of length 3 that has:
	 * (username, did, quantity)
	 */
	function insertBought($input){
		echo("Starting bought insert!<br>");
		if(count($input)!=3){
			echo("Invalid input!");
			return false;
		}
		
		require_once("Validator");
		$val=new Validator();
		if(!$val->validUsername($input['username'])){
			echo("Invalid username!<br>");
			return false;
		}
		if(!is_numeric($input['did'])){
			echo("Invalid did!<br>");
			return false;
		}
		if(!is_numeric($input['quantity'])){
			echo("Invalid quantity!<br>");
			return false;
		}
		
		$query="
		SELECT b.did
		FROM bought b
		WHERE b.username='".$input['username']."' and b.did=".$input['did'] . " and b.time=sysdate";

		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS);

		if(isset($row[0])){
			echo("bought entry already exists!");
			return false;
		}
		
		$query="INSERT INTO bought VALUES('" . $input['username'] . "'," . $input['did'] . "," . $input['quantity']
		. ", sysdate)";
		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		
		return true;
	}
	
	/*Inserts a new write_comment entry into the database.
	 * Takes an array of length 3 that has:
	 * (text, username, did)
	 */
	function insertWrite_Comment($input){
		echo("Starting bought insert!<br>");
		if(count($input)!=3){
			echo("Invalid input!");
			return false;
		}
		
		require_once("Validator");
		$val=new Validator();
		if(!$val->validUsername($input['username'])){
			echo("Invalid username!<br>");
			return false;
		}
		
		$query="
		SELECT wc.did
		FROM write_comment wc
		WHERE wc.username='".$input['username']."' and wc.did=".$input['did'] . " and wc.time=sysdate";

		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		$row = oci_fetch_array($stid,OCI_BOTH+OCI_RETURN_NULLS);

		if(isset($row[0])){
			echo("bought entry already exists!");
			return false;
		}
		
		$query="INSERT INTO write_comment VALUES('" . $input['text'] . "',sysdate,'" . $input['username'] . "',"
		. $input['did'] . ")";
		echo("Query: ".$query."<br>");
		$conn = oci_connect("der2127", "c00kie5", "w4111c.cs.columbia.edu:1521/adb");
		$stid = oci_parse($conn, $query);
		$err=oci_execute($stid);
		
		return true;
	}
}

?>