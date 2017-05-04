<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);
  //$redis->lpush("datasetid","001");
  //$redis->hMset('dataset001',array('id'=>'001','name'=>'secondDataset','desc'=>'the second dataset'));
  $ids = $redis->lrange("datasetid",0,-1);
  $num = 0;
  foreach ($ids as $id)
  {
      $datasets[$num] = $redis->hGetAll('dataset'.$id);
      $num++;
  }
  $ans['success'] = '0';
  $ans['data'] = $datasets;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
