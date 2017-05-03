<?php
  function randId()
  {
    $a = "";
    for($i=0;$i<11;$i++)
    {
      $a = $a.rand(0,9);
    }
    return $a;
  }

  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $jsonData = $_REQUEST["jsonData"];
  $obj = json_decode($jsonData);
  $datasetId = $obj->datasetId;
  $data = $obj->data;


  $dataids = $redis->lrange('dataid'.$datasetId,0,-1);
  foreach($dataids as $dataid)
  {
    $keys = $redis->hKeys('data'.$dataid);
    foreach($keys as $key)
    {
      $redis->hDel('data'.$dataid,$key);
    }
  }
  $redis->lTrim('dataid'.$datasetId,1,0);
  for($i=0;$i<count($data);$i++)
  {
    $dataId = randId();
    $redis->rpush('dataid'.$datasetId,$dataId);
    $redis->hMset('data'.$dataId,array("id"=>$dataId));
    foreach ($data[$i] as $key => $value)
    {
      $redis->hMset('data'.$dataId,array($key=>$value));
    }
  }

  $ans['success'] = 0;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);

?>
