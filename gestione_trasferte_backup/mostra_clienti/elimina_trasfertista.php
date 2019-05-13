<?php
		session_start();
        if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
            header("location: https://gestionetrasferteeffeg.altervista.org/");
	    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        $id=$_GET["i"];
        $query="UPDATE trasfertista SET eliminato = 1 WHERE id = " . mysqli_real_escape_string($conn,$id) . ";";
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