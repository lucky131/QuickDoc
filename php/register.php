<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $username = $_GET["username"];
  $password = $_GET["password"];
  if(!$redis->get("user".$username))
  {
    $redis->set("user".$username,$password);
    $ans['success'] = '0';
    $ans['errorInfo'] = '';
  }
  else
  {
    $ans['success'] = '1';
    $ans['errorInfo'] = 'user '.$username.' exist';
  }

  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
