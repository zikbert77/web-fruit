<?php
    //require_once('php/login.php');
    if(isset($_COOKIE['id']) or isset($_SESSION['id'])){
        echo "Вітаю: ".$_COOKIE['name']."<br />";
        echo "<a href='logout.php'>Вийти з профілю</a>"
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CodeMonster - Admin</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="js/slide/style.css">
        <link rel="stylesheet" type="text/css" href="js/slide/jquery.mCustomScrollbar.css">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"/>
        <!--Font-Awesome-->
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <style>
            div, span {
                color: black;
            }
            h1 {
                color: black;
            }
            .user-messages {
                text-align: left;
                border: 1px solid rgba(183, 183, 183, 0.39);
                padding: 25px;
                width: 300px;
                float: left;
                margin: 35px;
            }
            span.small {
                font-size: 18px;
                font-weight: 100;
            }
        </style>
    </head>
    <body>
        
        <div class="container">
            <div class="row">
                <h1>Панель адміністрування сайту <a href="index.html">CodeMonster</a></h1><hr>
                <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                      <li class="active"> <a data-toggle="pill" href="#home">Непрочитані повідомлення&nbsp; <span class="badge"><?php
                          
                          require_once('php/connect.php');
                          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error to connect");
                        
                          $query = "SELECT * FROM users WHERE approved=0 ORDER BY date ASC";
                          $data = mysqli_query($dbc, $query) or die("Error to query"); 
                          $i=0;
                            while($row = mysqli_fetch_array($data)){
                                $i++;
                            }
                          echo $i;
                          
                          ?></span></a></li>
                      <li><a data-toggle="pill" href="#menu1">Прочитані повідомлення</a></li>
                      <li><a data-toggle="pill" href="#menu2">Розсилка</a></li>
                      <li><a data-toggle="pill" href="#menu3">FTP - MySQL</a></li>
                    </ul>
                    <div class="tab-content">    
                        
                        <?php
                          require_once('php/connect.php');
                          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error to connect");
                        
                          $query = "SELECT * FROM users WHERE approved=0 ORDER BY date DESC";
                          $data = mysqli_query($dbc, $query) or die("Error to query");
                        
                          echo('
                          <div id="home" class="tab-pane fade in active text-center">
                            <h3>Непрочитані повідомлення</h3>
                            <hr>');
                        
                            while($row = mysqli_fetch_array($data)){
                              echo('<div class="user-messages">'); 
                              echo('<span>'.$row['name'].' <br> <span class="small">'.$row['phone'].' <br> '.$row['email'].'<br> '.$row['date'].'</span><br><br></span>');
                                
                                echo('<a href="php/email_write.php?id='.$row['id'].'&amp;name='.$row['name'].'&amp;phone='.$row['phone'].'&amp;email='.$row['email'].'" class="btn btn-default btn-block">Написати на E-mail</a>');
                                
                                echo('<a href="php/approve.php?id='.$row['id'].'&amp;date='.$row['date'].'&amp;name='.$row['name'].'&amp;phone='.$row['phone'].'&amp;email='.$row['email'].'" class="btn btn-primary btn-block">Передзвонено</a>');
                                
                                echo('<a href="php/delete.php?id='.$row['id'].'&amp;name='.$row['name'].'&amp;phone='.$row['phone'].'&amp;email='.$row['email'].'" class="btn btn-danger btn-block">Видалити</a>');
                                echo('</div>');
                            }
                            
                        echo('
                            </div>
                            ');
                          
                          ?>
                      
                      
                      
                      
                      
                      <div id="menu1" class="tab-pane fade text-center">
                        <?php
                          require_once('php/connect.php');
                          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Error to connect");
                        
                          $query = "SELECT * FROM users WHERE approved=1 ORDER BY date DESC";
                          $data = mysqli_query($dbc, $query) or die("Error to query");
                        
                          echo('
                          <div id="home" class="tab-pane fade in active text-center">
                            <h3>Прочитані повідомлення</h3>
                            <hr>');
                        
                            while($row = mysqli_fetch_array($data)){
                              echo('<div class="user-messages">'); 
                              echo('<span>'.$row['name'].' <br> <span class="small">'.$row['phone'].' <br> '.$row['email'].'<br> '.$row['date'].'</span><br><br></span>');
                                
                                echo('<a href="php/email_write.php?id='.$row['id'].'&amp;name='.$row['name'].'&amp;phone='.$row['phone'].'&amp;email='.$row['email'].'" class="btn btn-default btn-block">Написати на E-mail</a>');
                                    
                                 echo('<a href="php/delete.php?id='.$row['id'].'&amp;name='.$row['name'].'&amp;phone='.$row['phone'].'&amp;email='.$row['email'].'" class="btn btn-danger btn-block">Видалити</a>');
                                echo('</div>');
                            }
                            
                        echo('
                            </div>
                            ');
                          
                          ?>

                      </div>
                      <div id="menu2" class="tab-pane fade">
                            <h3>Розсилка</h3>
                                <h6>Надіслати повідомлення всім користувачам</h6><hr>
                        <form>
                          <div class="form-group">
                            <textarea class="form-control" rows="5" placeholder="Введіть текст повідомлення"></textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Прикріпити файл</label>
                            <input type="file" id="exampleInputFile">
                            <p class="help-block">png, jpg, gif, pdf, doc...</p>
                          </div>
                          <button type="submit" class="btn btn-default">Надіслати</button>
                        </form>
                      </div>
                      
                      <div id="menu3" class="tab-pane fade">
                            <div class="col-lg-12 text-center">
                                <h3>FTP</h3><hr>
                            </div>
                            <div class="col-lg-12">
                                <ul>
                                    <li><strong>Server:</strong> <small>web-fruit.zzz.com.ua</small></li>
                                    <li><strong>Login:</strong> <small>admin@web-fruit.zzz.com.ua</small></li>
                                    <li><strong>Password:</strong> <small>Bogdan230597Bogdan</small></li>
                                    <li><strong>Адреса файлового менеджера: </strong> <small>http://www.zzz.com.ua/ftp</small></li>
                                </ul>
                            </div>
                            <div class="col-lg-12 text-center">
                                <h3>MySQL</h3><hr>
                            </div>
                            <div class="col-lg-12">
                                <ul>
                                    <li><strong>DB_HOST:</strong> <small>mysql.cba.pl</small></li>
                                    <li><strong>DB_USER:</strong> <small>zikbert77</small></li>
                                    <li><strong>DB_PASSWORD:</strong> <small>230597</small></li>
                                    <li><strong>DB_NAME: </strong> <small>web_fruit_zzz_com_ua</small></li>
                                </ul>
                            </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        
        
        
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.js"></script>

    </body>
</html>


<?php
        
    } else {
        header("Location: login.html");
    }
        ?>