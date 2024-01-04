<?php
require_once("connection.php");

function CheckDoubleDevice($username, $connection){
    $stmt = $connection->prepare("SELECT user_agent FROM user_sessions WHERE username = ? AND user_agent IS NOT NULL AND user_agent <> '';");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();  

    if($result->num_rows > 0){
        return true;
    }else{
        return false;
    }
}   
function AutoLogout($iscontrollers){
    if($iscontrollers === true){
        echo '<script>alert("Please re-login!");window.location.href="logoutc.php";</script>'; 
        return;
    }else{
        echo '<script>alert("Please re-login!");window.location.href="controllers/logoutc.php";</script>'; 
        return;
    }
}
function session_check($username, $connection, $iscontrollers) {
    date_default_timezone_set('Asia/Jakarta');
    $currentSessionId = session_id();
    $stmt = $connection->prepare("SELECT * FROM user_sessions WHERE username = ? ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dbSessionId = $row['session_id'];
            $loginStatus = $row['login_status'];
            $lastOnline  = $row['activity_timestamp'];
            $storedUserAgent = $row['user_agent'];
            $storedTimestamp = strtotime($lastOnline);
            $differenceInMinutes = round((time() - $storedTimestamp) / 60);

            if ($currentSessionId === $dbSessionId && $loginStatus === 0) {
                AutoLogout($iscontrollers);
                
            }else if($differenceInMinutes > 5 && $loginStatus === 1){
                AutoLogout($iscontrollers);       

            }else if(strcmp($userAgent, $storedUserAgent) != 0 && $loginStatus === 1){
                AutoLogout($iscontrollers);
                
            }
        }
    }
 

}


function update_activity($username, $connection, $iscontrollers){
    session_check($username, $connection, $iscontrollers);
    $login_status = true;
    $stmt = $connection->prepare("UPDATE user_sessions SET activity_timestamp = NOW() ,login_status = ?  WHERE username= ?" );
    $stmt->bind_param("ss", $login_status,  $username);
    $stmt->execute();    
}
?>


