<?php	
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
    	header("location: https://gestionetrasferteeffeg.altervista.org/");
?>
<html>
<head>
  	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script type="text/javascript">
    var admin=1;
    function aggiungi()
    {
    	var nome=$("#nome").val();
        var cognome=$("#cognome").val();
        var mail=$("#mail").val();
        var pass=$("#pass").val();
        var telefono=$("#tel").val();
        //alert("/mostra_clienti/aggiungi_trasfertista.php?nome="+nome+"&cognome="+cognome+"&mail="+mail+"&pass="+pass+"&telefono="+telefono+"&admin="+admin);
    	$.get("/mostra_clienti/aggiungi_trasfertista.php?nome="+nome+"&cognome="+cognome+"&mail="+mail+"&pass="+pass+"&telefono="+telefono+"&admin="+admin, function( data, status) {
          if(data=="success")
          {
          	$("#modale").css('display','block');
			setTimeout(location.reload.bind(location), 1000);
          }
          else
           	alert("error");
        });
    }
    $(document).ready(function(){
        $("#admin").click(function(){
        	admin=1;
        });
        $("#tras").click(function(){
        	admin=0;
        });
    });
    </script>
</head>
<body>
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-poll-h"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Gestione Trasferte</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Generale</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Gestione Trasferte
      </div>

      <!-- Nav Item - Aggiungi Trasferta -->
      <li class="nav-item">
        <a class="nav-link" href="aggiungi.php">
          <i class="fas fa-plus"></i>
          <span>Aggiungi Trasferta</span></a>
      </li>

      <!-- Nav Item - Elimina trasferta -->
      <li class="nav-item">
        <a class="nav-link" href="elimina.php">
          <i class="fas fa-minus"></i>
          <span>Elimina Trasferta</span></a>
      </li>

	  <!-- Nav Item - Modifica trasferta -->
      <li class="nav-item">
        <a class="nav-link" href="modifica.php">
          <i class="fas fa-fw fa-cog"></i>
          <span>Modifica Trasferta</span></a>
      </li>

	  <!-- Divider -->
      <hr class="sidebar-divider">
      
	  <!-- Heading -->
      <div class="sidebar-heading">
        Gestione Trasfertisti
      </div>		
        
      <!-- Nav Item - Aggiungi Trasfertista -->
      <li class="nav-item active">
        <a class="nav-link" href="aggiungi_trasfertista.php">
          <i class="fas fa-plus"></i>
          <span>Aggiungi Trasfertista</span></a>
      </li>

      <!-- Nav Item - Elimina trasfertista -->
      <li class="nav-item">
        <a class="nav-link" href="elimina_trasfertista.php">
          <i class="fas fa-minus"></i>
          <span>Elimina Trasfertista</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!-- Heading -->
      <div class="sidebar-heading">
        Gestione Clienti
      </div>
      
      <!-- Nav Item - Aggiungi Cliente -->
      <li class="nav-item">
        <a class="nav-link" href="aggiungi_cliente.php">
          <i class="fas fa-plus"></i>
          <span>Aggiungi Cliente</span></a>
      </li>

      <!-- Nav Item - Elimina Cliente -->
      <li class="nav-item">
        <a class="nav-link" href="elimina_cliente.php">
          <i class="fas fa-minus"></i>
          <span>Elimina Cliente</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!-- Heading -->
      <div class="sidebar-heading">
        Gestione FSE
      </div>
      
      <!-- Nav Item - Aggiungi Cliente -->
      <li class="nav-item">
        <a class="nav-link" href="aggiungi_fse.php">
          <i class="fas fa-plus"></i>
          <span>Aggiungi FSE</span></a>
      </li>

      <!-- Nav Item - Elimina Cliente -->
      <li class="nav-item">
        <a class="nav-link" href="elimina_fse.php">
          <i class="fas fa-minus"></i>
          <span>Elimina FSE</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider">
      
      <!-- Heading -->
      <div class="sidebar-heading">
        Altro
      </div>

      <!-- Nav Item - Riepilogo -->
      <li class="nav-item">
        <a class="nav-link" href="riepilogo.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Riepilogo</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      
            <!-- Heading -->
      <div class="sidebar-heading">
        Logout
      </div>
      
      <!-- Nav Item - logout -->
      <li class="nav-item">
        <a class="nav-link" href="/logout.php">
          <i class="fas fa-sign-out-alt"></i>
          <span>Vuoi Uscire?</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      
      </ul>
      <div style="margin:20px;width:100%">
      	<div class="alert alert-success" id="modale" style="display:none">
           <strong> Trasfertista aggiunto correttamente</strong>
        </div>
      	<h1 style="text-align:center">Aggiungi Trasfertista</h1>
      	<div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" class="form-control" id="nome">
        </div>
        <div class="form-group">
          <label for="cognome">Cognome:</label>
          <input type="text" class="form-control" id="cognome">
        </div>
        <div class="form-group">
          <label for="mail">Mail:</label>
          <input type="email" class="form-control" id="mail">
        </div>
        <div class="form-group">
          <label for="pass">Password:</label>
          <input type="password" class="form-control" id="pass">
        </div>
        <div class="form-group">
          <label for="tel">Telefono:</label>
          <input type="text" class="form-control" id="tel">
        </div>
        <div class="row">
          <div class="form-check form-check-inline" style="width:30%;margin-left:30%">
            <input name="gruppo2" type="radio" id="admin" checked>
            <label for="radio4">Amministratore</label>
          </div>
          <div class="form-check form-check-inline" style="width:30%">
            <input name="gruppo2" type="radio" id="tras">
            <label for="radio5">Trasfertista</label>
          </div>
        </div>
        <p style="text-align:center;">
        	<button type="button" class="btn btn-success" onclick="aggiungi();">Aggiungi</button>
    	</p>
    </div>
</div>
</body>
</html>