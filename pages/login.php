<?php
$n1=$_POST['username'];
$n2=$_POST['password'];
$n3=$_POST['pagina'];
$conn=mysqli_connect("localhost","root","", "camping");
if(!$conn)
{ echo("Errore di connessione");
exit();
}
echo("Connessione al server Mysql effettuata con successo");
echo "<br>";
$nome='camping';
$x=mysqli_select_db($conn,$nome);
if(!$x)
{
echo("errore della connessione al database \n");
die('error'.mysqli_error($conn));


exit();
}
echo("Connessione al Database effettuata con successo");
echo "<br>";
echo "<table align='center' border=5 bgcolor=cyan>";
echo "<TD><B>NOME UTENTE INSERITO :</B> ". $n1 ."<br></TD>";
echo "<tr>";
echo " <TD> <B> PSWRD INSERITA :</B>".$n2 ."<br></TD>";
echo "</table>";
$query1="SELECT * from login where username='$n1' and password='$n2';" ;
$ris=mysqli_query($conn,$query1);
echo '<br>';
$numerorighe=mysqli_num_rows($ris);
echo "<br>";
echo('La tabella contiene:'.$numerorighe .'righe.');
echo "<br>";
if($numerorighe==0)
{
echo "<B>UTENTE NON RICONOSCIUTO </B>";


}
else
{

mysqli_close($conn);
echo "<b>COMPLIMENTI SEI STATO AUTENTICATO</b>";


$Dati_cliente = mysqli_fetch_array($ris);

$ID_cliente=$Dati_cliente['ID_cliente'];



if ($n3=="prenota") {
  header("location: prenota.php?ID_cliente=$ID_cliente");
}
else {
  header("location: utente.php?ID_cliente=$ID_cliente");
}


}
