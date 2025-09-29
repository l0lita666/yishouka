<?php
include 'config.php';
include 'CardDes.php';

$data=$_POST;

$card=new Card(base64_encode(DESKEY));

$data['customerId']= PID;

$data['cardNumber']=$card->encrypt(isset($data['cardNumber'])?$data['cardNumber']:'');

$data['cardPassword']=$card->encrypt(isset($data['cardPassword'])?$data['cardPassword']:'');

$data['sign']=md5Verify($data,KEY);

$result=vpost(URL,$data);

echo $result;
