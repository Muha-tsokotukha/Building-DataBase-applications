<?php 
require_once "pdo.php";
session_start();
if( !isset($_SESSION['acc'])  ){
    echo("Not logged in");
    return;
}

if (  isset($_POST['make']) &&  isset($_POST['model']) &&  isset($_POST['mileage']) &&  isset($_POST['year'])  )
{
    
    if(isset(  $_POST['edit'])){
        $can = true;
        if( !is_numeric($_POST['year'])   ){
            #echo "Mileage and year must be numeric";
            $_SESSION['problem'] = "Year must be an integer";
            $can = false;
            header("Location: edit.php" );
            return;
        }
        if(!is_numeric($_POST['mileage'])    ){
            #echo "Mileage and year must be numeric";
            $_SESSION['problem'] = "Mileage must be an integer";
            $can = false;
            header("Location: edit.php" );
            return;
        }
        if( (strlen($_POST['make'] ) < 1) || (strlen($_POST['model'] ) < 1) || (strlen($_POST['year'] ) < 1) || (strlen($_POST['mileage'] ) < 1) ){
            #echo "Make is required";
            $_SESSION['problem'] = "All fields are required";
            $can = false;
            header("Location: edit.php" );
            return;
        }
        
        
        
if($can){
    $sql = "UPDATE autos SET make = :make,
    mileage = :mileage, year = :year, model= :model 
    WHERE autos_id= :autos_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':mileage' => $_POST['mileage'],
        ':year' => $_POST['year'],
        ':model' => $_POST['model'],
        ':autos_id' => $_POST['autos_id']));
    

    $_SESSION['success'] = "Record edited";
    header("Location: view.php");
    return;
    }
    

    
    }
    



}
$stmt = $pdo->prepare("SELECT * FROM autos where autos_id =:xyz");
$stmt->execute(array(":xyz" => $_GET['autos_id'])); 
$row= $stmt->fetch(pdo::FETCH_ASSOC);

$autos_id = $row['autos_id'];
$mk = htmlentities($row['make']);
$md = htmlentities($row['model']);
$yr = htmlentities($row['year']);
$ml = htmlentities($row['mileage']);
?>


<?php 
if (  isset($_SESSION['problem']) ){
    echo($_SESSION['problem']);
    unset($_SESSION['problem']);
}
?>

<p>Edit data</p>
<form method="post">
<p>Make:
<input type="text" name="make" value="<?= $mk ?>" >
</p>
<p>Model:
<input type="text" name="model" value="<?= $md ?>" >
</p>
<p>Year:
<input type="text" name="year" value="<?= $yr ?>" >
</p>
<p>Mileage:
<input type="text" name="mileage" value="<?= $ml ?>">
</p>
<input type="hidden" name='autos_id' value="<?= $autos_id ?>">
<button type="submit"   class="btn btn-success" name="edit">Save</button>

</form>
<form action="view.php">
<input type="submit" name="logout" value="Cancel">
