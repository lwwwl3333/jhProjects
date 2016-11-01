<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 16:32
 */
require './lib/init.php';
$cat_id=$_GET['cat_id'];
if (!is_numeric($cat_id)){
    error('栏目id不合法');
}
$sql="select count(*) from cat where cat_id=$cat_id";
$rs=fetchRow($sql);
if($rs==0){
    error('不存在该栏目');
}else {
    if (empty($_POST)){
        $sql="select catname from cat where cat_id=$cat_id";
        $rs=fetchRow($sql);
        require ROOT.'/view/admin/catedit.html';
    }else {
        $cat['catname']=trim($_POST['catname']);
        if ($cat['catname']==''){
            error('栏目名不能为空');
        }
        $sql="select count(*) from cat where catname='$cat[catname]'";
        $rs=fetchRow($sql);
        if($rs!=0){
            error('栏目名已经存在');
        }
        $rs=update('cat',$cat ,"cat_id=$cat_id");
        if (!$rs){
            error('修改失败');
        }else {
            header('location:catlist.php');
        }

    }
}
