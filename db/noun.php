<?php
require_once('connection.php');
require_once('relation.php');
class Noun
{
    private int $id;
    private string $value;
    private string $explain;

    public function __construct()
    {
    }

    public static function create($value, $explain)
    {
        $noun = new Noun();
        //$noun->id = $id;
        $noun->value = htmlspecialchars($value);
        $noun->explain = htmlspecialchars($explain);
        $noun->register();
        return $noun;
    }

    public function register()
    {
        if (Noun::find_by_value($this->value)) {
            return "已存在";
        } else {
            $conn = Connection::connect();
            $sql = "INSERT INTO `noun`(`value`, `exp`) VALUES (:v,:e)";     # should add update option
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $response = $conn->prepare($sql);
            $response->bindParam(':v', $this->value);
            $response->bindParam(':e', $this->explain);
            $str = '加入';
            Connection::exe($response, $str);
        }
    }

    public static function find_by_value($value)
    {
        $conn = Connection::connect();
        $sql = "SELECT * FROM `noun` WHERE `value`=? ";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(1, $value);
        $response = Connection::exe($response, '尋找');
        $noun = $response->fetch(PDO::FETCH_ASSOC);
        //print_r($noun);
        return $noun;
    }

    public static function delete($value)
    {
        $tmp = Noun::find_by_value($value);
        
        relation::delete_n($tmp['id']);
        $conn = Connection::connect();
        $sql = "DELETE FROM `noun` WHERE `value` =?";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(1, $value);
        $response = Connection::exe($response, '刪除');
    }

    public static function update($value, $exp)
    {
        $conn = Connection::connect();
        $sql = "UPDATE `noun` SET`exp`=? WHERE `value`=?";     # should add update option
        $response = $conn->prepare($sql);
        $response->bindParam(1, $exp);
        $response->bindParam(2, $value);
        $response = Connection::exe($response, '更新');
    }

    public static function show_tn($tname)
    {
        $nid_list = Relation::show_t($tname);
        $found = array();
        foreach ($nid_list as $l) {
            $l = $l["nid"];
            $conn = Connection::connect();
            $sql = "SELECT * FROM `noun` WHERE `id` = ?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $l);
            $response = Connection::exe($response, '列出');
            $response = $response->fetch(PDO::FETCH_ASSOC);
            array_push($found, $response);
        }
        return $found;
    }
    public static function show_fn($fname)
    {
        $nid_list = Relation::show_f($fname);
        $found = array();
        foreach ($nid_list as $l) {
            $l = $l["nid"];
            $conn = Connection::connect();
            $sql = "SELECT * FROM `noun` WHERE `id` = ?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $l);
            $response = Connection::exe($response, '列出');
            $response = $response->fetch(PDO::FETCH_ASSOC);
            array_push($found, $response);
        }
        return $found;
    }

}
//Noun::create("123", "123");
//Noun::delete("uhhhh");
//Noun::create("456", "......");
//Noun::create("567", "222222");
//Noun::create("678", "OSososos");
//Relation::create_t(array("OS"), "456");
//Relation::create_t(array("OS"), "567");
//Relation::create_t(array("OS"), "678");
/*$all = Noun::show_tn("OS");
foreach($all as $a)
{
    echo $a['id'] . ", " . $a['value'] . ": ". $a['exp'] . "<br/>";
}*/
?>