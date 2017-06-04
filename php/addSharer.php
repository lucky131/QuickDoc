<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $datasetId = $_GET["datasetId"];
  $sharer = $_GET["sharer"];
  $redis->rpush("sharer".$datasetId,$sharer);
  $ans['success'] = '0';
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
