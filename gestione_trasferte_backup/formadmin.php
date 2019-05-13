<html>
<head>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <style>
      .clicca:hover
      {
          cursor:pointer;
      }
  </style> 
 
  <script>
    function mesepiu()
    {
		window.location.href = "./formadmin.php?mese=1";
		window.reload();   
    }

    function mesemeno()
    {
		window.location.href = "./formadmin.php?mese=-1";
		window.reload();
    }
  </script>
</head>
<body>
<?
    session_start();
	
	if(!isset($_SESSION["data"])) {
      $giorno="1";
      $anno=date("Y");
      $mese=date("n");
      //$data=new DateTime($anno.'-'.$mese.'-'.$giorno);
	  $data=date("Y-m-d");
	  //$data=$data->format("Y-m-d");
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
				$_SESSION["data"]=$data;
				break;
			case '-1': 
				$data = date('Y-m-d', strtotime("-1 months", strtotime($data)));
				$_SESSION["data"]=$data;
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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item active">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <input type="text" id="meseAttuale" value="<?php echo $mese ?>" style="display:none">
	<div class="table-responsive">
      <div>
        <div class="clicca" onclick="mesemeno()"><i class="fas fa-angle-left"></i></div>
        <h1>
          <?echo(date("F", strtotime($data)))?>
        </h1>
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
            require_once('funzioni_connessione.php');
            $query="SELECT trasfertista.id as ntrasfertista, trasfertista.nome as nome, trasfertista.cognome as cognome, DAY(giorno) as giorno, trasferta.valore as val FROM trasfertista LEFT JOIN `trasferta` ON trasfertista.id=trasferta.id_trasfertista AND MONTH(giorno)=".$mese." order by ntrasfertista, giorno";
            
            $conn = connettidb();
            $result=$conn->query($query);
            
            while($row = $result->fetch_assoc())
            {
              echo('<tr>');
              echo('<td>');
              echo('<button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModalCenter">');
              echo($row[cognome].' '.$row[nome]);
              echo('</button>');
              echo('</td>');
              for($i=0;$i<$quantigiorni;$i++)
              {
                echo('<td>');
                if($row[giorno]==$i+1)
                  echo($row[val]);
                echo('</td>');
              }
            }
          ?>
        </tr>
      </table>
    </div>
</div>
</body>	
</html>
