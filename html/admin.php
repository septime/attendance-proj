<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="../images/duplicate-image.png">
    <title>Administration</title>
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../styles/main.css" rel="stylesheet">
      <link href="../styles/signin.css" rel="stylesheet">
      <link href="../styles/admin.css" rel="stylesheet">
      <script src="../scripts/jquery-3.2.1.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script src="../scripts/checkTeacher.js"></script>
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
    
  <body>
      <div class="container-fluid" id="page">
      <!--page header-->
       <div class="container">
           <div class="page-header">
        <h1><span class="glyphicon glyphicon-duplicate"></span> מערכת לניהול נוכחות </h1>
            </div>
        </div>
      <!--row-->
      <div class="container">
                  
       <!--top form -- add user-->   
        <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading" style="margin-top:0px;">להוסיף משתמש</h2>
        <!--email input-->
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email_add" id="inputEmail" class="form-control" placeholder='דוא"ל' required autofocus>
        <!--select privileges-->
        <label for="selectList" id="selectLabel">בחר/י הרשאות</label>
              <select class="form-control" id="selectList" name="privilege" onchange="checkTeacher()">
                <option value="secretary">מזכירות</option>
                <option value="teacher">מרצה</option>
                <option value="management">הנהלה</option>
              </select>
        <input type="text" name="teacher" id="teacher_name" class="form-control" placeholder="שם ושם משפחה של מרצה">
        <!--button-->
        <button class="btn btn-md btn-success btn-block" type="submit" name="addUser">להוסיף</button>
        </form>
          
        <?php require("../php/addDeleteUser.php") ?>
          
        <!--bottom form -- delete user-->
        <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading" style="margin-top:0px;">למחוק משתמש</h2>
        <!--email input-->
        <label for="inputEmail" class="sr-only">Email</label>
        <input type="email" name="email_del" id="inputEmail" class="form-control" placeholder='דוא"ל'>
        <!--button-->
        <button class="btn btn-md btn-danger btn-block" type="submit" name="deleteUser">למחוק</button>
        </form>
    
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