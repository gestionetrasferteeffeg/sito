<?php
		session_start();
		if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
    	header("location: https://gestionetrasferteeffeg.altervista.org/");
	    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        
        $query="INSERT INTO cliente (ragione_sociale, paga_ore, eliminato ) ";
        $query.="VALUES ('" . mysqli_real_escape_string($conn, $_GET["rag"]) . "', " . mysqli_real_escape_string($conn,$_GET["ore"]) . "," . 0 . ");";
              //  echo $query;
        if (!$ris = mysqli_query($conn, $query))
        {
              echo "Error: " . $query . "<br>" . $conn->error;
        }
        else
        {
        	 echo "success";
        }
        $conn->close();
?>