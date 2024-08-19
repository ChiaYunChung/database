<?php
class Connection
{
    private static $conn;

    static public function connect()
    {
        if (!empty(self::$conn)){
            return self::$conn;
        } else {
            try {
                $username = "root";
                $password = "";
                $host     = "localhost";
                $dbname   = "database";

                self::$conn = new PDO("mysql:host=$host; dbname=$dbname", $username, $password, array(
                    PDO::ATTR_PERSISTENT => true
                ));
                return self::$conn;
            } catch (PDOException $error) {
                echo '連接錯誤' . $error->getMessage();
                return null;
            }
        }
    }
    static public function exe($response, $str)
    {
        try 
        {
            if ($response->execute())
            {
                //echo $str . '成功';
            }
            else
            {
                echo $str . '失敗';
                echo "\nPDO::errorInfo():\n";
                print_r(self::$conn->errorInfo());
                print_r($response->errorInfo());
            }
        }
        catch (PDOException $e) 
        {
            echo $str . '失敗';
        }
        self::$conn = null;
        return $response;
    }
}