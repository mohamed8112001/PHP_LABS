

<?php
// session_start();
session_start(); 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once('templetes/header.php');
// include_once('templetes/menu.php');
include_once('blogic.php');
// include_once('database.php');

// $db = new Database(); 
// $conn = $db->getConnection();
$blogic = new User();
print_r($blogic->getAllRooms());    

?>

    <header>
        <!-- <h1> <?php echo $_SESSION['username'];?> </h1> -->
    </header>


  
</form>
    <form action="saveData.php" method=post enctype="multipart/form-data"> 
    <label for="">Name</label><br>
    <input type="text" name="name" placeholder="Enter your name">
    <br>
    <label for="">email</label><br>
    <input type="email" name="email" placeholder="Enter your email"><br>
    <label for="">password</label><br>
    <input type="password" name="password" placeholder="Enter your password"><br>
    <label for="">Confirm Password</label><br>
    <input type="password" name="Cpassword" placeholder="Confirm your password"><br>
    <label for="">Room No.</label><br>
    <select name="room" id="">
        <?php
        $rooms = $blogic->getAllRooms();
        // var_dump($rooms);
        foreach($rooms as $room)
        {
           echo "<option value=".$room['id'].">". $room['name']."</option>";
        }    
        // ?>
    </select>
    <br>
    <select name="intake" id="">
        <?php
        $intakes = $blogic->getAllIntakes();
        var_dump($intakes);
        foreach($intakes as $intake)
        {
           echo "<option value=".$intake['id'].">". $intake['name']."</option>";
        }    
        // ?>
    </select>
    <br>
 
    <label for="">Ext.</label><br>
    <input type="text" name=ext><br>
    <label for="">Picture</label><br>
    <input type="file" name=picture><br>
    <input type="submit"name=send><br>
</form>
<?php
include_once('templetes/footer.php');


