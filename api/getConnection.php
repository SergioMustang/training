
<?php

class Database
{
    // укажите свои учетные данные базы данных 
    private $host = "127.0.0.1 ";
    private $port = "5432 ";
    private $db_name = "api_db ";
    private $username = "api_db ";
    private $password = "";
    public $conn;

    // получаем соединение с БД 
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = pg_connect("host=" . $this->host . "port=" . $this->port . "dbname=" . $this->db_name . "user=" .
                $this->username . "password=" . $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>

