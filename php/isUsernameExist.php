<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $username = $_GET["username"];

  $ans['data'] = 'false';
  if($redis->get("user".$username))
    $ans['data'] = 'true';
  
  $ans['success'] = '0';
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
