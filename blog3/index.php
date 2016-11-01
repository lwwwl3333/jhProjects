<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 20:31
 */
require './lib/init.php';

if (isset($_GET['cat_id'])){
    $where=" and art.cat_id=$_GET[cat_id]";
} else{
    $where='';
}
$sql = 'select count(*) from art where 1 '.$where;
$num = fetchRow($sql); //获取总文章数
$cnt = 2;//每页显示2篇文章
$curr = isset($_GET['page']) ? $_GET['page'] : 1 ;//当前页码数 从地址栏的page值获取
$pages = cPager($num,$cnt,$curr);


$sql="select art.*,cat.catname from art left join cat on cat.cat_id=art.cat_id where 1"
    .$where." order by art_id desc limit ".($curr-1)*$cnt.','.$cnt;
$rs=fetchAll($sql);

$sql="select * from cat";
$cats=fetchAll($sql);
require ROOT.'/view/front/index.html';