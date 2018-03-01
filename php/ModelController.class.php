<?php
class ModelController{
    private $dsn="mysql:host=localhost;dbname=bw";
    private $username="root";
    private $password="root";
    public static $pdo;
    //避免重复连接数据库
    //构造函数，只要实例化类的时候，就自动执行该函数
    function __construct(){
        //第一次连接数据库的时候，走这一步，以后都走静态static(内存)
        if(is_null(self::$pdo)){
            try{
                self::$pdo=new Pdo($this->dsn,$this->username,$this->password);
            }catch (Exception $e){
                die($e->getMessage());
            }
        }
    }
    /*
     * query查询方法
     */
    public function query_sql($sql){
        try{
            self::$pdo->query("SET NAMES UTF8");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result=self::$pdo->query($sql);
            $row=$result->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
    /*
     * delete删除方法
     */
    public function delete_sql($table,$id){
        try{
            self::$pdo->query("SET NAMES UTF8");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result=self::$pdo->exec("DELETE FROM {$table} WHERE id={$id}");
            return $result;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    /*
     * delete1删除方法
     */
    public function delete_sql1($sql){
        try{
            self::$pdo->query("SET NAMES UTF8");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result=self::$pdo->exec($sql);
            return $result;
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
    /*
     * add添加方法
     */
    public function add($table,$data){
        try{
//          变成适合sql插入的格式
//            $arr=Array(
//              "username" => "sdf",
//              "password" => "dsf"
//            );
//            INSERT INTO users(username,password) VALUES('sdf',''dsf);
            $keys=implode(",",array_keys($data));
            $values="'".implode("','",$data)."'";
//            p($values);
//            echo $keys;
            self::$pdo->query("SET NAMES UTF8");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result=self::$pdo->exec("INSERT INTO {$table}({$keys}) VALUES({$values})");
            return $result;
        }catch (Exception $e){
            echo
            die($e->getMessage());
        }
    }

    /*
     * update更新方法
     */
    public function update($table,$data,$id){
        try{
//          变成适合sql插入的格式
//            $arr=Array(
//              "username" => "sdf",
//              "password" => "dsf"
//            );
            //update user set username='sdf',password='dsf' where id=2;
            $sql="";
            foreach($data as $k=>$v){
                $sql.=",$k='$v'";
//                p($sql);
            }
            $sql=substr($sql,1);
//            p($sql);
//            die;
            self::$pdo->query("SET NAMES UTF8");
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $result=self::$pdo->exec("UPDATE {$table} SET {$sql} WHERE id={$id}");
            return $result;
        }catch (Exception $e){
            echo
            die($e->getMessage());
        }
    }

}