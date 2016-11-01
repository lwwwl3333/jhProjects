<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 14:15
 */
header("Content-type:text/html;charset:utf8");
date_default_timezone_set("PRC");
define('ROOT',dirname(__DIR__) );

require ROOT.'/lib/mysql.php';
require ROOT.'/lib/func.php';
