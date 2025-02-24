<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once('database.php');
// // include_once('config.php'); 

// function getAllRooms()
// {
//     connecttodb();
//     $res = myselect('room');
//     return $res ;
// }

// function getallintakes()
// {
//     // //pdo
//     $res=mySelect('intake');
//     return $res;
// }

class User extends Database {

    public function getAllRooms()
    {
    // //pdo
        // $res=mySelect('intake');
        return $this->select('room');
    }


    public function getAllIntakes()
    {   //pdo
        // $res=mySelect('trainee');
        return $this->select('intake');
    }

    public function insertAllTrainees($name,$email,$password,$intake,$profile_picture)
    {
        $res = this->insert('trainee',['username','email','password','intake_id','image'],[$name,$email,$password,$intake,$profile_picture]);
    }
}

// function insert($name,$email,$password,$intake,$profile_picture)
// {
//     connecttodb();

//     $Res = myInsert('trainee',['username','email','password','intake_id','image']
//     ,[$name,$email,$password,$intake,$profile_picture]);
    
// }


?>

