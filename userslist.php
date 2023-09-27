<?php
include("config/config.php");

$config = new Config();

$res = $config->usersList();
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
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Contact</th>
                <th scope="col">About</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($rec = mysqli_fetch_array($res)){                       
                ?>
                <tr>
                    <th scope="row"><?php echo $rec['id']; ?></th>
                    <td><?php echo $rec['email']; ?></td>
                    <td><?php echo $rec['name']; ?></td>
                    <td><?php echo $rec['contact']; ?></td>
                    <td><?php echo $rec['about']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>