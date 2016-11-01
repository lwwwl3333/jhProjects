<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 18:16
 */
require './lib/init.php';
$art_id=$_GET['art_id'];
 $sql="select * from cat";
 $rs=fetchAll($sql);
if (empty($_POST)){
    $sql="select * from art where art_id=$art_id";
    $art=fetchOne($sql);
    require ROOT.'/view/admin/artedit.html';
}else{
    $art['title']=trim($_POST['title']);
    $art['content']=trim($_POST['content']);
    if (empty($art['title'])){
        error('标题不能为空');
    }
    if (empty($art['content'])){
        error('内容不能为空');
    }
    if (!is_numeric($art_id)){
        error('文章id错误');
    }
    $sql="select count(*) from art where art_id=$art_id";
    $rs=fetchRow($sql);
    if ($rs==0){
        error('文章不存在');
    }
    $rs=update('art',$art,"art_id=$art_id" );

    if (!$rs){
        error('修改文章失败');
    }else{
        header('location:artlist.php');
    }
}