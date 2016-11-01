<?php

/**
 * Created by PhpStorm.
 * User: whj
 * Date: 16/9/24
 * Time: 11:41
 */
class Mysql
{
    public $link;

    public function __construct()
    {
        $this->conn();
    }

    /**
     * mysqli 连接
     * @return mysqli
     */
    public function conn()
    {
        $cfg = array(
            'host' => 'localhost',
            'user' => 'root',
            'pwd' => 'root',
            'db' => 'blog3',
            'port' => '3306’,
            'charset' => 'utf8'
        );
        $this->link = mysqli_connect($cfg['host'], $cfg['user'], $cfg['pwd'], $cfg['db'], $cfg['port']);
        mysqli_set_charset($cfg['charset']);
        return $this->link;
    }

    /**
     * mysqli 查询语句
     * @param $sql
     * @return bool|mysqli_result
     */
    public function query($sql)
    {
        $rs = mysqli_query($this->conn(), $sql);
        if ($rs) {
            $this->mLog($sql);
        } else {
            $this->mLog($sql . "\n" . mysql_error);
        }
        return $rs;
    }

    /**
     * 查询多条语句
     * @param $sql
     * @return array
     */
    public function fetchAll($sql)
    {
        $rs = $this->query($sql);
        while ($row = mysqli_fetch_assoc($rs)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * 查询一条sql语句
     * @param $sql
     * @return array|null
     */
    public function fetchOne($sql)
    {
        $rs = $this->query($sql);
        return mysqli_fetch_assoc($rs);
    }

    /**
     * 查询一条记录中的一个单元
     * @param $sql
     * @return mixed
     */
    public function fetchRow($sql)
    {
        $rs = $this->query($sql);
        return mysqli_fetch_row($rs)[0];

    }

    /**
     * 完成数据添加操作
     * @param $table
     * @param $arr
     * @return bool|mysqli_result
     */
    public function insert($table, $arr)
    {
        $keys = implode(',', array_keys($arr));
        $values = implode("','", array_values($arr));
        $sql = "insert into $table ($keys) values ('$values')";
        return $this->query($sql);
    }
    //insert into cat (cat_id,catname) values ('123','21412');

    /**
     * 完成数据删除操作
     * @param $table
     * @param $arr
     * @param int $where
     * @return bool|mysqli_result
     */
    public function update($table, $arr, $where = 0)
    {
        foreach ($arr as $k => $v) {
            $str .= $k . "='" . $v . "',";
            $sql = "update $table set $str";
            $sql .= rtrim($str, ',');
            $sql .= " where $where";
            return $this->query($sql);
        }
    }
    //$arr=array('cat'=>'123','cart'=>'312');
    //$bb=new Mysql();
    //echo $bb->insert('cat', $arr);
    //update cat set cat_id='1',catname="s12313" where;

    /**
     * 完成数据删除操作
     * @param $table
     * @param int $where
     * @return bool|mysqli_result
     */
    public function delete($table, $where = 0)
    {
        $sql = "delete from $table where $where";
        return $this->query($sql);
    }

    public function mLog($msg)
    {
        $path = './test' . '/' . date('Y-m-d', time()) . '.txt';
        $data = "---\n" . date('Y-m-d', time()) . "\n" . $msg . "\n---\n\n";
        return file_put_contents($path, $data, FILE_APPEND);

    }
}

$arr = array('cat_id' => 63, 'catname' => '壮大了');
$bb = new Mysql();
$bb->insert('cat', $arr);
