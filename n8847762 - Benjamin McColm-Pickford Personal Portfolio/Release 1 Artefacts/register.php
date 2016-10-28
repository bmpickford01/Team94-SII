<!DOCTYPE html>
<?php
require '../inc/header.inc';
require '../inc/check.inc';
require '../inc/setPDO.inc';

?>
<html>
	<body>
		<?php
        require '../inc/nav.inc';  
		?>
		
        <div class="container-fluid register">

            <br><br><br><br>
            <div class="row"> <!--Start login form-->
                <div class="col-md-6 text-center login">
                    <form id="loginForm" name="loginForm" method="post" action="login.php">
                        <h4>Login Here</h4><br>
                        <table align="center">
                            <tr>
                                <td class="l">Email: </td>
                                <td class="r"><input type="email" name="email" id="email" required></td>
                            </tr>
                            <tr>
                                <td class="l">Password: </td>
                                <td class="r"><input type="password" name="password" id="password" required></td>
                            </tr>
                        </table><br><br>
                        <input type="submit" name="login" value="Login" onclick="return validateLogin();"> <!--returns javascript validation -->
                    </form>
                <!--END login form-->
                </div>
                <div class="col-md-6 text-center reg">
                    <h4>Register Here</h4><br> <!--Start registration form-->
                    <form id="regForm" name="regForm"  action="complete.php" onsubmit="return validateReg()" method="post">
                        <table align="center">
                            <tr>
                                <td class="l">First Name: </td>
                                <td class="r"><input type="text" name="fName" required></td>
                            </tr>
                            <tr>
                                <td class="l">Surname: </td>
                                <td class="r"><input type="text" name="sName" required></td>
                            </tr>
                            <tr>
                                <td class="l">Email: </td>
                                <td class="r"><input type="email" name="email" required></td>
                            </tr>
                            <tr>
                                <td class="l">Password: </td>
                                <td class="r"><input type="password" name="password1" required></td>
                            </tr>
                            <tr>
                                <td class="l">Verify Password: </td>
                                <td class="r"><input type="password" name="password2" required></td>
                            </tr>
                        </table><br><br>
                        <input type="submit" value="Register"> <!--returns javascript validation -->
                    </form>
                </div><!--END registration form-->
            </div>
            <?php //Footer include
            require '../inc/footer.inc';
            ?>
        </div>
    </body>
</html>
