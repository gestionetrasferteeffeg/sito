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

  <style>
      .prim
      a_c{
      	width:20%;
      }
      .clicca:hover
      {
          cursor:pointer;
      }
  </style>
  <script type="text/javascript">
  var valore=0;
  var testo="";
  	$(document).ready(function(){
  		$("#nome").click(function(){
        	valore=0;
        });
        $("#cognome").click(function(){
        	valore=1;
        });
        $("#data").click(function(){
        	valore=2;
        });
        $("#cliente").click(function(){
        	valore=3;
        });
        $("#cerca").click(function(){
        	var record;
            var stringa;
        	testo=$("#valore").val();
            //alert(valore + " " + testo);
            quale_div=$("#aggiungi_tab");
            $.get("/mostra_clienti/mostra_con_categoria_completo.php?tipo=" + valore + "&testo=" + testo, function(data, status){
              if(status=="success")
              {
              	record=data;
                stringa='<table class="table table-striped" width="100%">';
                stringa+='<thead><tr><th scope="col">Nome</th><th scope="col">Cognome</th><th scope="col">Giorno</th><th scope="col">Valore</th><th scope="col">Numero Ore</th><th scope="col">Ragione Sociale</th><th scope="col">Elimina</th></tr></thead>';
				stringa+='<tbody>';
                for(var i=0;i<record.length;i++)
            	{
            		stringa+='<tr>';
                    stringa+='<td>' + record[i][1] + '</td>';
                    stringa+='<td>' + record[i][2] + '</td>';
                    stringa+='<td>' + record[i][3] + '</td>';
                    stringa+='<td>' + record[i][4] + '</td>';
                    stringa+='<td>' + record[i][5] + '</td>';
                    stringa+='<td>' + record[i][6] + '</td>';
                    stringa+='<td><button class="btn btn-danger" onclick="elimina('+ record[i][0] +')">Elimina</button></td>'
                    stringa+='</tr>';
                }
                //funzione per eliminare un record tramite bottone elimina
                stringa+='</tbody>';
				stringa+='</table>';
                quale_div.html(stringa);
                $("#sott").css("display", "block");
              }
              else
              	alert ("error");  
            });
        });
    });
    //richiamo parte del codice già scritto per aggiornare i record
    function elimina(id)
    {
    	$.get("/mostra_clienti/elimina_trasferta.php?valore="+id, function(data, status){
              if(status=="success")
              {
              	//alert("record eliminato correttamente");
                var record;
                var stringa;
                testo=$("#valore").val();
                //alert(valore + " " + testo);
                quale_div=$("#aggiungi_tab");
                $.get("/mostra_clienti/mostra_con_categoria.php?tipo=" + valore + "&testo=" + testo, function(data, status){
                  if(status=="success")
                  {
                    record=data;
                    stringa='<table class="table table-striped" style="width:100%;">';
                    stringa+='<thead><tr><th scope="col">Nome</th><th scope="col">Cognome</th><th scope="col">Giorno</th><th scope="col">Valore</th><th scope="col">Numero Ore</th><th scope="col">Ragione Sociale</th><th scope="col">Elimina</th></tr></thead>';
                    stringa+='<tbody>';
                    for(var i=0;i<record.length;i++)
                    {
                        stringa+='<tr>';
                        stringa+='<td>' + record[i][1] + '</td>';
                        stringa+='<td>' + record[i][2] + '</td>';
                        stringa+='<td>' + record[i][3] + '</td>';
                        stringa+='<td>' + record[i][4] + '</td>';
                        stringa+='<td>' + record[i][5] + '</td>';
                        stringa+='<td>' + record[i][6] + '</td>';
                        stringa+='<td><button class="btn btn-danger" onclick="elimina('+ record[i][0] +')">Elimina</button></td>'
                        stringa+='</tr>';
                    }
                    stringa+='</tbody>';
                    stringa+='</table>';
                    quale_div.html(stringa);
                    $("#sott").css("display", "block");
                  }
                  else
                    alert ("error");
                });
              }
              else
              	alert("errore");
        });
    }
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
      <li class="nav-item active">
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
      <div style="width:100%;">
      	<h1 style="text-align: center;">Elimina Trasferta</h1>
        <br/>
      	<table>
      	<tr>
        	<td class="prima_c"><h3 style="color:green;">Campo</h3></td>
            <td>
            	<div class="btn-group">
                  <button type="button" id="nome" class="btn btn-primary">Nome Trasfertista</button>
                  <button type="button" id="cognome" class="btn btn-light">Cognome Trasferista</button>
                  <button type="button" id="data" class="btn btn-primary">Data (aaaa-mm-gg)</button>
                  <button type="button" id="cliente" class="btn btn-light">Cliente (Ragione Sociale)</button>
                </div>
            </td>
        </tr>
        <br/>
     	<tr>
        	<td class="prima_c"><h3 style="color:green;">Valore</h3></td>
            <td>
            	<input type="text" id="valore">
                <button id="cerca" class="btn btn-success">Cerca</button>
            </td>
        </tr>
      	</table>
        <br/>
        <h2 id="sott" style="display:none;text-align:center;color:red;">Risultati</h2>
        <br/>
        <div id="aggiungi_tab"></div>
      </div>
</div>
</body>
</html>