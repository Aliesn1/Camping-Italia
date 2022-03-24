<?php

$ID_cliente=$_GET['ID_cliente'];

if (isset($_GET['ID_sensore'] )) {
  $ID_sensore=$_GET['ID_sensore'];

}
else {
  $ID_sensore=0;
}


$conn=mysqli_connect("localhost","root","", "camping");
if(!$conn)
{ echo("Errore di connessione");
exit();
}
//echo("Connessione al server Mysql effettuata con successo");

$nome='camping';
$x=mysqli_select_db($conn,$nome);
if(!$x)
{
echo("errore della connessione al database \n");
die('error'.mysqli_error($conn));


exit();
}


$query="SELECT data_inizio, data_fine, posti.descrizione AS postidescr, campeggi.descrizione AS campdescr,  posti.ID_sensore  FROM posticlienti, posti, campeggi
 WHERE ID_cliente=$ID_cliente AND posticlienti.ID_posto=posti.ID_posto AND campeggi.ID_campeggio=posti.ID_campeggio AND posti.ID_posto NOT IN (SELECT ID_posto FROM postoveicoli)  ORDER BY data_inizio";

$Result=mysqli_query($conn,$query);

while ($Dato=$Result->fetch_array()) {
  $Dati[]=$Dato;
}



$DatiSens="";
$DatiData="";

$query="SELECT umidita, data_ora, sensori.descrizione FROM misurazioni, sensori, posti WHERE misurazioni.ID_sensore=$ID_sensore AND sensori.ID_sensore=misurazioni.ID_sensore AND sensori.ID_sensore=posti.ID_sensore ORDER BY data_ora";
$Result=mysqli_query($conn,$query);

while ($Dato=$Result->fetch_array()) {
  $Dati_sensori[]=$Dato;

}


if (isset( $Dati_sensori)) {
  foreach ($Dati_sensori as $Dato ) {

    if ($DatiSens!="") {
      $DatiSens.=", ";
      $DatiData.=", ";
    }
    $DatiSens.=$Dato['umidita'];
    $DatiData.="'".$Dato['data_ora']."'";
    $DescrizioneSensore=$Dato['descrizione'];

  }
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.0/dist/chart.min.js"></script>



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

                  <table>



                    <tr>
                      <td><label style="color:red;text-align:left;">Le tue piazzole</label></td>

                    </tr>

                    <?php



                    foreach ($Dati as $Dato ) {


                      $a=$Dato['ID_sensore'];

                      ?>
                      <tr>


                        <td><label style="color:black;text-align:left;"><a href="<?php echo "?ID_sensore=$a&ID_cliente=$ID_cliente";?>"><?php echo $Dato['postidescr'];  ?></a></label></td>
                        <br>
                      </tr>
                      <?php

                    }

                     ?>





                  </table>







    </article>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>

<?php


if ($DatiSens!="") {




?>


<div width="10%" height="10%">
<table >

<tr>
  <td width="50%" height="50%">

    <canvas id="myChart"  ></canvas>
  </td>
  <td width="50%" height="50%">Questo è lo storico delle rilevazioni del sensore di umidità <?php echo   $DescrizioneSensore; ?></td>
</tr>


<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $DatiData; ?>],
        datasets: [{
            label: '% di umidità',
            data: [<?php echo $DatiSens; ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>


</table>

</div>
<?php
}

?>








<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="bgded overlay row4" style="background-image:url('images/demo/backgrounds/05.png');">
  <footer id="footer" class="hoc clear">
    <!-- ################################################################################################ -->
    <div class="center btmspace-50">
      <h6 class="heading">Social</h6>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="https://www.facebook.com"><i class="fab fa-facebook"></i></a></li>
        <li><a class="faicon-linkedin" href="https://www.linkedin.com"><i class="fab fa-linkedin"></i></a></li>
        <li><a class="faicon-twitter" href="https://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
      </ul>
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



<script >
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>




</body>
</html>
