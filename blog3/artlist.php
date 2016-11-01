<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 17:48
 */
require './lib/init.php';
    $sql="select art.* ,cat.catname from art inner join cat on cat.cat_id=art.cat_id";
    $rs=fetchAll($sql);


require ROOT.'/view/admin/artlist.html';