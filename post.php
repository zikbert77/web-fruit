<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
     <?php
        require_once('php/connect.php');

        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME) or die('Error to connet MSQL - database');

        $u_name = mysqli_real_escape_string($dbc, trim($_POST['u_name']));
        $u_phone = mysqli_real_escape_string($dbc, trim($_POST['u_phone']));
        $u_mail = mysqli_real_escape_string($dbc, trim($_POST['u_mail']));
        if(empty($u_mail)){
            $u_mail = "Невказано";
        }

            if(!empty($u_name) && !empty($u_phone)){

                $query = mysqli_query($dbc, "INSERT INTO users(name, phone, email, date) VALUES('$u_name','$u_phone','$u_mail', NOW())") or die("Error to add!");
                
                echo('<h1>Дякуємо за заявку '.$u_name.'</h1><h3>Ми звяжемося з вами найближчим часом</h3>');
            }

        mysqli_close($dbc);


    ?>
    <hr>
    <a href="index.html" class="btn btn-default">Повернутися до сайту</a>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>
   

   
  