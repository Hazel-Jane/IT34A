<?php
 function logActivity($pdo,$user_id,$email,$action,$status,='success'){
    try{
        //Get client Ip Address
        $ip + $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $SERVER['REMOTE_ADDR'] ?? 'Unknown';
        
        //string to array
        if (strpos($ip,',') !== false){
            $ip = trim(explode(',', $ip)[0]);
        }

        // get user agent (browser)
        $user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',0,255);

        //querry
        $stmt = $pdo->prepare("
         INSERT INTO activity_logs(
            user_id,
            user_email,
            activity_log_action,
            activity_log_status,
            activity_log_ip_address,
            activity_log_user_agent,
        ) VALUES (?,?,?,?,?,?)
        ");

        //Execute the INSERT
        $success = $stmt->execute([
            $user_id,
            $user_email,
            $action,
            $status,
            $ip,
            $user_agent
        ]);
        
    }catch(PDOException $e){
        error_log("Activity Log Error:" .$e->Message());
        return false;
    }
 }
?>