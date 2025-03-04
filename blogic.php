<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// include_once('mysqlipro.php');
// include_once('mysqlioop.php');
include_once('database.php');

function getallintakes()
{
    // //pdo
    $res=mySelect('intake');
    return $res;
}
function getalltrainees()
{   //pdo
    $res=mySelect('trainee');
    return $res;
}

// function deleteUser() {
//     $id = $_GET['user_id'] ?? null;

//     if ($id) {
//         $deletedRows = mydelete("trainee", "user_id = :id", [":id" => $id]);  // Fix binding issue
//         if ($deletedRows) {
//             header("Location: AllUsers.php"); 
//             exit; // Stop further execution
//         } else {
//             echo "Error deleting user.";
//         }
//     } else {
//         echo "No user ID provided.";
//     }
// }

// function trainevalis($email)
// {
    
// }

// function inserttrainee( $username, $email, $password, $intake_id,$image) {
//     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//     $stmt = $conn->prepare("INSERT INTO users (username, email, password,intake_id, image) VALUES (?, ?, ?, ?, ?)");
//     return $stmt->execute([$username, $email, $hashedPassword,$intake_id,$image]);
// }
function inserttrainee($username,$email,$password,$intake_id,$image)
{
    $res=myinsert('trainee',['username','email','password','intake_id','profile_image'],
    [$username,$email,$password,$intake_id,$image]);
    
    if($res>0)
    {return '<div><h1>customer added</h1></div>';}
    else
    {return '<div><h1>Error while Customer adding </h1></div>';}
}


// class User extends Database {

//     public function getallintakes()
//     {
//     // //pdo
//         // $res=mySelect('intake');
//         return $this->select('room');
//     }
//     public function getalltrainees()
//     {   //pdo
//         // $res=mySelect('trainee');
//         return $this->select('trainee');
//     }
// }
