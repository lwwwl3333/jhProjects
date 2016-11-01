<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 16:13
 */
require './lib/init.php';

$sql="select * from cat ";
$cat=fetchAll($sql);
require ROOT.'/view/admin/catlist.html';