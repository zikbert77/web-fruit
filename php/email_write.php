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
    <style>
        form textarea.form-control, input.form-control {
            width: 300px;
        }
      </style>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Написання повідомлення</title>

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
        <div class="row">
            <div class="col-lg-12">
                <h1>Написання повідомлення</h1><hr>
                
                <?php
                
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
                        echo 'Вибачте не вибрано жoдного користувача';
                    }
                
            //Перевірка чи передані всі поля Для POST
                if(isset($_POST['submit'])) {

                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $topic = $_POST['topic'];
                        $msg = $_POST['message'];
                    
                        if(!empty($topic) && !empty($msg)){
                        //Написання повідомлення
                        $header = "From: CodeMonster"."\r\n";
                        mail($email, $topic, $msg, $header);
                        echo('Повідомлення відправлено:'.$email.'\n');
                        } else {
                            echo('Тема, або текст повідомлення невказано!<a href="email_write.php"> Повторити</a>');
                        }
            
    } 
            //Для GET
            else if(isset($id) && isset($name) && isset($phone) && isset($email)){
                echo '<p><strong>Імя: </strong>'.$name.'<br/><strong>Телефон:</strong> '.$phone.'</br><strong>Email: </strong>'.$email.'</p>';
                echo '<form action="email_write.php" method="post">';
                echo '<div class="form-group">';
                echo '<label for="topic">Тема</label>';
                echo '<input type="text" class="form-control" name="topic" id="topic">';
                echo ' </div>';
                echo '<div class="form-group">';
                echo '<label for="message">Введіть повідомлення</label>';
                echo '<textarea name="message" class="form-control" id="message" rows="5"></textarea>';
                echo ' </div>';
                echo '<button type="submit" class="btn btn-primary" name="submit">Відправити</button>';
                echo '<input type="hidden" name="id" value="'.$id.'">';
                echo '<input type="hidden" name="name" value="'.$name.'">';
                echo '<input type="hidden" name="phone" value="'.$phone.'">';
                echo '<input type="hidden" name="email" value="'.$email.'">';
                echo '</form>';
            }
    
                
                
                
                
                ?>

                <br><br><hr>
                <a href="../admin.php" class="btn btn-default">Назад в панель адміністрування</a>
            </div>
        </div>
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