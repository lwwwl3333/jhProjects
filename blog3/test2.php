<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/26
 * Time: 22:36
 */

function myLoad($class){
    require './'.$class.'.class.php';

}
spl_autoload_register('myLoad');//注册一个函数为自动触发的函数
                                //new不存在的类 会返回来找此函数

$b=new BBB();
echo $b->e();

//new CCC();