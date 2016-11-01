<?php
/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/22
 * Time: 14:14
 */

/**
 * 连接数据库
 * @return mysqli
 */
function connect(){
    $con=mysqli_connect('localhost','root','root','blog3','3307');
    mysqli_set_charset($con, 'utf8');
    return $con;

}

/**
 *  查询操作
 * @param $sql  sql语句
 * @return bool|mysqli_result 成功返回true,失败返回result
 */
function query($sql){
    $rs=mysqli_query(connect(),$sql );
    if (!$rs){
        return false;
    }
    else{
        return $rs;
    }

}


/**
 * 查询多条记录
 * @param $sql  sql语句
 * @return array|bool  成功返回一个二维数组,失败返回false
 */
function fetchAll($sql){
    $rs=query($sql);
    if (!$rs){
        return false;
    }else {
        while ($row=mysqli_fetch_assoc($rs)){
            $rows[]=$row;
        }
        return $rows;
    }
}

/**
 * 查询一条记录
 * @param $sql sql语句
 * @return array|bool|null  成功返回一个一维数组,失败返回false
 */
function fetchOne($sql){
    $rs=query($sql);
    if(!$rs){
        return false;
    }else{
        $row=mysqli_fetch_assoc($rs);
        return $row;
    }
}

/**
 * 返回一条记录的一列
 * @param $sql 查询语句
 * @return mixed|bool 失败返回false 成功返回一条记录的一列
 */
function fetchRow($sql){
    $rs=query($sql);
    if(!$rs){
        return false;
    }else{
        $row=mysqli_fetch_row($rs)[0];
        return $row;
    }
}

/**
 * 完成数据添加操作
 * @param $table
 * @param $arr
 * @return bool|mysqli_result
 */
function insert($table,$arr){
    $keys=implode(',',array_keys($arr) );
    $values=implode("','",array_values($arr) );
    $sql='insert into '.$table.'('.$keys.') values (\''.$values.'\')';
    return query($sql);
}
//insert into cat(cat_id,catname) values ('1','sda');

/**
 * 完成数据修改操作
 * @param $table
 * @param $arr
 * @param int $where
 * @return bool|mysqli_result
 */
function update($table,$arr,$where=0){
  foreach ($arr as $k=>$v) {
      $str .= "$k='$v',";
  }
      $sql="update $table set $str";
      $sql.=rtrim($str,',');
      $sql=$sql.' where '.$where;
      return query($sql);

}
//update cat set catname='ca',cat_id='1' where
//$arr=array('312'=>2131,'412'=>21312);
//echo update('cat', $arr,"id=5");

/**
 * 完成记录删除操作
 * @param $table
 * @param where $
 * @return bool|mysqli_result
 */
function delete($table,$where=0){
    $sql="delete from $table where $where";
    return query($sql);

}
