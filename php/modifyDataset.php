<?php
  $redis = new Redis();
  $redis->connect('127.0.0.1',6379);

  $datasetId = $_GET["datasetId"];
  $name = $_GET["name"];
  $desc = $_GET["desc"];
  $redis->hMset('dataset'.$datasetId,array('name'=>$name,'desc'=>$desc));

  $ans['success'] = 0;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
  //echo "<br>$name<br>$desc<br>$id";
?>
