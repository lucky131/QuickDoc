<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);
  //$redis->lpush("datasetid","001");
  //$redis->hMset('dataset001',array('id'=>'001','name'=>'secondDataset','desc'=>'the second dataset'));
  $username = $_GET["username"];
  $ids = $redis->lrange("datasetid",0,-1);
  $num = 0;
  foreach ($ids as $id)
  {
    $flag = 0;
    $author = $redis->hGet('dataset'.$id,'author');
    if($author==$username) {$flag = 1;}
    $operators = $redis->lrange("operator".$id,0,-1);
    $sharers = $redis->lrange("sharer".$id,0,-1);
    foreach ($operators as $operator)
    {
      if($operator==$username) {$flag = 1;}
    }
    foreach ($sharers as $sharer)
    {
      if($sharer==$username) {$flag = 1;}
    }
    if($flag==0) {continue;}
    $datasets[$num] = $redis->hGetAll('dataset'.$id);
    $datasets[$num]['operators'] = $operators;
    $datasets[$num]['sharers'] = $sharers;
    $num++;
  }
  $ans['success'] = '0';
  $ans['data'] = $datasets;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
?>
