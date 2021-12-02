<?php

$checkExist = "SELECT * FROM Config";
$checkExistConfig  = mysqli_query($conn, $checkExist);
	$resultsFromDBConfig = mysqli_fetch_assoc($checkExistConfig);
	if ($resultsFromDBConfig['Exist'] == 1) {
		$_SESSION['Exist']	= $resultsFromDBConfig['Exist'];
	}



if(!isset($_SESSION['Exist'])) {

// tworzenie tabel

$dbCreateTabPatients = "CREATE TABLE patients(
    patientId INT NOT NULL PRIMARY KEY,
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30) NOT NULL,
	city VARCHAR(30) NOT NULL,
    createdAt VARCHAR(30) NOT NULL
)";

$dbCreateTabPatient2practitioner = "CREATE TABLE patient2practitioner(
    patientId INT NOT NULL,
	practitionerId INT NOT NULL
)";

$dbCreateTabPractitioners = "CREATE TABLE practitioners(
    practitionerId INT NOT NULL PRIMARY KEY,
    specialization VARCHAR(30) NOT NULL
)";

$dbCreateTabVistis = "CREATE TABLE visits(
    visitId INT NOT NULL PRIMARY KEY,
    practitionerId INT NOT NULL,
	patientId INT NOT NULL
)";

mysqli_query($conn, $dbCreateTabPatients);
mysqli_query($conn, $dbCreateTabPatient2practitioner);
mysqli_query($conn, $dbCreateTabPractitioners);
mysqli_query($conn, $dbCreateTabVistis);

// import danych

if (($plik = fopen("import/patients.csv", "r")) !== FALSE)	{

  while (($data = fgetcsv($plik, 1000, ";")) !== FALSE) {

		$insertToSql = "INSERT into patients (`patientId`, `firstName`, `lastName`, `city`, `createdAt`) VALUES ('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."','".$data[4]."')";
		
		mysqli_query($conn, $insertToSql);
		}

	fclose($plik);
}

if (($plik = fopen("import/patient2practitioner.csv", "r")) !== FALSE)	{

  while (($data = fgetcsv($plik, 1000, ";")) !== FALSE) {
		
		$insertToSql = "INSERT into patient2practitioner (`patientId`, `practitionerId`) VALUES ('".$data[0]."', '".$data[1]."')";

		mysqli_query($conn, $insertToSql);
		}

	fclose($plik);
}


if (($plik = fopen("import/practitioners.csv", "r")) !== FALSE)	{

  while (($data = fgetcsv($plik, 1000, ";")) !== FALSE) {
		
		$insertToSql = "INSERT into practitioners (`practitionerId`, `specialization`) VALUES ('".$data[0]."', '".$data[1]."')";
		
		mysqli_query($conn, $insertToSql);
		}

	fclose($plik);
}


if (($plik = fopen("import/visits.csv", "r")) !== FALSE)	{

  while (($data = fgetcsv($plik, 1000, ";")) !== FALSE) {
		
		$insertToSql = "INSERT into visits (`visitId`, `practitionerId`,`patientId` ) VALUES ('".$data[0]."', '".$data[1]."', '".$data[2]."')";
		
		mysqli_query($conn, $insertToSql);
		}

	fclose($plik);
}


	$dbCreateTabConfig = "CREATE TABLE Config ( `Exist` INT NOT NULL DEFAULT '1' , `wasCreateTime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
)";
	mysqli_query($conn,
		$dbCreateTabConfig
	);


	$insertToSql = "INSERT INTO Config (`Exist`, `wasCreateTime`) VALUES ('1', current_timestamp())";
	mysqli_query($conn, $insertToSql);

	$_SESSION['Exist'] = 1;

}

?>