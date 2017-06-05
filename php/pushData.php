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
  //$obj = $_POST["jsonData"];
  $datasetId = $obj->datasetId;
  $data = $obj->data;


  $dataids = $redis->lrange('dataid'.$datasetId,0,-1);
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
  $redis->lTrim('dataid'.$datasetId,1,0);
  for($i=0;$i<count($data);$i++)
  {
    $num = 0;
    foreach ($data[$i] as $key => $value)
    {
      if($key=='_empty_') {continue;}
      $num++;
    }
    if($num==0) {continue;}
    $dataId = randId();
    $type = $data[$i]->type;
    $redis->rpush('dataid'.$datasetId,$dataId);
    //$redis->hMset('data'.$dataId,array("dataid"=>$dataId,"datasetid"=>$datasetId,"type"=>$type));
    $redis->set("datatype".$dataId,$type);
    $redis->set("databelong".$dataId,$datasetId);
    if($type=="kv")
    {
      foreach ($data[$i]->data as $key => $value)
      {
        if($key=='_empty_') {continue;}
        $redis->hMset('data'.$dataId,array($key=>$value));
      }
    }
    if($type=="image")
    {
      $url = $data[$i]->data->url;
      $redis->hMset('data'.$dataId,array("url"=>$url));
    }
    if($type=="text")
    {
      $text = $data[$i]->data->text;
      $redis->hMset('data'.$dataId,array("text"=>$text));
    }
  }

  $ans['success'] = 0;
  $ans['errorInfo'] = '';
  echo json_encode($ans,JSON_UNESCAPED_UNICODE);

?>
