<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 offset-md-4">
            <h1 class="text-center login-title">Register</h1>
            <div class="account-wall">
                <img class="profile-img" src="img\user.png"
                    alt="">
                <form class="form-signin" method="POST" action="">
                <input type="text" name="name"  class="form-control" placeholder="Name" required>
                <input type="email" name="email"  class="form-control" placeholder="Email" required>
                <input type="text" name="phone_no"  class="form-control" placeholder="Phone no" required>
                <input type="text" name="address"  class="form-control" placeholder="Address" required>
                <input type="password"  name="password" class="form-control" placeholder="Password" required>
                <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">
                    Register</button>
                
                </form>
            </div>
            <a href="index.php" class="text-center new-account">Login Here ! </a>
        </div>
    </div>
</div>
<?php

require "config/db.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = md5($_POST['password']);

      $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->execute([':email' => $email]);

    
    if($stmt->rowCount() == 1){
        
        echo "<div class='mt20 alert alert-danger'>Email ID exists !</div>";
    
    }else{
        $stmt = $conn->prepare("INSERT INTO user VALUES (:id,:name,:email,:user_img, :phone_no,:address, :password, :signup_date)");
        
        $stmt->execute([':id' => NULL,':name' => $name,':email' => $email,':password' => $password, ':phone_no' => $phone_no,':address' => $address,':user_img' => 'img/user.png',':signup_date' => date('Y-m-d h:i:sa')]);

        if($stmt->rowCount() == 1){
            
            echo "<div class='mt20 alert alert-success'>Registration Successful :)</div>";
        }else{
            echo "<div class='mt20 alert alert-danger'>Failed :(</div>";
        }
    }
}
?>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>