<?php
		session_start();
        if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
            header("location: https://gestionetrasferteeffeg.altervista.org/");
	    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        $query="SELECT id,ragione_sociale FROM cliente WHERE eliminato=0";
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