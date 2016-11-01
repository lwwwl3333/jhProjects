<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 17:26
 */
require './lib/init.php';
if (empty($_POST)){
    $sql="select * from cat";
    $rs=fetchAll($sql);
    require ROOT.'/view/admin/artadd.html';
}else{
    $art['title']=trim($_POST['title']);
    $art['content']=trim($_POST['content']);
    $art['cat_id']=$_POST['cat_id'];
    $art['pubtime']=time();
    if(!empty($_FILES['img']['name'] )&& $_FILES['img']['error']==0){
        $filename=".".createDir().'/'.randStr(6).getEx($_FILES['img']['name']);
        move_uploaded_file($_FILES['img']['tmp_name'],$filename );
    }
    $art['img']=$filename;
    if (empty($art['title'])){
        error('标题不能为空');
    }
    if (empty($art['content'])){
        error('内容不能为空');
    }
    if (!is_numeric($art['cat_id'])){
        error('标题号有误');
    }
    $rs=insert('art',$art );
    if(!$rs){
        error('添加文章失败');
    }else{
        succ('添加文章成功');
    }

}
