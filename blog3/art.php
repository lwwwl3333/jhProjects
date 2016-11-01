<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/10/4
 * Time: 14:43
 */

require './libs/init.php';
$art_id=$_GET['art_id'];
if (!is_numeric($art_id)){
    header("location:index.php");
}
$sql="select count(*) from art where art_id=$art_id";
$rs=fetchRow($sql);
if (!$rs){
    header("location:index.php");
}
if(!empty($_POST)){
    
}