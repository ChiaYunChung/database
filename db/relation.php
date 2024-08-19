<?php
require_once('connection.php');
require_once('noun.php');
require_once('tag.php');
require_once('family.php');
class Relation
{
    private int $nid;
    private $tname;
    private $fname;

    public function __construct()
    {
        $tname = array();
        $fname = array();
    }

    public static function create_t($tname, $nvalue)
    {
        $relation = new Relation();
        $relation->tname = $tname;
        //nid
        $tmp = Noun::find_by_value($nvalue);
       // print_r($tmp);
        $relation->nid = $tmp["id"];
        $relation->register_t();
        return $relation;
    }

    public function register_t()
    {
        $conn = Connection::connect();
        $sql = "INSERT INTO `t_relation`(`tname`, `nid`) VALUES (:t,:n)";     # should add update option
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $response = $conn->prepare($sql);
        $response->bindParam(':t', $this->tname);
        $response->bindParam(':n', $this->nid);
        $str = '加入';
        Connection::exe($response, $str);
    }

    public static function find_t($nvalue, $tname)
    {
        $tt = 0;
        $tmp = Noun::find_by_value($nvalue);
        $nid = $tmp["id"];
        $found = array();
        foreach ($tname as $t) {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `t_relation` WHERE (`tname` = :tname AND `nid` = :nid)";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(':tname', $t);
            $response->bindParam(':nid', $nid);
            $response = Connection::exe($response, '尋找');
            $relation = $response->fetch(PDO::FETCH_ASSOC);
            if($relation) $tt = 1;
            array_push($found, $relation);
        }

        if($tt==1) return $found; //有找到
        else return false; //沒找到
    }

    public static function delete_t($tname)
    {
        $conn = Connection::connect();
        $sql = "DELETE FROM `t_relation` WHERE `tname` = :tname";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':tname', $tname);
        $response = Connection::exe($response, '關係刪除');
    }

    public static function delete_tr($tname, $nvalue)
    {
        $tmp = Noun::find_by_value($nvalue);
        $nid = $tmp["id"];
        $conn = Connection::connect();
        $sql = "DELETE FROM `t_relation` WHERE (`tname`=:tname AND `nid`=:nid)";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':tname', $tname);
        $response->bindParam(':nid', $nid);
        $response = Connection::exe($response, '關係刪除');
    }

    public static function show_t($tname)
    {
        $conn = Connection::connect();
        $sql = "SELECT `nid` FROM `t_relation` WHERE `tname` = :tname";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':tname', $tname);
        $response = Connection::exe($response, '列出');
        $response = $response->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }

    public static function create_f($fname, $nvalue)
    {
        $relation = new Relation();
        $relation->fname = $fname;
        //nid
        $tmp = Noun::find_by_value($nvalue);
        $relation->nid = $tmp["id"];
        $relation->register_f();
        return $relation;
    }

    public function register_f()
    {
        $f = $this->fname;
        $conn = Connection::connect();
        $sql = "INSERT INTO `f_relation`(`fname`, `nid`) VALUES (:f,:n)";     # should add update option
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $response = $conn->prepare($sql);
        $response->bindParam(':f', $f);
        $response->bindParam(':n', $this->nid);
        $str = '加入';
        Connection::exe($response, $str);

    }

    public static function find_f($nvalue, $fname)
    {
        $tmp = Noun::find_by_value($nvalue);
        $nid = $tmp["id"];
        $found = array();
        $tt=0;
        foreach ($fname as $f) {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `f_relation` WHERE (`fname` = :fname AND `nid` = :nid)";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(':fname', $f);
            echo $f;
            $response->bindParam(':nid', $nid);
            $response = Connection::exe($response, '尋找');
            $relation = $response->fetch(PDO::FETCH_ASSOC);
            if($relation) $tt = 1;
            array_push($found, $relation);
        }

        if($tt==1) return $found; //有找到
        else return false; //沒找到
    }

    public static function find_by_value_t($nvalue)
    {
        $tt=0;
        $tmp = Noun::find_by_value($nvalue);
        $nid = $tmp["id"];
        $conn = Connection::connect();
        $sql = "SELECT * FROM `t_relation` WHERE `nid`=:nid ";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':nid', $nid);
        $response = Connection::exe($response, '尋找');
        $noun = $response->fetch(PDO::FETCH_ASSOC);
        if($noun) $tt = 1;
        //print_r($noun);
        //return $noun;
        if($tt==0) return true;
        else return false;
        //else print('沒找到');
    }

    public static function find_by_value_f($nvalue)
    {
        $tt=0;
        $tmp = Noun::find_by_value($nvalue);
        $nid = $tmp["id"];
        $conn = Connection::connect();
        $sql = "SELECT * FROM `f_relation` WHERE `nid`=:nid ";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':nid', $nid);
        $response = Connection::exe($response, '尋找');
        $noun = $response->fetch(PDO::FETCH_ASSOC);
        if($noun) $tt = 1;
        //print_r($noun);
        //return $noun;
        if($tt==0) return true;
        else return false;
        //else print('沒找到');
    }

    public static function delete_f($fname)
    {
        $conn = Connection::connect();
        $sql = "DELETE FROM `f_relation` WHERE `fname` = :fname";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':fname', $fname);
        $response = Connection::exe($response, '關係刪除');
    }

    public static function delete_fr($fname, $nvalue)
    {
        $tmp = Noun::find_by_value($nvalue);
        $nid = $tmp["id"];
        $conn = Connection::connect();
        $sql = "DELETE FROM `f_relation` WHERE (`fname`=:fname AND `nid`=:nid)";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':fname', $fname);
        $response->bindParam(':nid', $nid);
        $response = Connection::exe($response, '關係刪除');
    }
    public static function show_f($fname)
    {
        $conn = Connection::connect();
        $sql = "SELECT `nid` FROM `f_relation` WHERE `fname` = :fname";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':fname', $fname);
        $response = Connection::exe($response, '列出');
        $response = $response->fetchAll(PDO::FETCH_ASSOC);
        return $response;
    }
    public static function delete_n($nid)
    {
        $conn = Connection::connect();
        $sql = "DELETE FROM `t_relation` WHERE `nid` = :nid";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':nid', $nid);
        $response = Connection::exe($response, '關係刪除');

        $conn = Connection::connect();
        $sql = "DELETE FROM `f_relation` WHERE `nid` = :nid";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(':nid', $nid);
        $response = Connection::exe($response, '關係刪除');
    }

}
/*Tag::create("1");
Tag::create("2");
Tag::create("3");
Family::create("a");
Family::create("b");
Family::create("c");
Noun::create("uhhhh", "em");

relation::create_f($t, "uhhhh");$t = array("a", "b", "c");
print_r(relation::find_f("uhhhh", $t));
Family::create("a");
Family::create("b");
Family::create("c");*/
//Relation::find_by_value_t('dck');
//Relation::find_by_value_t('duck');
//Relation::find_by_value_t('duk');
?>