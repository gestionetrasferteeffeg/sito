<?php
  if(isset($_POST['mail']) && isset($_POST['password'])){
    session_start();
    $ma=$_POST["mail"];
    $mail=mysql_real_escape_string($ma);
    $pa=$_POST["password"];
    $password=mysql_real_escape_string($pa);
    $query="SELECT id, nome, cognome, amministratore FROM trasfertista WHERE mail='" . $mail . "' AND Password = SHA2('" . $password . "',256);";
    $con=mysqli_connect("localhost","gestionetrasferteeffeg","","my_gestionetrasferteeffeg");
    $ris = mysqli_query($con,$query);
    mysqli_close($con);
    if (mysqli_num_rows($ris) == 1)
    {
        $row=mysqli_fetch_array($ris,MYSQLI_ASSOC);
        $_SESSION["id"]=$row["id"];
        echo "<script>alert('" + $_SESSION["id"] + "')</script>";
        $_SESSION["nome"]=$row["nome"];
        $_SESSION["cognome"]=$row["cognome"];
        $_SESSION["admin"]=$row["amministratore"];
        if($_SESSION["admin"]==1)
        	header("location: https://gestionetrasferteeffeg.altervista.org/admin/index.php");
        else
        	header("location: https://gestionetrasferteeffeg.altervista.org/user/index.php");
    }
  	else
  	{
    	header("location: https://gestionetrasferteeffeg.altervista.org?access=true");
  	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EFFEGI service group</title>
    <!-- Bootstrap link -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Icon -->
    <link rel="stylesheet" href="/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
        <section class="login">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="login-form" class="login-form">
                        <h2 style="font-size:35px;" class="form-title">EFFEGI Service Group</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="mail" id="mail" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                        	<p style="text-align:center;">
                            	<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Sign In"/>
                            </p>
                        </div>
                        <div class="form-group" style="display:none" id="err_div">
                        	<div style="text-align:center;font-size:23px;font-family: Helvetica Neue,Helvetica,Arial,sans-serif" class="text-danger" id="error">dfs</div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
</body>
</html>
<?php
if($_GET["access"]==true)
{
	?>
    <script>
    var div_est = document.getElementById("err_div");
    div_est.style.display="block";
	var div = document.getElementById("error");
    div.innerHTML="DATI INSERITI ERRATI";
    </script>
    <?php
}
?>
