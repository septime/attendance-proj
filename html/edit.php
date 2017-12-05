<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="../images/duplicate-image.png">
    <title>Edit attendance data</title>
      
      <link href="../styles/main.css" rel="stylesheet">
      <link href="../styles/secretaries-main.css" rel="stylesheet">
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
	<!--navigation bar-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
          <a class="navbar-brand" href="#"> מערכת לניהול נוכחות <span class="glyphicon glyphicon-duplicate"></span></a>
        </div>
        <div id="myNavbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="edit.html">תיקון נתוני נוכחות</a></li>
              <li><a href="upload.php">העלת קבצים</a></li>
            <li><a href="reports.html">קבלת דו"חות</a></li>
          </ul>
          </div>
        </div>
    </nav>
	<!--container-->
    <div class="container-fluid">
      <div id="edit">
            <img src="../images/edit-icon-1.png" alt="edit">
            <h3>תיקון נתוני נוכחות</h3>
                <div class="form-group">
                    <form action="" method="post" class="form">
                    <label id="st-id" for="student-id">הכנס/י ת"ז של סטודנט</label>
                    <input type="text" class="form-control" id="student-id" placeholder="234567890" name="id" minlength="8" maxlength="10" onkeypress="return event.charCode > 47 && event.charCode < 58;" required autofocus>
                    <button class="btn btn-primary btn-lg" type="submit" name="showStudent">להציג נתוני נוכחות</button>
                    </form>
                    <?php include("../php/editStudent.php") ?>
                </div>
          </div>
          </div>
    </div> <!--end of page not including the footer-->
    <!--footer-->
      <footer class="footer">
          <div class="container">
        <p class="text-muted">&copy; 2017 בית הספר הארצי להנדסאים בקריית הטכניון</p>
         </div>
    </footer>

</body>
</html>