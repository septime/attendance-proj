<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="../images/duplicate-image.png">
    <title>Forgotten password</title>
      <link href="../styles/main.css" rel="stylesheet">
      <link href="../styles/pswd.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="../scripts/jquery-3.2.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
  <body>
      <div class="container-fluid" id="page">
      <!--page header-->
       <div class="container">
           <div class="page-header">
        <h1><span class="glyphicon glyphicon-duplicate"></span> מערכת לניהול נוכחות </h1>
            </div>
        </div>
      <!--container-->
      <div class="container">
          <div class="form-group">
              <form class="form-signin" action="" method="post">
                <p id="btn">דאו"ל שלך:</p>
                <input type="email" id="inputEmail" class="form-control" name="email" required autofocus>
              <button class="btn btn-primary btn-block" type="submit" name="send" id="sendBtn"> שלח סיסמה</button>
              </form>
              
              <?php require_once("../php/send-pswd.php") ?>
          </div>
      </div> <!--end of container-->
    </div> <!--end of page not including the footer-->
    <!--footer-->
    <footer class="footer">
        <div class="container">
        <p class="text-muted">&copy; 2017 בית הספר הארצי להנדסאים בקריית הטכניון</p>
        </div>
    </footer>

    
  </body>
</html>