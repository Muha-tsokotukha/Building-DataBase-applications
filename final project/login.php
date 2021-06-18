<?php // Do not put any HTML above this line
session_start();

if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}


$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1'; 




if ( isset($_POST['email']) && isset($_POST['pass']) ) {
    unset($_SESSION["acc"]);
    
    
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
        $_SESSION["error"] = "User name and password are required"; 
        header('Location: login.php');
        return;
    } 
    if(strpos($_POST['email'],"@") != true ){
        $_SESSION["error"] = "Email must have an at-sign (@)"; 
        header('Location: login.php');
        return;
    }
    else {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) {
            
            error_log("Login success ".$_POST['email']);
            $_SESSION["success"] = "Logged in"; 
            $_SESSION["acc"] = $_POST['email']; 
            header('Location: view.php');
            return;

        } else {
            $_SESSION['error'] = "Incorrect password";
            header('Location: login.php');
            return;
        }
    }
}

// Fall through into the View
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "bootstrap.php"; ?>
<title>Mukhit Nassyrov</title>
</head>
<body>
<div class="container">
<h1>Please Log In</h1>
<?php



    if (isset($_SESSION['error'])){
        echo( '<p style="color:red">'.$_SESSION['error']."</p>\n"  );
        unset($_SESSION['error']);
    }

    if( isset($_SESSION['success']) ){
        echo( '<p style="color:green">'.$_SESSION['success']."</p>\n"  );
        unset($_SESSION['success']);
    }



?>
<form method="POST">
<label for="nam">User Name</label>
<input type="text" name="email" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>

</p>
</div>
</body>
