<?php 
session_start();
if( isset($_SESSION['success']) ){
    header("Location: view.php");
    exit();
}
if( !isset($_SESSION['acc'])  ){
    echo("Please log in");
    return;
}
?>



<!DOCTYPE html>
<html>
<head>
<title>Mukhit Nassyrov</title>
<?php require_once "bootstrap.php";
      require_once "pdo.php";
?>
</head>
<body>
<div class="container">



<?php

if(isset(  $_POST['Add'])){
$can = true;
if( (strlen($_POST['make'] ) < 1) || (strlen($_POST['model'] ) < 1) || (strlen($_POST['year'] ) < 1) || (strlen($_POST['mileage'] ) < 1) ){
    #echo "Make is required";
    $_SESSION['problem'] = "All fields are required";
    $can = false;
    header("Location: add.php" );
    return;
}
if( !is_numeric($_POST['year'])   ){
    #echo "Mileage and year must be numeric";
    $_SESSION['problem'] = "Year must be an integer";
    $can = false;
    header("Location: add.php" );
    return;
}
if(!is_numeric($_POST['mileage'])    ){
    #echo "Mileage and year must be numeric";
    $_SESSION['problem'] = "Mileage must be an integer";
    $can = false;
    header("Location: add.php" );
    return;
}


if($can){
$stmt = $pdo->prepare('INSERT INTO autos
(make, year, mileage, model) VALUES ( :mk, :yr, :mi, :mo)');

$stmt->execute(array(
':mk' => htmlentities($_POST['make']),
':yr' => $_POST['year'],
':mi' => $_POST['mileage'],
':mo' => $_POST['model'])
);

$_SESSION['success'] = "added";
header("Location: add.php");
}

}
?>


<?php 
if (  isset($_SESSION['problem']) ){
    echo($_SESSION['problem']);
    unset($_SESSION['problem']);
}
?>



<form  method="POST">
            <p>
            Make: <input type="text" name="make">
            </p>
            <p>
            Year:   <input type="text" name="year">
            </p>
            <p>
            Mileage: <input type="text" name="mileage">
            </p>
            <p>
            Model: <input type="text" name="model">
            </p>
            <button type="submit"   class="btn btn-success" name="Add">Add</button>

</form>
<form action="view.php">
<input type="submit" name="logout" value="Cancel">

</form>

</body>
</html>