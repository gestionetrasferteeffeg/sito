<?
	function connettidb()
    {
        $servername = "localhost";
        $username = "gestionetrasferteeffeg";
        $password = "AhDVBghmcz7t";
        $nome="my_gestionetrasferteeffeg";

        $conn = new mysqli($servername, $username, $password,$nome);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        return($conn);
    }
 
 	function chiudi_conn($conn)
    {
    	mysqli_close($conn);
    }
  
  //echo "<p>connesso</p>";
?>