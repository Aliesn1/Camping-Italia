<?php

$campeggio=$_GET['campeggio'];

$conn=mysqli_connect("localhost","root","", "camping");
if(!$conn)
{ echo("Errore di connessione");
exit();
}

$query="SELECT * FROM campeggi WHERE ID_campeggio=$campeggio;";

$Result=mysqli_query($conn,$query);

$Dati_campeggio=mysqli_fetch_array($Result);
$Dati_campeggio['descrizione'];
$ID_regione=$Dati_campeggio['ID_regione'];


$query="SELECT * FROM regioni WHERE ID_regione=$ID_regione;";
$Result=mysqli_query($conn,$query);

$Regione=mysqli_fetch_array($Result);

$query="SELECT * FROM servizi, servizicamp WHERE ID_campeggio=$campeggio";
$Result=mysqli_query($conn,$query);

while ($Dato=$Result->fetch_array()) {
  $Servizi[]=$Dato;
}




$query="SELECT COUNT(ID_veicolo) AS numero_veicoli FROM postoveicoli, posti WHERE ID_campeggio=$campeggio AND posti.ID_posto=postoveicoli.ID_posto AND tipo='macchina';";
$Result=mysqli_query($conn,$query);

$Auto=mysqli_fetch_array($Result);

$query="SELECT COUNT(ID_veicolo) AS numero_moto FROM postoveicoli, posti WHERE ID_campeggio=$campeggio AND posti.ID_posto=postoveicoli.ID_posto AND tipo='moto';";
$Result=mysqli_query($conn,$query);

$Moto=mysqli_fetch_array($Result);


$query="SELECT n_servizi FROM servizi, servizicamp WHERE tipo='noleggio bici' AND servizicamp.ID_campeggio=$campeggio AND servizicamp.ID_servizio=servizi.ID_servizio ";
$Result=mysqli_query($conn,$query);

$Bici=mysqli_fetch_array($Result);

$query="SELECT n_servizi FROM servizi, servizicamp WHERE tipo='noleggio barche' AND servizicamp.ID_campeggio=$campeggio AND servizicamp.ID_servizio=servizi.ID_servizio ";
$Result=mysqli_query($conn,$query);

$Barche=mysqli_fetch_array($Result);

$query="SELECT n_servizi FROM servizi, servizicamp WHERE tipo='campi sportivi' AND servizicamp.ID_campeggio=$campeggio AND servizicamp.ID_servizio=servizi.ID_servizio ";
$Result=mysqli_query($conn,$query);

$Sport=mysqli_fetch_array($Result);


switch ($campeggio) {
  case 1:
    $Coordinate="42.8132008,13.93632";
    break;
  case 2:
      $Coordinate="40.4390315,17.2514546";
    break;
  case 3:
    $Coordinate="44.37855,9.0651113";
    break;

  default:
      $Coordinate="42.8132008,13.93632";
    break;
}


mysqli_close($conn);

?>


<!DOCTYPE html>

<html lang="">
<head>
<title>Camping</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="../layout/styles/stile.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('../images/demo/backgrounds/background.jpg');">
  <!-- ################################################################################################ -->
  <div class="wrapper row0">
    <div id="topbar" class="hoc clear">
      <div class="fl_left">
        <!-- ################################################################################################ -->
        <ul class="nospace">
          <li><i class="fas fa-phone rgtspace-5"></i> +39 (123) 456 7890</li>
          <li><i class="far fa-envelope rgtspace-5"></i> info@campingitalia.com</li>
        </ul>
        <!-- ################################################################################################ -->
      </div>
      <div class="fl_right">
        <!-- ################################################################################################ -->
        <ul class="nospace">

          <li><a href="login1.php?pagina=utente" title="Account"><i class="fas fa-sign-in-alt"></i></a></li>
          <li><a href="registrazione.html" title="Registrati"><i class="fas fa-edit"></i></a></li>
          </li>
        </ul>
        <!-- ################################################################################################ -->
      </div>
    </div>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear">
      <div id="logo" class="fl_left">
        <!-- ################################################################################################ -->
        <h1><a href="../index.html">Camping</a></h1>
        <!-- ################################################################################################ -->
      </div>
      <nav id="mainav" class="fl_right">
        <!-- ################################################################################################ -->
        <ul class="clear">
          <li class="active"><a href="../index.html">Home</a></li>


          <li><a href="login1.php?pagina=prenota">Prenota</a></li>
        </li>

        </ul>
        <!-- ################################################################################################ -->
      </nav>
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="pageintro" class="hoc clear">
    <!-- ################################################################################################ -->
    <article>
      <h3 class="heading"><?php echo $Dati_campeggio['descrizione']; ?></h3>
      <p>Vieni in <?php echo $Regione['descrizione']; ?></p>
      <footer>

      </footer>
    </article>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>



