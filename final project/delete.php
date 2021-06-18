<?php
require_once "pdo.php";
session_start();
if( !isset($_SESSION['acc'])  ){
    echo("Not logged in");
    return;
}

if(isset($_POST['delete']) &&  isset($_POST['autos_id']) ){
    $sql = "DELETE FROM autos WHERE autos_id = :zip";
    $stm = $pdo->prepare($sql);
    $stm->execute(array(':zip'=> $_POST['autos_id']));
    $_SESSION['success'] = "Record deleted";
    header('Location: view.php');
    return;
}

$stmt = $pdo->prepare("SELECT autos_id FROM autos where autos_id =:xyz");
$stmt->execute(array(":xyz" => $_GET['autos_id'])); 
$row= $stmt->fetch(pdo::FETCH_ASSOC);

?>

<form  method="POST"><input type="hidden" name="autos_id" value="<?= $row['autos_id']?>">

            <button type="submit"   class="btn btn-success" name="delete">Delete</button>
</form>

<form action="view.php">
<input type="submit" name="logout" value="Cancel">

</form>
