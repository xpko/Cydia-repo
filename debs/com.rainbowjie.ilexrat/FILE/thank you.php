<?php 
ini_set("magic_quotes_gpc", "0"); 
set_magic_quotes_runtime(0);
$fname = $_POST["fname"];
$message = $_POST["message"];
?>
<?php
header('Location: posts.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<link href="../icon.png" rel="apple-touch-icon" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<script src="../functions/functions.js" type="text/javascript"></script>
<title>Thank You!</title>
<link media="screen" href="../css/style.css" type= "text/css" rel="stylesheet" />
 <link media="screen" href="comments.css" type= "text/css" rel="stylesheet" />
</head>

<body>
<div id="topbar">
	<div id="leftnav">
		<a href="../home/home.php"><img alt="home" src="../images/home.png" /></a>
        <a href="">Back</a></div>
	<div id="title">Posted!</div>
</div>
<div id="content">
<?php
if (empty($fname) or empty($message))
{
	if (empty($fname) && empty($message))
	{
	echo "<ul class=\"pageitem\">";
	echo "<li class=\"textbox\">";
	echo "Sorry, you didn't enter a name and a comment, your comment was not posted.";
	echo "</li>";
	echo "</ul>";
	}
	elseif (empty($fname))
	{
	echo "<ul class=\"pageitem\">";
	echo "<li class=\"textbox\">";
	echo "Sorry, you didn't enter a name, your comment was not posted.";
	echo "</li>";
	echo "</ul>";
	} 
	elseif (empty($message))
	{
	echo "<ul class=\"pageitem\">";
	echo "<li class=\"textbox\">";
	echo "Sorry, you didn't enter a message, your comment was not posted.";
	echo "</li>";
	echo "</ul>";
	} else {
	echo "<ul class=\"pageitem\">";
	echo "<li class=\"textbox\">";
	echo "Sorry, there was an internal system error, your comment was not posted.";
	echo "</li>";
	echo "</ul>";
	}
} else {

function filterBadWords($str){

 // words to filter
 $badwords=array( "fucker", "cunt", "fuck" );

 // replace filtered words with
 $replacements=array( "******", "****", "****" );

 for($i=0;$i < sizeof($badwords);$i++){
  srand((double)microtime()*1000000); 
  $rand_key = (rand()%sizeof($replacements));
  $str=eregi_replace($badwords[$i], $replacements[$rand_key], $str);
 }
 return $str;
}

$fname = strip_tags($fname, '<b><i><u></b></i></u><p></p>');
$message = strip_tags($message, '<b><i><u></b></i></u><p></p>');
$message = filterBadWords($message);
$fname = filterBadWords($fname);
$myFile = "posts.txt";
$fh = fopen($myFile, 'a') or die("<ul class='pageitem'><li class='textbox>Sorry, there was an internal system error, your comment was not posted.</li></ul>");
fwrite($fh, "<ul class=\"pageitem\">");
fwrite($fh, "<li class=\"textbox\">");
fwrite($fh, "<span class=\"header\">");
fwrite($fh, $fname);
fwrite($fh, "<span class=\"header\" style='float:right'> ");
fwrite($fh, date("d/m/y", time()) );
fwrite($fh, "</span>");
fwrite($fh, "</span>");
fwrite($fh, $message);
fwrite($fh, "</li>");
fwrite($fh, "</ul>");
fwrite($fh, "\n");
fclose($fh);
echo "<ul class=\"pageitem\">";
echo "<li class=\"textbox\">";
echo "Merci, votre commentaire a ete ajoute ! Vous pouvez revenir a la liste des commentaires.";
echo "</li>";
echo "</ul>";
}
?>

</div>
</body>
</html>

