<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $username = $_GET["username"];
  $oldPassword = $_GET["oldPassword"];
  $newPassword = $_GET["newPassword"];

  if($redis->get("user".$username))
  {
    $password = $redis->get("user".$username);
    if($password==$oldPassword)
    {
      $redis->set("user".$username,$newPassword);
      $ans['success'] = '0';
      $ans['errorInfo'] = '';
    }
    else
    {
      $ans['success'] = '1';
      $ans['errorInfo'] = 'password is wrong';
    }
  }
  else
  {
    $ans['success'] = '2';
    $ans['errorInfo'] = 'user '.$username.' not exist';
  }

  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
