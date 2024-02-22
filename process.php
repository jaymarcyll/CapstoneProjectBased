<?php 
 
 include 'conn.php'; 
 session_start();

 //for account registration 

 if(isset($_POST['register'])){
    $fullname   = $_POST['fullname'];
    $id_number  = $_POST['id_number'];
    $address    = $_POST['address'];
    $contact    = $_POST['contact'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $user_type  = $_POST['user_type'];
    $department = $_POST['department'];

    //checking if email exist
    $check_email = mysqli_query($conn,"SELECT * FROM accounts WHERE email = '$email'");
    $email_num   = mysqli_num_rows($check_email);

    if($email_num >= 1){
        ?>
            <script>
                alert("This email already taken!");
                window.location.href='index.html';
            </script>
        <?php
    }else{
        //inserting data to database 

        $insert = mysqli_query($conn,"INSERT INTO accounts VALUE('0','$id_number','$fullname','$address','$contact','$email','$password','$user_type','$department')");

        if($insert == true){
            ?>
                <script>
                    alert('Successfully registered!');
                    window.location.href='index.html';
                </script>
            <?php
        }
    }
 }

 //admin login 

 if(isset($_POST['admin_login'])){
    $admin_email = $_POST['email'];
    $admin_pass  = $_POST['password'];

    $login      = mysqli_query($conn,"SELECT * FROM admin WHERE email = '$admin_email' AND password = '$admin_pass'");
    $login_num  = mysqli_num_rows($login);

   
    if($login_num >= 1){
        $_SESSION['email'] = $admin_email;
        ?>
            <script>
                alert("Login Success Welcome Admin!");
                window.location.href='admin';
            </script>
        <?php
    }else{
        ?>
            <script>
                alert("Wrong Email or Address!");
                window.location.href='index.html';
            </script>
        <?php
    }
    
 }


?>