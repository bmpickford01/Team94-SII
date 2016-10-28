
<?php
require '../inc/header.inc';
require '../inc/check.inc';
require '../inc/setPDO.inc';

if (isset($_POST['login'])){ //If logged in, redirect to index page
            if (checkLogin($_POST['email'], $_POST['password'])){
                if (!isset($_SESSION)){
                    session_start(); 
                    $_SESSION['loggedIn'] = true;
                    //echo "Logged In";
                    header("Location: http://{$_SERVER['HTTP_HOST']}/Team94-SII/pages/index.php");
                    exit();
                }
                else {
                    $_SESSION['loggedIn'] = true;
                    //echo "Logged In";
                    header("Location: http://{$_SERVER['HTTP_HOST']}/Team94-SII/pages/index.php");
                    exit();
                }
            }
            else {
                echo "Login FAILED";
            }
	   }
?>
<html>
<body>
<?php
    session_start();
 //Checks whether already logged in or not
        if(isset($_SESSION['loggedIn'])){
            unset($_SESSION['loggedIn']);
            unset($_SESSION['id']);
			unset($_SESSION['userType']);
            header("Location: http://{$_SERVER['HTTP_HOST']}/Team94-SII/pages/index.php");
            exit();
        }
		
		else {
			header("Location: http://{$_SERVER['HTTP_HOST']}/Team94-SII/pages/register.php");
		}
?>
</body>
</html>