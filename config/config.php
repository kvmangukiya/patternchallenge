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
    private $col_photoPath = "photoPath";


    public function insertUser($name,$email,$upass,$contact,$about,$photoPath){
        $query = "INSERT INTO $this->table_name ($this->col_name,$this->col_email,$this->col_pass,$this->col_contact,$this->col_about,$this->col_photoPath) VALUES('$name','$email','$upass','$contact','$about','$photoPath')";
        
        return mysqli_query($this->conn, $query); 
    }

    public function verifyUser($email,$pass){
        $query = "SELECT * FROM $this->table_name WHERE $this->col_email='$email'";

        $res = mysqli_query($this->conn, $query); 
        if($rec = mysqli_fetch_assoc($res)){
            if(password_verify($pass,$rec[$this->col_pass])){
                return 1;
            } else {
                return 2;
            }    
        } else {
            return 0;
        }
    }

    public function updateUser($sEditID,$name,$email,$upass,$contact,$about,$photoPath,$photoUpdateFlag=false){
        $rs = $this->getSingleRecord($sEditID);
        if(mysqli_num_rows($rs)>0) {
            if($photoUpdateFlag) {
                $rec = mysqli_fetch_assoc($rs);
                if($rec['photoPath']!="") {
                    unlink($rec['photoPath']);
                }
                $query = "UPDATE $this->table_name SET $this->col_name='$name',$this->col_email='$email',$this->col_pass='$upass',$this->col_contact='$contact',$this->col_about='$about',$this->col_photoPath='$photoPath' WHERE $this->col_id=$sEditID";
            } else {
                $query = "UPDATE $this->table_name SET $this->col_name='$name',$this->col_email='$email',$this->col_pass='$upass',$this->col_contact='$contact',$this->col_about='$about' WHERE $this->col_id=$sEditID";
            }
            if( mysqli_query($this->conn, $query)) {
                return "Record '$sEditID' updated successfully...";
            } else {
                return "Record '$sEditID' not updated. Please try again later...";
            }
        } else {
            return "Record '$sEditID' not found...";
        }
    }

    public function updatePhoto($sEditID,$photoTmpPath,$photoPath){
        $rs = $this->getSingleRecord($sEditID);
        if(mysqli_num_rows($rs)>0){
            $rec = mysqli_fetch_assoc($rs);
            if($rec['photoPath']!=""){
                unlink("../".$rec['photoPath']);
            }
            move_uploaded_file($photoTmpPath,"../".$photoPath);

            $query = "UPDATE $this->table_name SET $this->col_photoPath='$photoPath' WHERE $this->col_id=$sEditID";

            if( mysqli_query($this->conn, $query)){
                return "Photo of '$sEditID' updated successfully...";
            } else {
                return "Photo of '$sEditID' not updated. Please try again later...";
            }
        } else {
            return "Id '$sEditID' not found...";
        }
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