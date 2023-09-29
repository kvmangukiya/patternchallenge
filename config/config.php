<?php
class Config {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "chatapp";
    private $conn;

    public function __construct(){
        $this->conn = mysqli_connect($this->host,$this->username,$this->password,$this->dbname);
        if($this->conn){
            // echo "Database connected !!!";
        } else {
            echo "There are some problem in database connection... !!!";
        }
    }

    private $table_name = "user";
    private $col_id = "id";
    private $col_name = "name";
    private $col_email = "email";
    private $col_pass = "upass";
    private $col_about = "about";
    private $col_contact = "contact";


    public function insertUser($name,$email,$upass,$contact,$about){
        $query = "INSERT INTO $this->table_name ($this->col_name,$this->col_email,$this->col_pass,$this->col_contact,$this->col_about) VALUES('$name','$email','$upass','$contact','$about')";

        return mysqli_query($this->conn, $query); 
    }

    public function updateUser($sEditID,$name,$email,$upass,$contact,$about){
        $query = "UPDATE $this->table_name SET $this->col_name='$name',$this->col_email='$email',$this->col_pass='$upass',$this->col_contact='$contact',$this->col_about='$about' WHERE $this->col_id=$sEditID";

        return mysqli_query($this->conn, $query);
    }

    public function usersList($li){
        $query = "SELECT * FROM $this->table_name ORDER BY $this->col_id LIMIT $li";

        return mysqli_query($this->conn, $query);
    }
    
    public function getSingleRecord($id){
        $query = "SELECT * FROM $this->table_name WHERE $this->col_id=$id";

        return mysqli_query($this->conn, $query);
    }

    public function deleteUser($id){
        $query = "DELETE FROM $this->table_name WHERE $this->col_id=$id";
        
        return mysqli_query($this->conn, $query);
    }

}

?>