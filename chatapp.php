<?php
include("config/config.php");

$config = new Config();

$res = "";
$unameedit = "";
$uemailedit = "";
$upassedit = "";
$contactedit = "";
$aboutedit = "";
$photoedit = "user_profile_photos/default.jpg";
$edit_id = 0;

$submit = @$_REQUEST['create_user'];
if (isset($submit)) {
    $uname = $_POST['uname'];
    $email = $_POST['uemail'];
    $pass = $_POST['upass'];
    $contact = $_POST['contact'];
    $about = $_POST['about'];
    $photoPath = $_POST['fileToUpload'];

    $res = $config->insertUser($uname,$email,$pass,$contact,$about,$photoPath);
    if($res){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !!</strong> User successfully created !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Fail !!</strong> Record does not inserted !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
$editUser = @$_REQUEST['edit_user'];
if (isset($editUser)) {
    $edit_id = $_POST['edit_id'];

    $rse = $config->getSingleRecord($edit_id);
    if($rs=mysqli_fetch_assoc($rse)){
        $unameedit = $rs['name'];
        $uemailedit = $rs['email'];
        $upassedit = $rs['upass'];
        $contactedit = $rs['contact'];
        $aboutedit = $rs['about'];
        $photoedit = $rs['photoPath'];
    } 
}
$updateUser = @$_REQUEST['update_user'];
if (isset($updateUser)) {
    $sEditID = $_POST['sedit_id'];
    $uname = $_POST['uname'];
    $email = $_POST['uemail'];
    $pass = $_POST['upass'];
    $contact = $_POST['contact'];
    $about = $_POST['about'];
    $photoPath = $_POST['fileToUpload'];

    $res = $config->updateUser($sEditID,$uname,$email,$pass,$contact,$about);
    if($res){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !!</strong> User successfully updated !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Fail !!</strong> Record does not updated !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}
$deleteUser = @$_REQUEST['delete_user'];
if (isset($deleteUser)) {
    $delete_id = $_POST['delete_id'];

    $rec = $config->getSingleRecord($delete_id);
    if(mysqli_num_rows($rec)>0){            
        $userData = mysqli_fetch_assoc($rec);
        $userPhotoPath = $userData['photoPath'];

        $rsd = $config->deleteUser($delete_id);
        if($rsd){
            if($userPhotoPath!=""){
                unlink($userPhotoPath);
            }
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success !!</strong> User successfully deleted !!!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Fail !!</strong> Please try after some time !!!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Fail !!</strong> User data not found !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
}

$rec_list = $config->usersList(100);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        img {
            border-radius: 50%;
        }
    </style>
    <title>Chat App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <div class="container pt-5">
        <form method="post" action="">
            <div class="mb-3">
                <label for="uname" class="form-label">Name</label>
                <input type="text" class="form-control" id="uname" name="uname" value='<?php echo $unameedit ?>'>
            </div>
            <div class="mb-3">
                <label for="uemail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="uemail" name="uemail" value="<?php echo $uemailedit ?>" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="upass" class="form-label">Password</label>
                <input type="password" class="form-control" id="upass" name="upass" value="<?php echo $upassedit ?>">
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contactedit ?>" aria-describedby="contactHelp">
                <div id="contactHelp" class="form-text">We'll never share your contact with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="about" class="form-label">About</label>
                <input type="text" class="form-control" id="about" name="about" value="<?php echo $aboutedit ?>">
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <img src="<?php echo $photoedit == "" ? "user_profile_photos/default.jpg": $photoedit; ?>" class="form-control" style="width:100px">
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
            </div>
            <?php if($edit_id>0) {  ?>
                <td><input type="hidden" id="sedit_id" name="sedit_id" value="<?php echo $edit_id; ?>"></td>
                <button type="submit" class="btn btn-primary" name = "update_user" value="Update">Update</button>
            <?php } else { ?>
                <button type="submit" class="btn btn-primary" name = "create_user" value="Submit">Submit</button>
            <?php } ?>
        </form>
    </div>
    <div class="container pt-2">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Photo</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Contact</th>
                <th scope="col">About</th>
                <th scope="col" colspan="2" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($rec = mysqli_fetch_array($rec_list)){                       
                ?>
                <tr>
                    <th scope="row"><?php echo $rec['id']; ?></th>
                    <td><img src="<?php echo $rec['photoPath']; ?>" style="height:50px"></td>
                    <td><?php echo $rec['email']; ?></td>
                    <td><?php echo $rec['name']; ?></td>
                    <td><?php echo $rec['contact']; ?></td>
                    <td><?php echo $rec['about']; ?></td>   
                    <form name="edit" method="post" action="">
                        <td><input type="hidden" id="edit_id" name="edit_id" value="<?php echo $rec['id']; ?>"></td>
                        <td><button type="submit" class="btn btn-primary" name = "edit_user" value="Edit">Edit</button></td>
                    </form>
                    <form name="delete" method="post" action="">
                        <td><input type="hidden" id="delete_id" name="delete_id" value="<?php echo $rec['id']; ?>"></td>
                        <td><button type="submit" class="btn btn-primary" name = "delete_user" value="Delete">Delete</button></td>
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>