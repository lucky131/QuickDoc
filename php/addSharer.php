<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $datasetId = $_GET["datasetId"];
  $sharer = $_GET["sharer"];
  $operators = $redis->lrange("operator".$datasetId,0,-1);
  $flag = 1;
  foreach($operators as $operator)
  {
    if($operator==$sharer) {$flag = 0;}
  }
  if($flag==1)
  {
    $redis->rpush("sharer".$datasetId,$sharer);
    $ans['success'] = '0';
    $ans['errorInfo'] = '';
  }
  else
  {
    $ans['success'] = '1';
    $ans['errorInfo'] = 'some error';
  }
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
