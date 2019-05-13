<?php
		session_start();
		if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
    		header("location: https://gestionetrasferteeffeg.altervista.org/");
	    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        $query="INSERT INTO DATI (FSE, V, T, S, R, TS, TR, TF, TT, id_cliente, eliminato) ";
        $query.="VALUES ('" . mysqli_real_escape_string($conn,$_GET["fse"]) . "', " . mysqli_real_escape_string($conn,$_GET["v"]) . "," . mysqli_real_escape_string($conn,$_GET["t"]) . "," . mysqli_real_escape_string($conn,$_GET["s"]) . "," . mysqli_real_escape_string($conn,$_GET["r"]) . "," . mysqli_real_escape_string($conn,$_GET["ts"]) . "," . mysqli_real_escape_string($conn,$_GET["tr"]) . "," . mysqli_real_escape_string($conn,$_GET["tf"]) . "," . mysqli_real_escape_string($conn,$_GET["tt"]) . "," . mysqli_real_escape_string($conn,$_GET["cliente"]) . ",0);";
              //  echo $query;
        if(!isset($_GET["cliente"]))
        	echo "Cliente non selezionato";
        else
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