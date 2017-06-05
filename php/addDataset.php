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

  $author = $_GET["author"];
  $name = $_GET["name"];
  $desc = $_GET["desc"];
  $createTime = date("Y-m-d H:i:s");
  $id = randId();
  $redis->lpush("datasetid",$id);
  $redis->hMset('dataset'.$id,array('datasetId'=>$id,'author'=>$author,'name'=>$name,'desc'=>$desc,'createTime'=>$createTime));

  $ans['success'] = 0;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);
  //echo "<br>$name<br>$desc<br>$id";
?>
