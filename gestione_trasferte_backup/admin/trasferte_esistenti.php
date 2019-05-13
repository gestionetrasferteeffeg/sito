<?php
$query="SELECT giorno, ragione_sociale, FSE, valore, ore, trasferta.id_cliente, trasferta.id_dati, trasferta.id 
FROM trasferta 
INNER JOIN cliente ON id_cliente = cliente.id
INNER JOIN DATI on id_dati = DATI.id
WHERE giorno BETWEEN '" . $_GET["giorno_i"] . "' AND '" . $_GET["giorno_f"] . "'
AND id_trasfertista = " . $_GET["id_t"] . "
ORDER BY giorno;";
$conn = new mysqli("127.0.0.1", "gestionetrasferteeffeg", "", "my_gestionetrasferteeffeg");
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