<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
function myMap() {
  var MyCenter= new google.maps.LatLng(<?php echo $Coordinate; ?>);
var mapProp= {
  center:MyCenter,
  zoom:15,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

var marker = new google.maps.Marker({position: MyCenter});
marker.setMap(map);
}


</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTmBDP4SPFUy7EXvgE3X3_w-eR7m_cUs4&callback=myMap"></script>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear">
    <!-- main body -->
    <!-- ################################################################################################ -->

    <!-- ################################################################################################ -->
    <hr class="btmspace-80">
    <!-- ################################################################################################ -->
    <section id="overview">
      <div class="sectiontitle">

        <p class="heading underline font-x2">I nostri servizi</p>
      </div>
      <ul class="nospace group btmspace-80">
        <li class="one_third">
          <article>
            <div class="clear"><a ><i class="fas fa-shower"></i></a>
              <h6 class="heading">Docce calde</h6>
            </div>
            <p>Abbiamo <?php echo $Dati_campeggio['docce'] ?> docce disponibili per i nostri clienti;</p>
          </article>
        </li>
        <li class="one_third">
          <article>
            <div class="clear"><a ><i class="fas fa-table-tennis"></i></a>
              <h6 class="heading">Tempo libero</h6>
            </div>
            <p>Sono presenti <?php echo $Sport['n_servizi'];  ?> campi sportivi nel nostro campeggio, per poter praticare qualsiasi tipo di sport.</p>
          </article>
        </li>
        <li class="one_third">
          <article>
            <div class="clear"><a ><i class=" fas fa-rss"></i></a>
              <h6 class="heading">Wi-Fi</h6>
            </div>
            <p>Accesso ad internet gratuito per tutti i clienti</p>
          </article>
        </li>
      </ul>

    </section>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>


<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <section class="hoc container clear">
    <!-- ################################################################################################ -->

    <ul id="stats" class="nospace group">
      <li><i class="fas fa-car"></i>
        <p><a><?php echo $Auto['numero_veicoli']; ?></a></p>
        <p>Posti auto</p>
      </li>
      <li><i class="fas fa-bicycle"></i>
        <p><a><?php echo $Bici['n_servizi']?></a></p>
        <p>Bici da noleggiare</p>
      </li>
      <li><i class="fas fa-motorcycle"></i>
        <p><a><?php echo $Moto['numero_moto']?></a></p>
        <p>Posti moto</p>
      </li>
      <li><i class=" fas fa-ship"></i>
        <p><a><?php echo $Barche['n_servizi']?></a></p>
        <p>Barche noleggiabili</p>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>


<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="bgded overlay row4" style="background-image:url('images/demo/backgrounds/01.jpg');">
  <footer id="footer" class="hoc clear">
    <!-- ################################################################################################ -->
    <div class="center btmspace-50">
      <h6 class="heading">Social</h6>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="https://www.facebook.com"><i class="fab fa-facebook"></i></a></li>
        <li><a class="faicon-linkedin" href="https://www.linkedin.com"><i class="fab fa-linkedin"></i></a></li>
        <li><a class="faicon-twitter" href="https://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
      </ul>

    </div>
    <!-- ################################################################################################ -->
    <hr class="btmspace-50">
    <!-- ################################################################################################ -->
    <div class="group btmspace-50">
      <div class="center btmspace-50">
        <h6 class="heading">Supporto</h6>
        <p class="nospace btmspace-15">Lascia le informazioni e verrai ricontattato</p>
        <form method="post" action="#">
          <fieldset>
            <input class="btmspace-15" type="text" value="" placeholder="Nome">
            <input class="btmspace-15" type="text" value="" placeholder="Email">
            <button type="submit" value="submit">Submit</button>
          </fieldset>
        </form>
      </div>



      <!-- ################################################################################################ -->
    </div>
    <div id="ctdetails" class="clear">
      <ul class="nospace clear">
        <li class="one_third first">
          <div class="block clear"><a href="#"><i class="fas fa-phone"></i></a> <span><strong>Chiamaci</strong> +39 (123) 456 7890</span></div>
        </li>
        <li class="one_third">
          <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Inviaci una mail:</strong> INFO@CAMPINGITALIA.COM</span></div>
        </li>
        <li class="one_third">
          <div class="block clear"><a href="#"><i class="fas fa-clock"></i></a> <span><strong> Lunedì - Sabato:</strong> 08.00 - 18.00</span></div>
        </li>

      </ul>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>


<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>
