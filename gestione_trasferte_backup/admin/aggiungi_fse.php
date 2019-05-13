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
            //alert(array_javascript[1])
            var stringa_add="";
            if(array_javascript.lenght != 0)
              for(var i=0;i<array_javascript.length;i++)
                stringa_add+='<a class="dropdown-item" value="' + array_javascript[i][0] + '" id="list_' + i + '" onclick="aggiungi_testo('+ i + ')" href="#">' + array_javascript[i][1] + "</a>";
            //alert(stringa_add);
            quale_div.innerHTML=stringa_add;
        });
    });
    function aggiungi()
    {
    	var fse = $("#fse").val();
        var v = $("#V").val();
        var t = $("#T").val();
        var s = $("#S").val();
        var r = $("#R").val();
        var ts = $("#TS").val();
        var tr = $("#TR").val();
        var tf = $("#TF").val();
        var tt = $("#TT").val();
        var cliente = $("#azienda_click").val();
        //alert("/mostra_clienti/aggiungi_fse.php?fse="+fse+"&v="+v+"&t="+t+"&s="+s+"&r="+r+"&ts="+ts+"&tr="+tr+"&tf="+tf+"&tt="+tt+"&cliente="+cliente);
        $.get("/mostra_clienti/aggiungi_fse.php?fse="+fse+"&v="+v+"&t="+t+"&s="+s+"&r="+r+"&ts="+ts+"&tr="+tr+"&tf="+tf+"&tt="+tt+"&cliente="+cliente, function( data, status) {
          if(data=="success")
          	{
            	$("#modale").css('display','block');
                setTimeout(location.reload.bind(location), 1000);
            }
           else
           	alert("error");
        });
    }
    function aggiungi_testo(val)
    {
    var num = document.getElementById("list_"+val);
    var testo = num.innerHTML;
    var id = num.getAttribute("value");
    var butt = document.getElementById("azienda_click");
    butt.innerHTML=testo;
    butt.value=id;
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
      
      <!-- Nav Item - Aggiungi fse -->
      <li class="nav-item active">
        <a class="nav-link" href="aggiungi_fse.php">
          <i class="fas fa-plus"></i>
          <span>Aggiungi FSE</span></a>
      </li>

      <!-- Nav Item - Elimina fse -->
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
           <strong> FSE inserito correttamente</strong>
        </div>
      	<h1 style="text-align:center">Aggiungi FSE</h1>
        <table style="width:80%;margin:auto;" class="table table-stripped">
          <tr>
            	<td>
					<div class="form-group">
                      <label for="fse">FSE:</label>
                      <input style="width:180px;" type="text" class="form-control" id="fse">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                      <label for="S">S:</label><br/>
                      <input type="number" id="S" min="0">
                    </div>
                </td>
          </tr>
          <tr>
          		<td>
                    <div class="form-group">
                      <label for="V">V:</label><br/>
                      <input type="number" id="V" min="0">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                      <label for="R">R:</label><br/>
                      <input type="number" id="R" min="0">
                    </div>
                </td>
          </tr>
          <tr>
          		<td>
                    <div class="form-group">
                      <label for="T">T:</label><br/>
                      <input type="number" id="T" min="0">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                      <label for="TS">TS:</label><br/>
                      <input type="number" id="TS" min="0">
                    </div>
                <td>
          </tr>
          <tr>
          		<td>
                    <div class="form-group">
                      <label for="TR">TR:</label><br/>
                      <input type="number" id="TR" min="0">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                      <label for="TF">TF:</label><br/>
                      <input type="number" id="TF" min="0">
                    </div>
                </td>
          </tr>
          <tr>
          		<td>
                	 <div class="form-group">
                      <label for="TT">TT:</label><br/>
                      <input type="number" id="TT" min="0">
                    </div>
                </td>
          		<td>
                    <div>
                        <label for="azienda_click">Seleziona il Cliente:</label><br/>
                        <div class="btn-group dropright show"><button type="button" id="azienda_click" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clienti</button><div class="dropdown-menu" id="clienti_mostra" style="height: auto; max-height: 200px; overflow-x: hidden; position: absolute; transform: translate3d(79px, 0px, 0px); top: 0px; left: 0px; will-change: transform;" x-placement="right-start"></div></div>
                    </div> 
                </td>
          </tr>
        </table>
        <p style="text-align:center;">
        	<button type="button" class="btn btn-success" onclick="aggiungi();">Aggiungi</button>
    	</p>
    </div>
</div>
</body>
</html>