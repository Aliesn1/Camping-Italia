<?php
$n1=$_POST['username'];
$n2=$_POST['password'];
$n3=$_POST['cf'];
$n4=$_POST['name'];
$n5=$_POST['surname'];
$n6=$_POST['tipo_documento'];
$n7=$_POST['ndocumento'];

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

$query1="INSERT INTO anagrafica (codice_fiscale, nome, cognome, tipo_documento, numero_documento) values('$n3', '$n4', '$n5', '$n6', '$n7');" ;



mysqli_query($conn,$query1);

$query2="SELECT ID_cliente FROM anagrafica WHERE codice_fiscale='$n3';";

$Result=mysqli_query($conn,$query2);
$Dati = mysqli_fetch_array($Result);

$ID_cliente=$Dati['ID_cliente'];

$query3="INSERT INTO login (username, password, ID_cliente) values ('$n1', '$n2', '$ID_cliente');" ;

mysqli_query($conn,$query3);







echo "<b>COMPLIMENTI SEI STATO AUTENTICATO</b>";

header("location:../index.html");






mysqli_close($conn);
