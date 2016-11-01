<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 15:41
 */

function succ($reg){
    $msg='success';
    require ROOT.'/view/admin/info.html';
    exit();
}

function error($reg){
    $msg='error';
    require  ROOT.'/view/admin/info.html';
    exit;
}

/**
 * 创建存储图片的路径
 * @return bool|string
 */
function createDir(){
    $path='/images/'.date('Y/m/d',time());
    $apath=ROOT.$path;
    if(is_dir($apath)||mkdir($apath,0777,true)){
        return $path;
    }else{
        return false;
    }
}

/**
 * 获取随机字符串
 * @param int $num
 * @return string
 */
function randStr($num=6){
    $chars=implode('',array_merge(range('a','z' ),range('A','Z' ),range(0,9 )) );
    $str=str_shuffle($chars);
    if ($num>strlen($str)){
        exit('尼玛参数太大了');
    }
    return substr($str, 0,$num);
}

/**
 * 获取后缀名(带.)
 * @param $str
 * @return string
 */
function getEx($str){
   return strrchr($str, '.');

}

/**
 * @param int $num 文章的总数
 * @param int $cnt 每页显示的文章数
 * @param int $curr 当前显示的页码数
 * @return array
 */
function cPager($num,$cnt,$curr){
    //计算最大页码数 $max
    $max=ceil($num/$cnt);
    //计算最左边的页码数
    $left=max(1,$curr-2);
    $right=min($max,$left+4);
    //$left=$right-4;
    $left=max($right-4,1);
    for ($i=$left;$i<=$right;$i++){
        $_GET['page']=$i;
        $pages[$i]=http_build_query($_GET);
    }
    return $pages;
}

//<?php foreach($pages as $k=>$v)  { ?>
<!--    --><?php //if($k==$curr){  ?>
<!--        --><?php //echo $k ;} else { ?>
<!--        <a href="index.php?--><?php //echo $v;?><!--">--><?php //echo $k;?><!-- </a>-->
<!--    --><?php //}}?>