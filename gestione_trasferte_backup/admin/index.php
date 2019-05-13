<?php	
	session_start();
	if(!isset($_SESSION["id"]) || $_SESSION["admin"]!=1)
    	header("location: https://gestionetrasferteeffeg.altervista.org/");
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://gestionetrasferteeffeg.altervista.org/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="/mostra_clienti/carica_clienti.js?v=3"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">
  <script type="text/javascript">
    //ajax trasferta
  function modifica_trasferta(num,riga_modifico){
  ////////////////finire
  		var id = $("#persona_modale #div_nascosto").html();
        var riga=num;
        var da = $("#data"+riga).text();
        da = da.replace(/\s+/g, '');
        da = da.split('/');
        var d = da[2]+"-"+da[1]+"-"+da[0];
        var cliente = $("#azienda_click"+riga).val();
        var id_fse = $("#fse"+riga).val();
        var valore = $("#val"+ riga).val();
        var ora = $("#ore" + riga).val();
        var id_corr = $("#id_mod"+riga_modifico).val();
        if(valore=="T"||valore=="S"||valore=="V"||valore=="R"||valore=="TT"||valore=="TS")
        	if(ora<=16)
        	{
            		$.get("/mostra_clienti/modifica_trasferta.php?giorno="+d+"&valore="+valore+"&ore="+ora+"&id_trasfertista="+id+"&id_cliente="+cliente+"&dati="+id_fse+"&id_tra="+id_corr, function(data, status){
                    if(status=="success")
                    {
                    	//alert("La trasferta è stata modificata correttamente");
                        $("#aggiungi_date").html("");
                        $("#exampleModalCenter").removeClass("in");
                        $(".modal-backdrop").remove();
                        $("#exampleModalCenter").hide();
						location.reload();
                    }
                    else
                    	alert("Errore");
                  });
            }
            else
            	alert("Il limite massimo di ore di lavoro è 16");
        else
        	alert("Il valore inserito nel campo valore non è accettabile");
  }
  function aggiungi_trasferta(num) {
  		var id = $("#persona_modale #div_nascosto").html();
        var riga=num;
        var da = $("#data"+riga).text();
        da = da.replace(/\s+/g, '');
        da = da.split('/');
        //alert(da);
        var d = da[2]+"-"+da[1]+"-"+da[0];
		//alert(d);

        var cliente = $("#azienda_click"+riga).val();
        var id_fse = $("#fse"+riga).val();
        var valore = $("#val"+ riga).val();
        var ora = $("#ore" + riga).val();
  		if(valore=="T"||valore=="S"||valore=="V"||valore=="R"||valore=="TT"||valore=="TS")
        	if(ora<=16)
        	{
            	    $.get("/mostra_clienti/inserisci_trasferta.php?giorno="+d+"&valore="+valore+"&ore="+ora+"&id_trasfertista="+id+"&id_cliente="+cliente+"&dati="+id_fse, function(data, status){
                    //alert("Data: " + data + "\nStatus: " + status);
                    if(status=="success")
                    {
                    	//alert("La trasferta è stata inserita correttamente");
                        $("#aggiungi_date").html("");
                        $("#exampleModalCenter").removeClass("in");
                        $(".modal-backdrop").remove();
                        $("#exampleModalCenter").hide(); 
						location.reload();
                    }
                    else
                    	alert("Errore");
                  });
            }
            else
            	alert("Il limite massimo di ore di lavoro è 16");
        else
        	alert("Il valore inserito nel campo valore non è accettabile");
  }
  //date le due date compongo le varie righe per aggiungere una trasfera
  $(document).ready(function(){
    $("#data_f").change(function(){
      var data_finale = new Date($("#data_f").val());
      var data_iniziale = new Date($("#data_i").val());
      var diff = new Date(data_finale - data_iniziale);      
      var days = diff/1000/60/60/24;
      var stringa_aggiungere="";
      //alert(days);
      var d_i = data_iniziale.getFullYear() + "-" + (data_iniziale.getMonth()+1) + "-" + data_iniziale.getDate();
      var d_f = data_finale.getFullYear() + "-" + (data_finale.getMonth()+1) + "-" + data_finale.getDate();
      var risultato_ajax=null;
      $.ajax({
          url: "/admin/trasferte_esistenti.php?giorno_i="+d_i+"&giorno_f="+d_f+"&id_t="+ $("#persona_modale #div_nascosto").html(),
          type: 'GET',
          async: false,
          cache: false,
          timeout: 30000,
          error: function(){
              return true;
          },
          success: function(data){ 
              risultato_ajax=data;
          }
      	});
        var indice_t=0;
        //alert(risultato_ajax);
        for(var i=0;i<=days;i++)
        {
          if(risultato_ajax.length>0 && indice_t<risultato_ajax.length)
          {
          //prima data composta
          var lun_mese = String(data_iniziale.getMonth()+1).length;
          var lun_day =  String(data_iniziale.getDate()).length;
          ///
          //alert(data_finale);
          var data_c=data_iniziale.getFullYear() + "-";
          if (lun_mese == 1 )
              data_c+="0";
          data_c+=(data_iniziale.getMonth()+1) + "-";
          if (lun_day == 1 )
              data_c+="0";
          data_c+=(data_iniziale.getDate());
          //seconda
          var data_p = risultato_ajax[indice_t][0].split('-');
          //alert("data iniziale" + data_c);
          var data_c2 = data_p[0] + "-" + data_p[1] + "-" + data_p[2];
          //alert("data seconda " + data_c2);
          //alert(data_c);alert(data_c2);alert(indice_t);alert(data_p);alert("/admin/trasferte_esistenti.php?giorno_i="+d_i+"&giorno_f="+d_f+"&id_t="+ $("#persona_modale #div_nascosto").html());
            if(data_c == data_c2)
            {
              stringa_aggiungere+='<hr><div class="row">';
              stringa_aggiungere+='<div class="col-sm-2"><input type="hidden" value="'+risultato_ajax[indice_t][7]+'" id="id_mod'+indice_t+'"/><span id="data' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">' + " " + data_iniziale.getDate() + '/' + (data_iniziale.getMonth()+1) + '/' + data_iniziale.getFullYear() + '</span></div>';
              stringa_aggiungere+='<div class="col-sm-2"><div class="btn-group dropright"><button type="button" id="azienda_click' + i + '" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="carica(' + i + ');" value="' + risultato_ajax[indice_t][5]  + '">' + risultato_ajax[indice_t][1] + '</button><div class="dropdown-menu" id="clienti_mostra' + i +'" style="height: auto;max-height: 200px;overflow-x: hidden;"></div></div></div>';
              stringa_aggiungere+='<div class="col-sm-2"><div class="btn-group dropright"><button type="button" id="fse' + i + '" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="carica_fse(' + i + ');" value="' + risultato_ajax[indice_t][6] + '">' + risultato_ajax[indice_t][2] + '</button><div class="dropdown-menu" id="fse_mostra' + i + '" style="height: auto;max-height: 200px;overflow-x: hidden;"></div></div></div>';
              stringa_aggiungere+='<div class="col-sm-2"><label for="val' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">Valore</label><input type="text" name="valore" class="form-control" id="val' + i + '" placeholder="T/S/V/R/TT/TS" value="'+ risultato_ajax[indice_t][3] + '"/></div>';
              stringa_aggiungere+='<div class="col-sm-2"><label for="ore' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">Numero ore</label><input type="text" name="ore" class="form-control" id="ore' + i + '" placeholder="Ora" value="'+ risultato_ajax[indice_t][4] +'"></div>';
              stringa_aggiungere+='<div class="col-sm-1"><input type="button" class="btn btn-warning"  value="Modifica" id="invia' + i +'" name="invia" onclick="modifica_trasferta(' + i + ',' + indice_t + ')"/></div>';
              stringa_aggiungere+='</div>';
              indice_t++;
            }
            else
            {
              //alert("diversa");
              stringa_aggiungere+='<hr><div class="row">';
              stringa_aggiungere+='<div class="col-sm-2"><span id="data' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">' + " " + data_iniziale.getDate() + '/' + (data_iniziale.getMonth()+1) + '/' + data_iniziale.getFullYear() + '</span></div>';
              stringa_aggiungere+='<div class="col-sm-2"><div class="btn-group dropright"><button type="button" id="azienda_click' + i + '" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="carica(' + i + ');">Clienti</button><div class="dropdown-menu" id="clienti_mostra' + i +'" style="height: auto;max-height: 200px;overflow-x: hidden;"></div></div></div>';
              stringa_aggiungere+='<div class="col-sm-2"><div class="btn-group dropright"><button type="button" id="fse' + i + '" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="carica_fse(' + i + ');" disabled>FSE</button><div class="dropdown-menu" id="fse_mostra' + i +'" style="height: auto;max-height: 200px;overflow-x: hidden;"></div></div></div>';
              stringa_aggiungere+='<div class="col-sm-2"><label for="val' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">Valore</label><input type="text" name="valore" class="form-control" id="val' + i + '" placeholder="T/S/V/R/TT/TS"></div>';
              stringa_aggiungere+='<div class="col-sm-2"><label for="ore' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">Numero Ore</label><input type="text" name="ore" class="form-control" id="ore' + i + '" placeholder="Ora"></div>';
              stringa_aggiungere+='<div class="col-sm-1"><input type="button" class="btn btn-success"  value="Aggiungi" id="invia' + i +'" name="invia" onclick="aggiungi_trasferta(' + i + ')"/></div>';
              stringa_aggiungere+='</div>';
            }
          }
          else
          {
          	  //alert("funz");
              stringa_aggiungere+='<hr><div class="row">';
              stringa_aggiungere+='<div class="col-sm-2"><span id="data' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">' + " " + data_iniziale.getDate() + '/' + (data_iniziale.getMonth()+1) + '/' + data_iniziale.getFullYear() + '</span></div>';
              stringa_aggiungere+='<div class="col-sm-2"><div class="btn-group dropright"><button type="button" id="azienda_click' + i + '" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="carica(' + i + ');">Clienti</button><div class="dropdown-menu" id="clienti_mostra' + i +'" style="height: auto;max-height: 200px;overflow-x: hidden;"></div></div></div>';
              stringa_aggiungere+='<div class="col-sm-2"><div class="btn-group dropright"><button type="button" id="fse' + i + '" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="carica_fse(' + i + ');" disabled>FSE</button><div class="dropdown-menu" id="fse_mostra' + i +'" style="height: auto;max-height: 200px;overflow-x: hidden;"></div></div></div>';
              stringa_aggiungere+='<div class="col-sm-2"><label for="val' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">Valore</label><input type="text" name="valore" class="form-control" id="val' + i + '" placeholder="T/S/V/R/TT/TS"></div>';
              stringa_aggiungere+='<div class="col-sm-2"><label for="ore' + i + '" class="testo_info" style="color:#78a1e2;font-weight:bold;">Numero Ore</label><input type="text" name="ore" class="form-control" id="ore' + i + '" placeholder="Ora"></div>';
              stringa_aggiungere+='<div class="col-sm-1"><input type="button" class="btn btn-success"  value="Aggiungi" id="invia' + i +'" name="invia" onclick="aggiungi_trasferta(' + i + ')"/></div>';
              stringa_aggiungere+='</div>';
          }
          data_iniziale.setDate(data_iniziale.getDate() + 1);
        }
        $("#aggiungi_date").html(stringa_aggiungere);
    });
  });
  </script>
  <style media="text/css">
        .butt{
          height:10%;
          width:100%;
        }
        .testo_info{
          font-weight:bold;
		  color:#33C1E5;
        }
        .modal-content {
          height: 95%;
          width: 95%;
          overflow: scroll;
        }
        .modal-body {
          max-height: 90vh;
        }
        .modal-body img {
          max-height: 69vh;
        }
        .bordo_destro{
        	border-right: 10px;
        }
    </style>
  <style>
      .clicca:hover
      {
          cursor:pointer;
      }
  </style> 
 
  <script>
     function mesepiu()
    {
		window.location.href = "./index.php?mese=1";
		window.reload();   
    }

    function mesemeno()
    {
		window.location.href = "./index.php?mese=-1";
		window.reload();
    }
    $(document).on("click", ".open-modal", function () {
     var nome = $(this).html();
     $('#persona_modale').html(nome);
    });
  </script>
