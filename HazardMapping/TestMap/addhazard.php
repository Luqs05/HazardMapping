<?php
	session_start();
	$host        = "host=url";
	$port        = "port=5432";
	$dbname      = "dbname=devgroup";
	$credentials = "user=user password=password";

	$db = pg_connect("$host $port $dbname $credentials");

	$varlat = pg_escape_string($_POST['lat']);
	$varlng = pg_escape_string($_POST['lng']);
	$ecplus_fie = pg_escape_string($_POST['ecplus_fie']);

	$query1 = "INSERT INTO hazards(ecplus_fie, fieldwor_8, fieldwor_9, geom) VALUES ('$ecplus_fie', '$varlat', '$varlng', ST_GeomFromText('POINT($varlng $varlat)', 4326))";
	//$query1 = "INSERT INTO hazards(ecplus_fie, fieldwor_8, fieldwor_9, geom) VALUES ('$ecplus_fie', '$varlat', '$varlng', ST_SetSrid(ST_MakePoint('$varlng', '$varlat'), 32735));
	$result = pg_query($query1);
  if (!$result) {
  		$errormessage = pg_last_error();
      echo $query1;
      exit();
  }
  printf ("These values were inserted into the database - %s %s %s", $ecplus_fie, $varlat, $varlng);
  pg_close();

	header("Location: index.html");
	exit;

?>

