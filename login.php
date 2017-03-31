<?php
session_start();

if(isset($_POST['submit'])){
    if(isset($_POST['u_login']) && isset($_POST['u_pass'])){
        
        $login = $_POST['u_login'];
        $password = $_POST['u_pass'];
        
    require_once('php/connect.php');
        
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error to connect");
        $query = "SELECT * FROM admins WHERE login='$login' AND password=SHA('$password')";
        $data = mysqli_query($dbc, $query) or die("Error to query");
        
        if(mysqli_num_rows($data) == 1){
            $row = mysqli_fetch_array($data);
                setcookie("login", $row['login'], time()+50000);
                setcookie("id", $row['id'], time()+500000);
                setcookie("name", $row['name'], time()+500000);
                
                $_SESSION['id'] = $row['id'];
                header("Location: admin.php");
                exit();
        } else {
            echo "Pidar";
        }
    
    } else {
        echo "Enter login and password"."<a href='login.html'>Back</a>";
    }
} else {
    echo "no submit";
}


?>