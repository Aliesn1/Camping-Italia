<?php
$n1=$_POST['campeggio'];
$n2=$_POST['id_campeggio'];
$n3=$_POST['data_inizio'];
$n4=$_POST['data_fine'];
$n5=$_POST['ID_posto'];
$n6=$_POST['posto_veicolo_id'];
$ID_cliente=$_POST['cliente'];



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

$query1="INSERT INTO posticlienti values('$n5', '$ID_cliente', '$n3', '$n4')";


$ins="La prenotazione non è stata eseguita";

$Result=mysqli_query($conn,$query1);

if ($Result) {
  $query1="INSERT INTO posticlienti values('$n6', '$ID_cliente', '$n3', '$n4')";
  $Result=mysqli_query($conn,$query1);
  if ($Result) {
    $ins="Prenotazione avvenuta con successo";
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


      <form method="post" action="../index.html" >
            <h1>Prenotazione</h1>

            <label style="color:black;text-align:left;"><?php echo $ins;  ?></label>


            <button type="submit" name="login">Torna alla pagina principale</button>
        </form>




    </article>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>







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
</body>
</html>
