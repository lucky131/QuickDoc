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

  $ans['success'] = 0;
  $ans['data'] = $data;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);

?>
