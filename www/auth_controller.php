<?php
$login = $_GET['login'];
if (!$login) {
    echo "'login' not found";
    exit;
}

$password = $_GET['password'];
if (!$password) {
    echo "'password' not found";
    exit;
}

$db = new
  PDO("mysql:host=localhost;dbname=pv111;
  charset=UTF8", "pv111_user", "pv111_pass");

  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC) ;
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
  $db->setAttribute(PDO::ATTR_PERSISTENT, true) ;

$result = $db->query("SELECT * FROM users WHERE login = '$login'");
if ($result->rowCount() > 0) {
   
    $user_info = $result->fetch();

} else {

    echo "User with login - '$login' not found.";
}

echo json_encode($user_info);
exit;

?>