<?php
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
    	header("location: https://gestionetrasferteeffeg.altervista.org/");
	$valore = mysqli_real_escape_string($conn,$_GET["tipo"]);
    $testo = mysqli_real_escape_string($conn,$_GET["testo"]);
    $query="SELECT trasferta.id, nome, cognome, giorno, valore, ore, ragione_sociale
            FROM trasferta 
            INNER JOIN cliente ON id_cliente = cliente.id
            INNER JOIN trasfertista ON id_trasfertista = trasfertista.id
            WHERE ";
    switch ($valore)
    {
    	case 0: $query.= " nome = '" .  $testo . "'";break;
        case 1: $query.= " cognome = '" . $testo . "'";break;
    	case 2: $query.= " giorno = '" . $testo . "'";break;
        case 3: $query.= " ragione_sociale = '" . $testo . "'";break;
    }
    $conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
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