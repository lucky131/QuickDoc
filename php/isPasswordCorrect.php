<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $username = $_GET["username"];
  $password = $_GET["password"];
  $ans['data'] = 'false';
  $rightpw = $redis->get("user".$username);
  if($password==$rightpw)
    $ans['data'] = 'true';
  if($rightpw==false)
    $ans['data'] = 'false';
  $ans['success'] = '0';
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
