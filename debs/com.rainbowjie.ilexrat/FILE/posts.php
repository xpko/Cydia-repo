<?php
ini_set("magic_quotes_gpc", "0"); 
set_magic_quotes_runtime(0);
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
<title>Comments</title>
<link media="screen" href="http://cy.itmfr.net/css/style.css" type= "text/css" rel="stylesheet" />
 <link media="screen" href="http://cy.itmfr.net/css/comments.css" type= "text/css" rel="stylesheet" />
 <link media="screen" href="http://cy.itmfr.net/css/f-menes.css" type= "text/css" rel="stylesheet" />
 
 
 
  
 
 
 
 
 
</head>
<body>


<div id="content" lang="fr">
<?php
function paginate($display, $pg, $total) {
  /* make sure pagination doesn't interfere with other query 
string variables */
  if(isset($_SERVER['QUERY_STRING']) && trim(
    $_SERVER['QUERY_STRING']) != '') {
    if(stristr($_SERVER['QUERY_STRING'], 'pg='))
      $query_str = '?'.preg_replace('/pg=\d+/', 'pg=', 
        $_SERVER['QUERY_STRING']);
    else
      $query_str = '?'.$_SERVER['QUERY_STRING'].'&pg=';
  } else
    $query_str = '?pg=';
    
  /* find out how many pages we have */
  $pages = ($total <= $display) ? 1 : ceil($total / $display);
    
  /* create the links */
  $first = '<li><a href="'.$_SERVER['PHP_SELF'].$query_str.'1">&#171;
</a></li>';
  $prev = '<li><a href="'.$_SERVER['PHP_SELF'].$query_str.($pg - 1).'">
&#139;</a></li>';
  $next = '<li><a href="'.$_SERVER['PHP_SELF'].$query_str.($pg + 1).'">
&#155;</a></li>';
  $last = '<li><a href="'.$_SERVER['PHP_SELF'].$query_str.$pages.'">
&#187;</a></li>';
   
  /* display opening navigation */
  echo '<ul class="pageitem"><li class="textbox"><div class="center" style="text-align:center"><ul class="center" id="pagination-digg">';
  echo ($pg > 1) ? "$first $prev " : '<li><a href="" style="color:#000">&#171;</a></li>  <li><a href="" style="color:#000">&#139;</a></li> ';
  
  /* limit the number of page links displayed */
  $begin = $pg - 4;
  while($begin < 1)
    $begin++;
  $end = $pg + 4;
  while($end > $pages)
    $end--;
  for($i=$begin; $i<=$end; $i++)
    echo ($i == $pg) ? '<li><a href="" style="color:#000">'.$i.'</a></li>' : ' <li><a href="'.
      $_SERVER['PHP_SELF'].$query_str.$i.'">'.$i.'</a></li> ';
    
  /* display ending navigation */
  echo ($pg < $pages) ? " $next  $last" : ' <li><a href="" style="color:#000">&#155;</a></li>  <li><a href="" style="color:#000">&#187;</a></li>';
  echo '</li></ul></div></li></ul>';
}

/* set pagination variables */
$display = 10;
$pg = (isset($_REQUEST['pg']) && ctype_digit($_REQUEST['pg'])) ?
  $_REQUEST['pg'] : 1;
$start = $display * $pg - $display;

/* paginating from a flatfile */
$data = file('posts.txt');
$total = count($data);
$news = array_slice(array_reverse($data), $start, $display);

/* paginate($display, $pg, $total); */
?>

        

 

<form action="thank you.php" method="post">
<ul class="pageitem">
<li class="bigfield"><input id="pseudo" placeholder="Name" type="text" name="fname"/></li>
<li class="bigfield"><input id="comment" placeholder="Comment" type="text" name="message" /></li>
<li class="button"><input id="addComment" name="name" type="submit" value="Add comment"/></li>
<p style="hidden" value="[COMMENTS]"/>
</ul>
</form>      
  
   <script type="text/javascript">


if (navigator.appName == 'Netscape') 
var language = navigator.language; 
else 

var language = navigator.browserLanguage; 
if (language.indexOf('fr') > -1)
{ 

document.getElementById('pseudo').placeholder = "Pseudo";
document.getElementById('comment').placeholder = "Commentaire";
document.getElementById('addComment').value = "Ajouter un commentaire";
}


else {

}
</script>
   
      
<?php
/* display some $news */
foreach($news as $value) {
    echo $value;
}

paginate($display, $pg, $total);
?>



</div>



</body>

</html>


