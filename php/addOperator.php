<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $datasetId = $_GET["datasetId"];
  $operator = $_GET["operator"];
  $redis->lRem("sharer".$datasetId,$operator, 1);
  $redis->rpush("operator".$datasetId,$operator);
  $ans['success'] = '0';
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
