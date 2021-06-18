<?php 
session_start();
if( !isset($_SESSION['acc'])  ){
    echo("Not logged in");
    return;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Mukhit Nassyrov</title>

<!-- Latest compiled and minified CSS
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
 -->
<!-- Optional theme 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
-->
</head>
<body>
<div class="container">
<h1>Tracking Autos for <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="eb9a9c8e999f92c59e80ab8c868a8287c5888486">[email&#160;protected]</a></h1>


<?php 

if(  isset($_SESSION['success'])  ){
    echo( "<p style=color:green>".$_SESSION['success']."</p>\n"   );
    unset($_SESSION['success']);    
}


?>


<h2>Welcome to the Automobiles Database</h2>
<?php   
require_once "pdo.php";
$stm = $pdo->query("SELECT make,model,year,mileage,autos_id FROM autos" );
$stm2 = $pdo->query("SELECT make,model,year,mileage,autos_id FROM autos" );
$no = false;
if( $stm2->fetch(pdo::FETCH_ASSOC) == "" ){
    echo('No rows found');
    $no = true;
}
if( !$no ){
echo('<table border="1">'."\n");
    while($row = $stm->fetch(pdo::FETCH_ASSOC)){
        echo("<tr><td>");
        echo(htmlentities($row['make'])  );
        echo("</td><td>");
        echo(htmlentities($row['model'])  );
        echo("</td><td>");
        echo(htmlentities($row['year'])  );
        echo("</td><td>");
        echo(htmlentities($row['mileage']) );
        echo("</td><td>");
        echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a>/');
        echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>/');
        echo("\n</form>\n");
        echo("</td></tr>\n");
    } 
}
?>
</table>
<p>
<a href="add.php">Add New Entry</a></p>
<p> |
<a href="logout.php">Logout</a>
</p>

</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
