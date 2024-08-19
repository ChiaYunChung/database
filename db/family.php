<?php
    require_once('connection.php');
    require_once('relation.php');
    class Family
    {
        private string $name;

        public function __construct()
        {
        }

        public static function create($name)
        {
            $family = new Family();
            //$family->id = $id;
            $family->name = htmlspecialchars($name);
            $family->register();
            return $family;
        }
        
        public function register()
        {
            if(Family::find_by_name($this->name))
            {
                return "已存在";
            }
            else
            {
                $conn = Connection::connect();
                $sql = "INSERT INTO `family`(`name`) VALUES (:n)";     # should add update option
                $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
                $response = $conn->prepare($sql);
                $response->bindParam(':n',$this->name);
                $str = '加入';
                Connection::exe($response, $str);
            }
        }

        public static function find_by_name($name)
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `family` WHERE `name`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $name);
            $response = Connection::exe($response, '尋找');
            $family = $response->fetch(PDO::FETCH_ASSOC);
            //print_r($family);
            return $family;
        }

        public static function delete($name)
        {
            Relation::delete_f($name);
            $conn = Connection::connect();
            $sql = "DELETE FROM `family` WHERE `name` =?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $name);
            $response = Connection::exe($response, '刪除');
        }

        public static function show()
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `family`";     # should add update option
            $response = $conn->prepare($sql);
            $response = Connection::exe($response, '列出');
            $response = $response->fetchAll(PDO::FETCH_ASSOC);
            return $response;
        }
    }
    //Family::delete("123");
    
?>