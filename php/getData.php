<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $datasetId = $_GET["datasetId"];

  $dataids = $redis->lrange('dataid'.$datasetId,0,-1);
  $num = 0;
  foreach ($dataids as $dataid)
  {
    $data[$num]['dataId'] = $dataid;
    $data[$num]['datasetId'] = $datasetId;
    $data[$num]['type'] = $redis->get('datatype'.$dataid);
    $data[$num]['data'] = $redis->hGetAll('data'.$dataid);
    $num++;
  }

  $operators = $redis->lrange("operator".$datasetId,0,-1);
  $sharers = $redis->lrange("sharer".$datasetId,0,-1);

  $datasetInfo = $redis->hGetAll('dataset'.$datasetId);
  $datasetInfo['operators'] = $operators;
  $datasetInfo['sharers'] = $sharers;

  $ans['success'] = 0;
  $ans['data'] = $data;
  $ans['errorInfo'] = '';
  $ans['datasetInfo'] = $datasetInfo;
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);

?>
