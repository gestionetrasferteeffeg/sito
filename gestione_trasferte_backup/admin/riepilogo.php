<!DOCTYPE html>
<html>
<head>
<?php session_start(); ?>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <style>
      .clicca:hover
      {
          cursor:pointer;
      }
  </style> 
  <script type="text/javascript">
  $(document).ready(function(){
  
    $("#azienda_click").click(function(){
		var quale_div=document.getElementById("clienti_mostra");
		var array_javascript;
		$.ajax({
		  url: "/mostra_clienti/carica_clienti.php",
		  type: 'GET',
		  async: false,
		  cache: false,
		  timeout: 30000,
		  error: function(){
			  return true;
		  },
		  success: function(data){ 
			  array_javascript=data;
		  }
		});
		var stringa_add="";
		if(array_javascript.lenght != 0)
		  for(var i=0;i<array_javascript.length;i++)
			stringa_add+='<a class="dropdown-item" value="' + array_javascript[i][0] + '" id="list_' + i + '" onclick="aggiungi_testo('+ i + ')" href="#">' + array_javascript[i][1] + "</a>";
		quale_div.innerHTML=stringa_add;
    });
	
	});
	function aggiungi_testo(val)
    {
		var num = document.getElementById("list_"+val);
		var testo = num.innerHTML;
		var id = num.getAttribute("value");
		var butt = document.getElementById("azienda_click");
		butt.innerHTML=testo;
		butt.value=id;
		$('#fse').removeAttr('disabled');
		$("#fse").html("FSE");
		$('#fse').removeAttr('value');
		}
		function aggiungi_trasf(val)
		{
		var num = document.getElementById("trasf_"+val);
		var testo = num.innerHTML;
		var id = num.getAttribute("value");
		var butt = document.getElementById("trasfertista");
		butt.innerHTML=testo;
		butt.value=id;
    }
    
	</script>
</head>
<body>
<html>
<head>
<style>
      .clicca:hover
      {
          cursor:pointer;
      }
  </style> 
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
      <li class="nav-item">
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
      <li class="nav-item active">
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
	<div style="width:100%;">
      	<h1 style="text-align: center;">Riepilogo Trasferte</h1>
        <br/>
		Seleziona Cliente:
		<div class="btn-group dropright show">
			<button type="button" id="azienda_click" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clienti</button>
			<div class="dropdown-menu" id="clienti_mostra" style="height: auto; max-height: 200px; overflow-x: hidden; position: absolute; transform: translate3d(79px, 0px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="right-start">
			</div>
		</div>
		<div>
        <br/>
			<table class="table">
				<tr>
				<?php
					echo('<td>Nome Trasfertista</td>');
					echo '<td>T</td>';
					echo '<td>S</td>';
					echo '<td>V</td>';
					echo '<td>R</td>';
					echo '<td>TT</td>';
					echo '<td>TS</td>';
					echo '<td>TR</td>';
					echo '<td>TF</td>';
				  
					echo('</tr>');
					require_once('../funzioni_connessione.php');
					$query="SELECT trasferta.id_trasfertista as idtras, trasferta.valore as val, trasferta.id_dati as dati, SUM(trasferta.ore) as totale FROM trasferta WHERE MONTH(giorno)=4 AND id_cliente=1 GROUP BY id_trasfertista, valore, id_dati";
					$conn = connettidb();
					$result=$conn->query($query);
					
					$primo=true;
					/*while($row = $result->fetch_assoc())
					{
					}*/
				?>
			</table>
		</div>
	</div>
</div>
</body>
</html>
</body>
</html>