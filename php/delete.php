<?php
    //require_once('php/login.php');
    if(isset($_COOKIE['id']) or isset($_SESSION['id'])){
        echo "Вітаю: ".$_COOKIE['name']."<br />";
        echo "<a href='../logout.php'>Вийти з профілю</a>"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Видалити користувача</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
        <h1>Видалення користувача</h1>
        <hr>
        
        <?php
            require_once('connect.php');

        //Перевірка чи передані всі поля Для GET
            if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['phone']) && isset($_GET['email'])) {
                //Витягуємо дані

                $id = $_GET['id'];
                $name = $_GET['name'];
                $phone = $_GET['phone'];
                $email = $_GET['email'];

            } else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
            } else {
                echo '<h1>Вибачте не вибрано жoдного користувача</h1>';
            }

                    //Перевірка чи передані всі поля Для POST
            if(isset($_POST['submit'])) {
                if($_POST['confirm'] == "Yes"){

                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];


                    //Зєднання з БД
                    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error to connect DB");

                    //Видалення з БД
                    $query = "DELETE FROM users WHERE id='$id' LIMIT 1";
                    mysqli_query($dbc, $query);
                    mysqli_close($dbc);

                    //Підтвердження
                    echo '<h3>'.$name.' був успішно видалений</h3>';
                } else {
                    echo '<h3>Не видалено</h3>';
                }
            } 
                    //Для GET
                    else if(isset($id) && isset($name) && isset($phone) && isset($email)){
                        echo '<h3>Ви впевнені що хочете видалити користувача?</h3>';
                        echo '<p><strong>Name: </strong>'.$name.'<br/><strong>Телефон:</strong> '.$phone.'<br/><strong>Email: </strong>'.$email.'</p>';
                        echo '<form method="post" action="delete.php">';
                        echo '<div class="form-group">';                        
                        echo '<input type="radio" name="confirm" value="Yes">Так';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<input type="radio" name="confirm" checked="checked" value="No">Ні</ br>';
                        echo '</div>';
                        echo '<input class="btn btn-danger" type="submit" name="submit" value="Видалити">';
                        echo '<input type="hidden" name="id" value="'.$id.'">';
                        echo '<input type="hidden" name="name" value="'.$name.'">';
                        echo '<input type="hidden" name="phone" value="'.$phone.'">';
                        echo '<input type="hidden" name="email" value="'.$email.'"></form>';
                    }

        ?>
        
        <br><br><hr>
            <a href="../admin.php" class="btn btn-default">&lt;&lt; Назад в панель адміністрування</a>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.js"></script>
  </body>
</html>




<?php
        
    } else {
        header("Location: ../login.html");
    }
?>