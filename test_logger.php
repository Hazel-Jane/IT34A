<?php
require_once ('config/config.php');
require_once ('includes/activity-logger.php');


$user_id ='root';
$user_email = 'haze@localhost.com';

$success = logActivity($pdo, $user_id, $user_email, 'test_activity', 'success');

try{
    if ($success) {
        echo "Test activity log inserted successfully.";
    } else {
        echo "Failed to insert test activity log.";
    }
}catch(PDOException $e){
    echo 'Error: ' . $e->getMessage();
}
?>