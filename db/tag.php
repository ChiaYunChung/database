<?php
    require_once('connection.php');
    require_once('relation.php');
    class Tag
    {
        private string $name;

        public function __construct()
        {
        }

        public static function create($name)
        {
            $tag = new Tag();
            //$tag->id = $id;
            $tag->name = htmlspecialchars($name);
            $tag->register();
            return $tag;
        }
        
        public function register()
        {
            if(Tag::find_by_name($this->name))
            {
                return "已存在";
            }
            else
            {
                $conn = Connection::connect();
                $sql = "INSERT INTO `tag`(`name`) VALUES (:n)";     # should add update option
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
            $sql = "SELECT * FROM `tag` WHERE `name`=? ";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $name);
            $response = Connection::exe($response, '尋找');
            $tag = $response->fetch(PDO::FETCH_ASSOC);
            //print_r($tag);
            return $tag;
        }

        public static function delete($name)
        {
            Relation::delete_t($name);
            $conn = Connection::connect();
            $sql = "DELETE FROM `tag` WHERE `name` =?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $name);
            $response = Connection::exe($response, '刪除');
        }

        public static function show()
        {
            $conn = Connection::connect();
            $sql = "SELECT * FROM `tag`";     # should add update option
            $response = $conn->prepare($sql);
            $response = Connection::exe($response, '列出');
            $response = $response->fetchAll(PDO::FETCH_ASSOC);
            return $response;
        }
    }
    //Tag::delete("2");
    
    
?>