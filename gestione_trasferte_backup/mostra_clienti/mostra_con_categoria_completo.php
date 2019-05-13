<?php
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
    	header("location: https://gestionetrasferteeffeg.altervista.org/");
	$conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
	$valore = $_GET["tipo"];
    $testo = $_GET["testo"];
    $query="SELECT trasferta.id, trasfertista.id, nome, cognome, giorno, valore, ore, trasferta.id_cliente, ragione_sociale, trasferta.id_dati, FSE
            FROM trasferta 
            INNER JOIN cliente ON id_cliente = cliente.id
            INNER JOIN trasfertista ON id_trasfertista = trasfertista.id 
            INNER JOIN DATI on id_dati = DATI.id
            WHERE";
    switch ($valore)
    {
    	case 0: $query.= " nome = '" .  $testo . "'";break;
        case 1: $query.= " cognome = '" . $testo . "'";break;
    	case 2: $query.= " giorno = '" . $testo . "'";break;
        case 3: $query.= " ragione_sociale = '" . $testo . "'";break;
    }
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