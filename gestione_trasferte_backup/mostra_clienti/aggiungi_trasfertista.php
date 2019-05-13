<?php
		session_start();
        if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
          header("location: https://gestionetrasferteeffeg.altervista.org/");
	    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        $admin=mysqli_real_escape_string($conn,$_GET["admin"]);
        $query="INSERT INTO trasfertista (nome, cognome, mail,Password, telefono, amministratore, eliminato) ";
        $query.="VALUES ('" . mysqli_real_escape_string($conn,$_GET["nome"]) . "', '" . mysqli_real_escape_string($conn,$_GET["cognome"]) . "','" . mysqli_real_escape_string($conn,$_GET["mail"]) . "','" . hash('sha256', mysqli_real_escape_string($conn,$_GET['pass'])) . "','" . mysqli_real_escape_string($conn,$_GET["telefono"]) . "'," . $admin . " , 0 );";
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