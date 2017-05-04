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

  $ans['success'] = 0;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);

?>
