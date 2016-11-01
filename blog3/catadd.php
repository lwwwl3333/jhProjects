<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 15:37
 */
require './lib/init.php';

if (empty($_POST)){
    require './view/admin/catadd.html';
} else{
    $cat['catname']=trim($_POST['catname']);
    if(empty($cat['catname'])){
       error('栏目名不能为空');
    }
    $sql="select count(*) from cat where catname='$cat[catname]'";
    $rs=fetchRow($sql);
    if($rs!=0){
        error('栏目名重复');
    }
    $rs=insert('cat', $cat);
    if (!$rs){
        error('插入失败');
    }else{
        succ ('插入成功');

    }


}