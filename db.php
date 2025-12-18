<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "unity_care_backend";

$conn = new mysqli($host, $user, $pass, $db);

if (!$conn) {
    die("Erreur connexion DB");
}
$sqlPatients = "SELECT * FROM patients";
$resultPatients = $conn->query($sqlPatients);

$sqlMedecins="SELECT*FROM medecins";
$resultMedecins=$conn->query($sqlMedecins);

$sqlDepartement="SELECT*FROM departements";
$resultDepartement=$conn->query($sqlDepartement);


