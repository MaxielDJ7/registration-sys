
<?php

error_reporting(E_ALL);


$host="sql1.njit.edu";
$database="mid6";
$username="mid6";
$pass="ydkFcXjX";

try{
    $dbh=new PDO("mysql:host=$host;dbname=$database",$username, $pass);
   	echo "Connection Successful";
   	
   	$stmt= $this->db->prepare("Select * FROM `canToo` ");
	$stmt->execute();
	
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() == 1)
    {
    	$resultArray = array();
    	$tempArray = array();
    	
    	while($row = $result->fetchAll(PDO::FETCH_OBJ)
    	{
    		$tempArray= $row;
    		array_push($resultArray, $tempArray);
    	}  	
    	
    	echo json_encode($resultArray);
    }
  }
  catch(PDOException $e){
    print "Connection Error: ". $e->getMessage();
    die();
  }


?>
 