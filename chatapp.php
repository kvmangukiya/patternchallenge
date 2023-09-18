<?php
include("config/config.php");

$config = new Config();

$config->dbConnect();

$res = $config->usersList();

$submit = @$_REQUEST['create_user'];

if (isset($submit)) {
    $uname = $_POST['uname'];
    $email = $_POST['uemail'];
    $pass = $_POST['upass'];
    $contact = $_POST['contact'];
    $about = $_POST['about'];

    $res = $config->insertUser($uname,$email,$pass,$contact,$about);
    if($res){
        header('Location: userslist.php');
    } else {
        echo "Error in user creation...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <div class="container pt-5">
        <form method="post" action="">
            <div class="mb-3">
                <label for="uname" class="form-label">Name</label>
                <input type="text" class="form-control" id="uname" name="uname">
            </div>
            <div class="mb-3">
                <label for="uemail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="uemail" name="uemail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="upass" class="form-label">Password</label>
                <input type="password" class="form-control" id="upass" name="upass">
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" aria-describedby="contactHelp">
                <div id="contactHelp" class="form-text">We'll never share your contact with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="about" class="form-label">About</label>
                <input type="text" class="form-control" id="about" name="about">
            </div>
            <button type="submit" class="btn btn-primary" name = "create_user" value="SUBMIT">Submit</button>
        </form>
    </div>
</body>
</html>