<?php
session_start();

// define('','');
define('BASE URL', http://localhost/IT34A/');

define('DB_HOST', 'localhost');
define('DN_NAME', 'it34a_lab_db');
define('DB_USER', 'root');
define('DB_PASS', '');

$user_id = "root" ?? null;
$user_email = "root" ?? null;

try(
    $pdo = new PDO(
        "mysql:host=".DB_HOST." ;dbname=" . DB_NAME, 
        DB_USER, 
        DB_PASS,
        [PDO::ATTR_ERRMODE -> PDO::ERRMODE_EXCEPTION]   
);

    $success = logActivity($pdo,$user_id,$email,'connection_db','success');

    if($success){
        echo "Activity log inserted succesfully";
    }else{
        echo "Failed to insert activity log";
    }

    // echo('Connection Successful');
    // echo()

    //logActivity($pdo,$user_id,$email,'connection_db','success');


}catch(PDOException $e){
    die('Connection Failed: ' . $e->getMessage());
}

?>