</head>
<body>
<?
  

	if(!isset($_SESSION["data"])||$_SESSION["data"]=="")
	{
      $data=date("Y-m-d");
      $_SESSION["data"] = $data;
	  
    } 
	else 
    {
      $data=$_SESSION["data"];  
	}
    if(isset($_GET['mese']))
	{
		switch($_GET['mese'])
		{
			case '1': 
				$data = date('Y-m-d', strtotime("+1 months", strtotime($data)));
				$_SESSION["data"]= $data;
				break;
			case '-1': 
				$data = date('Y-m-d', strtotime("-1 months", strtotime($data)));
				$_SESSION["data"]= $data;
				break;			
		}
	}
    $mese=date("n",strtotime($data));
    $anno=date("Y",strtotime($data));
    $quantigiorni=cal_days_in_month(CAL_GREGORIAN,$mese,$anno);
  ?>
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
      <li class="nav-item active">
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
	<input type="text" id="meseAttuale" value="<?php echo $mese ?>" style="display:none">
	<div class="table-responsive">
      <div>
        <div class="clicca" onclick="mesemeno()"><i class="fas fa-angle-left"></i></div>
        <h3>
			      <?echo(date("F", strtotime($data)))?>
        </h3>
        <div class="clicca" onclick="mesepiu()"><i class="fas fa-angle-right"></i></div>
      </div>
      <table class="table">
        <tr>
          <?php
            echo('<td>Nome Trasfertista</td>');
            for($i=0;$i<$quantigiorni;$i++)
            {
              echo('<td>');	
              echo($i+1);
              echo("</td>");
            }
          
            echo('</tr>');
            require_once('../funzioni_connessione.php');
            $query="SELECT trasfertista.id as ntrasfertista, trasfertista.nome as nome, trasfertista.cognome as cognome, DAY(giorno) as giorno, trasferta.valore as val FROM trasfertista LEFT JOIN `trasferta` ON trasfertista.id=trasferta.id_trasfertista AND MONTH(giorno)=".$mese." WHERE eliminato=0 AND amministratore=0 order by ntrasfertista, giorno";
            $conn = connettidb();
            $result=$conn->query($query);
            
            $primo=true;
            
            for($i=0;$i<$quantigiorni;$i++)
            {
              $inserisci[$row[giorno]]="";
            }
            while($row = $result->fetch_assoc())
            {
              $idtrasf=$row[ntrasfertista];
              if($primo)
              {
                 $idvecchio=$idtrasf;
              }
              if($idtrasf!=$idvecchio)
              {
              	//echo("<script>alert(" . $row[ntrasfertista] . ")</script>");
                echo('<tr>');
                echo('<td>');
                echo('<button type="button" class="open-modal btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">');
                echo($cognome.' '.$nome);
                echo('<div class="div_nascosto" id="div_nascosto" style="display:none;">');
                echo($idvecchio);
                //echo("<script>alert(" . $idvecchio . ")</script>");
                echo('</div>');
                echo('</button>');
                echo('</td>');
                for($i=0;$i<$quantigiorni;$i++)
                {
                  echo('<td>');
                  echo($inserisci[$i]);
                  echo('</td>');
                }
                for($i=0;$i<$quantigiorni;$i++)
                {
                  $inserisci[$i]="";
                }
                echo('</tr>');
              }
              
                $inserisci[$row[giorno]-1]=$row[val];
              
              $nome=$row[nome];
              $cognome=$row[cognome];
              $primo=false;
              $idvecchio=$idtrasf;
            }
            
            echo('<tr>');
            echo('<td>');
            echo('<button type="button" class="open-modal btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">');
            echo($cognome.' '.$nome);
            echo('<div class="div_nascosto" id="div_nascosto" style="display:none;">');
            echo($idvecchio);
            //echo("<script>alert(" . $idvecchio . ")</script>");
            echo('</div>');
            echo('</button>');
            echo('</td>');
            for($i=0;$i<$quantigiorni;$i++)
            {
              echo('<td>');
              echo($inserisci[$i]);
              echo('</td>');
            }
            echo('</tr>');
          ?>
        </tr>
      </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" name="#exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="persona" style="color:#0acccc">Aggiungi Trasferta a <div style="display:inline;" id="persona_modale"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="display:inline;">
        <div class="container">
          <div class="row">
        	   <div class="col-sm-2">
            	 <span style="color:#0f5ddb;font-weight:bold;font-size:16px;">Data Iniziale</span>
              </div>
              <div class="col-sm-4">
            	<input type="date" name="data_i" id="data_i" value="<?php echo date("Y-m-d");?>">
              </div>
              <div class="col-sm-2">
            	 <span style="color:#0f5ddb;font-weight:bold;font-size:16px;">Data Finale</span>
              </div>
              <div class="col-sm-4">
            	<input type="date" name="data_f" id="data_f" value="<?php echo date("Y-m-d");?>">
              </div>
          </div>
		  <div id="aggiungi_date">
              <hr><div class="row">
          </div>

      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
      </div>
    </div>
  </div>
</div>  
</body>	
</html>
