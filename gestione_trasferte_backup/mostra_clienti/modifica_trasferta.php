<?php
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
    	header("location: https://gestionetrasferteeffeg.altervista.org/");
	$giorno=mysqli_real_escape_string($conn,$_GET["giorno"]);
	$valore=mysqli_real_escape_string($conn,$_GET["valore"]);
	$ora=mysqli_real_escape_string($conn,$_GET["ore"]);
    $id_trasfertista=mysqli_real_escape_string($conn,$_GET["id_trasfertista"]);
	$id_cliente = mysqli_real_escape_string($conn,$_GET["id_cliente"]);
    $id_fse=mysqli_real_escape_string($conn,$_GET["dati"]);
    $id=mysqli_real_escape_string($conn,$_GET["id_tra"]);
    $query="UPDATE trasferta
    SET giorno='" . $giorno . "', valore = '" . $valore . "', ore = " . $ora . ", id_trasfertista = " . $id_trasfertista . ", id_cliente = " . $id_cliente . ", id_dati = " . $id_fse . "
    WHERE Id=" . $id . ";";
    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
    if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
    if (!$ris = mysqli_query($conn, $query))
    {
       echo "Error: " . $query . "<br>" . $conn->error;
    }
    else
    	echo "success";
    echo $query;
    $conn->close();
?>