

<?php
session_start();
error_reporting(E_ALL); 
ini_set('display_errors', 1);

include_once('templetes/header.php');
?>
<form method="post" >
    <label for="">user name</label><br>
    <input type="text" name="Username" id=""><br> 
    <label for="">password</label><br>
    <input type="text" name="Password" id=""><br>
    <input type="submit" name=send>
</form>
<?php

$values=['mohamed','123'];
if(isset($_POST['send']))
{   
    // if(trim($_POST['UserName'])==$values[0]and trim($_POST['Password'])==$values[1] )
    if(trim($_POST['Username'])==$values[0]&&trim($_POST['Password'])==$values[1])
    {
        $_SESSION['username']=$_POST['Username'];
        header('location:http://localhost/test/home.php');
    }
    else
    {
        echo '<div><h1> invalid login</h1></div>';
    }
}

include_once('templetes/footer.php');

?>

