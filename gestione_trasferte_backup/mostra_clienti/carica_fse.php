<?php
		session_start();
        if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
            header("location: https://gestionetrasferteeffeg.altervista.org/");
	    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        $query="SELECT DATI.id, fse FROM cliente INNER JOIN DATI ON cliente.id = DATI.id_cliente WHERE cliente.id = '" . mysqli_real_escape_string($conn,$_GET["id"]) . "' AND DATI.eliminato=0;";
        //echo $query;
        if (!$ris = mysqli_query($conn, $query))
        {
              echo "Error: " . $query . "<br>" . $conn->error;
        }
        else
        {
        	header("Content-Type: application/json; charset=UTF-8");
            echo(json_encode($ris->fetch_all()));
        }
        $conn->close();
?>