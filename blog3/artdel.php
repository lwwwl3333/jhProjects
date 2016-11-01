<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 18:10
 */
require './lib/init.php';
$art_id=$_GET['art_id'];
if (!is_numeric($art_id)){
    error('请根据文章号删除文章');
}
$sql="select count(*) from art where art_id=$art_id";
$rs=fetchRow($sql);
if ($rs==0){
    error('文章不存在');
}
$rs=delete('art',"art_id=$art_id");
if (!$rs){
    error('文章删除失败');
}else {
    header('location:artlist.php');
}
