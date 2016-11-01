<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 16:25
 */
require './lib/init.php';
$cat_id=$_GET['cat_id'];
if(!is_numeric($cat_id)){
    error("栏目号不合法");
}
$sql="select count(*) from cat where cat_id=$cat_id";
$rs=fetchRow($sql);
if($rs==0){
    error('不存在此栏目');
}
$rs=$sql="select count(*) from art where cat_id=$cat_id";
if($rs!=0){
    error('请先删除该栏目下的文章');
}

$rs=delete('cat',"cat_id=$cat_id");
if(!$rs){
    error("删除失败");
}else{
    header('location:catlist.php');
}
