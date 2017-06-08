<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $id = $_GET["id"];

  $keys = $redis->hKeys('dataset'.$id);
  foreach ($keys as $key)
  {
    $redis->hDel('dataset'.$id,$key);
  }
  $redis->lRem('datasetid',$id, 1);

  $dataids = $redis->lrange('dataid'.$id,0,-1);

  foreach($dataids as $dataid)
  {
    $redis->delete("datatype".$dataId);
    $redis->delete("databelong".$dataId);
    $redis->delete("datatype".$dataId);
    $keys = $redis->hKeys('data'.$dataid);
    foreach($keys as $key)
    {
      $redis->hDel('data'.$dataid,$key);
    }
  }

  $redis->lTrim('dataid'.$id,1,0);
  $redis->lTrim('operator'.$id,1,0);
  $redis->lTrim('sharer'.$id,1,0);
  $ans['success'] = 0;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);

?>
