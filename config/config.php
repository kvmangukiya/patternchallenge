<?php
class Config {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "chatapp";
    private $conn;

    public function dbConnect(){
        $this->conn = mysqli_connect($this->host,$this->username,$this->password,$this->dbname);
        if($this->conn){
            // echo "Database connected !!!";
        } else {
            echo "There are some problem in database connection... !!!";
        }
    }

    private $table_name = "user";
    private $col_name = "name";
    private $col_email = "email";
    private $col_pass = "upass";
    private $col_about = "about";
    private $col_contact = "contact";


    public function insertUser($name,$email,$upass,$contact,$about){
        $query = "INSERT INTO $this->table_name ($this->col_name,$this->col_email,$this->col_pass,$this->col_contact,$this->col_about) VALUES('$name','$email','$upass','$contact','$about')";

        $res = mysqli_query($this->conn, $query);
        if($res){
            return "success";
        } else {
            return "fail";
        }
    }

    public function usersList(){
        $query = "SELECT * FROM $this->table_name ORDER BY name";

        return mysqli_query($this->conn, $query);
    }

}

?>