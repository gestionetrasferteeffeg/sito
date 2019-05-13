<?php
		session_start();
        if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
            header("location: https://gestionetrasferteeffeg.altervista.org/");
	    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
        if ($conn->connect_error)
            die("Connection failed: " . $conn->connect_error);
        $query="SELECT giorno,id_trasfertista FROM `trasferta` WHERE id_trasfertista=" . mysqli_real_escape_string($conn,$_GET["id_trasfertista"]) . "&& giorno='" . mysqli_real_escape_string($conn,$_GET["giorno"]) . "';";
        $ris = mysqli_query($conn, $query);
        $num_rows = mysqli_num_rows($ris);
        //echo $num_rows;
        $query='INSERT INTO trasferta (giorno,valore,ore,id_trasfertista,id_cliente,id_dati) VALUES ("' . $_GET["giorno"] . '","' . $_GET["valore"] . '",' . $_GET["ore"] . ',' . $_GET["id_trasfertista"] . ',' . $_GET["id_cliente"] . ',' . $_GET["dati"] . ')';
        //echo $query;
        if($_GET["valore"]=="S"|| $_GET["valore"]=="TT"|| $_GET["valore"]=="T"|| $_GET["valore"]=="V"|| $_GET["valore"]=="R"|| $_GET["valore"]=="S")
        	if($_GET["ore"]>=0 && $_GET["ore"] < 25)
            	if(is_numeric($_GET["id_trasfertista"]) && is_numeric($_GET["id_cliente"]) && is_numeric($_GET["dati"]))
                	if($num_rows==0)
                      if (!$ris = mysqli_query($conn, $query))
                      {
                            echo "Error: " . $query . "<br>" . $conn->error;
                      }
                      else
                      {
                          echo("success");
                      }
                   	else
                       echo "data già presente";
                   else
                 	  echo "Completa tutti i campi";
                else
                 	echo "Completa tutti i campi";
           else
              echo "Completa tutti i campi";
  $conn->close();
?>