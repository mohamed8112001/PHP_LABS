<?php


error_reporting(E_ALL); 
ini_set('display_errors', 1); 
include_once('blogic.php');
include_once('config.php');
include_once('database.php');
// $db = new Database();
// $pdo = $db->getPDO();
// include_once('.php');
// $host = "127.0.0.1"; // or "localhost"
// $database = "test";
// $username = "root"; // Ensure this is correct
// $password = "Mohamed@8112001"; // Ensure this is correct
echo "📌 Trying to connect with: Username: $username, Password: $password";



 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
   
    $errors=[];
    $validationData=[];

    if(empty($_POST['name']))
    {
        $errors[] = 'name is requred';
    }
    else
    {
        $validationData['name'] = htmlspecialchars(trim($_POST['name']));
        $name =$validationData['name'] ;
    }

    if(empty($_POST['email']))
    {
        $errors[]='email is requred';
    }
    else
    {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $validationData['email'] = htmlspecialchars(trim($_POST['email']));
        }
        else
        {
            $errors[]= 'invalid email format.';
        }
    }

    // if (isset($_POST['password'])) {
    //     $password = trim($_POST['password']);
    // } else {
    //     $errors[] = 'Password is required';
    // }
    // if(empty($_POST['password']))
    // {
    //     $errors[]='password is requred';
    // }
    // else
    // {
    //     $password = trim($_POST['password']);
    //     if(strlen($password)<8)
    //     {
    //         $error[]='invalid password format the password shoud be 8 or more';
    //     }
    //     elseif(!preg_match("/[a-z]/",$password) || !preg_match("/[A-Z]/",$password) || !preg_match("/[0-9]/",$password) )
    //     {
    //         $errors[]='invalid password format the password shoud content 1 c and 1 upper and 1 lower';
    //     }
    //     else
    //     {
    //         $validationData['password'] = password_hash($password, PASSWORD_DEFAULT);
           
    //     }
        
    // }
    if(empty($_POST['Cpassword']))
    {
        $errors[] = 'Cpassword is requred';
    }
    else
    {
        // if($_POST['Cpassword'] !== $_POST['password'])
        // {
        //     $errors[] = 'password and confirm password not match';
        // }   
    }
    if(empty($_POST['intake']))
    {
        $errors[]='intake is requred';
    }
    else
    {
        $validationData['intake'] = htmlspecialchars(trim($_POST['intake']));
        $intake =$validationData['intake'] ;
    }
    if(empty($_POST['ext']))
    {
        $errors[]='ext is requred';
    }
    else
    {
        $validationData['ext'] = htmlspecialchars(trim($_POST['ext']));
        $ext =$validationData['ext'] ;
    }  
    if (isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
        if ($_FILES['picture']['error'] == 0) {
            $upload_dir = "uploads/";
    
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true); // Create the directory if it doesn't exist
            }
    
            $file_name = time() . "_" . basename($_FILES["picture"]["name"]);
            $file_path = $upload_dir . $file_name;
            $file_type = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    
            $allowed_types = ["jpg", "jpeg", "png", "gif"];
    
            if (!in_array($file_type, $allowed_types)) {
                $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            } elseif ($_FILES["picture"]["size"] > 5 * 1024 * 1024) {
                $errors[] = "File size should not exceed 5MB.";
            } else {
                if (move_uploaded_file($_FILES["picture"]["tmp_name"], $file_path)) {
                    $profile_picture = $file_path;
                } else {
                    $errors[] = "Failed to upload image.";
                }
            }
        } else {
            $errors[] = "File upload error: " . $_FILES['picture']['error'];
        }
    } else {
        $profile_picture = "No Image"; // Set a default value if no file is uploaded
    }
    
    
         
}
    



 if(!empty($errors))
 {
    foreach($errors as $error)
    {
        echo "<h3>$error</h3>";
    }
 }
 else
 {
    $user_data = implode(",", [
            $validationData['name'],
            $validationData['email'],
            $validationData['password'],
            $validationData['intake'],
            $validationData['ext'],
            isset($profile_picture) ? $profile_picture : "" // إضافة الصورة

        ]) . PHP_EOL;

    file_put_contents('data.txt', $user_data, FILE_APPEND);
    // $db = new Database(); // تأكد أن الاتصال يتم إنشاؤه قبل أي عمليات أخرى
    // $pdo = $db->getPDO();
    $blogic = new User();
    $blogic->insertAllTrainees($validationData['name'], $validationData['email'], $validationData['password'], 
           $validationData['intake'], $profile_picture);
    // insert();

 }


 $output = fopen("data.txt","r");
 if(file_exists("data.txt"))
 {
    $lines = file("data.txt" ,FILE_IGNORE_NEW_LINES);
 }
 echo '
 <table border="1" style="text-align: center; border-collapse: collapse; font-size: 0.8rem; letter-spacing: 1px; font-family: sans-serif; width: 90%; margin: 20px auto;">
    <thead style="background-color: #333; color: white;">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Intake </th>
            <th>Ext</th>
            <th>Profile Picture</th>
        </tr>
    </thead>
    <tbody>';
    foreach($lines as $line)
    {
        $data = explode(",", $line);
        $name = $data[0] ?? "";
        $email = $data[1] ?? "";
        $password = $data[2] ?? "";
        $intake = $data[3] ?? "";
        $ext = $data[4] ?? "";
        $profile_picture = $data[5] ?? "No Image";
                echo "<tr>";
        echo "<td>$name</td>";
        echo "<td>$email</td>";
        echo "<td>$password</td>";
        echo "<td>$intake</td>";
        echo "<td>$ext</td>";
        echo "<td>";
        if ($profile_picture !== "No Image") {
            echo "<img src='$profile_picture' width='50' height='50' >";
        } else {
            echo "No Image";
        }
        echo "</td>";
        echo "</tr>";

    }
    echo "</tboody></table>";
    // insert($name,$email,$password,$intake,$ext,$profile_picture);
// print_r($lines);
fclose($output);
 
?>


