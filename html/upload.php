<!DOCTYPE html>
<html lang="he" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="../images/duplicate-image.png">
    <title>Upload files</title>
      <link href="../styles/main.css" rel="stylesheet">
      <link href="../styles/secretaries-main.css" rel="stylesheet">
      <link href="../styles/upload.css" rel="stylesheet">
      <link href="dropzone-4.3.0/dist/dropzone.css" rel="stylesheet">
      <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../scripts/jquery-3.2.1.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../scripts/upload.js"></script>
    <script src="../scripts/uploadSt.js"></script>
    <script src="dropzone-4.3.0/dist/dropzone.js"></script>
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
        <div class="navbar-collapse collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
              <li><a href="edit.php">תיקון נתוני נוכחות</a></li>
              <li class="active"><a href="upload.php">העלת קבצים</a></li>
              <li><a href="reports.html">קבלת דו"חות</a></li>
          </ul>
          </div>
        </div>
    </nav>
	<!--container-->
    <div class="container">
        <!--page description-->
		<div id="upload">
            <img src="../images/upload.png" alt="upload">
            <h3>העלאת קבצים</h3>
            
        <!--timetable upload form-->
          <form action="" method="post" class="form" enctype="multipart/form-data" id="upload-files">
              <h2 class="form-signin-heading">להעלות מערכת שעות</h2>
              <label>בחר/י קבצים מהמחשב שלך</label>
              <div class="form-group">
                    <button type="button" class="btn btn-lg btn-default" id="choice">
                      בחר/י קבצים</button>
                    <span id="file-list">לא נבחר קובץ</span>
                    <input type="file" accept='text/csv' name="files[]" id="upload-files" multiple onchange='uploadFile(this)'>
                  </div>
              <button type="submit" class="btn btn-lg btn-primary" id="upload-submit" name="loadTimetable">
                   להעלות מערכת שעות</button>
              
          </form>
            <?php include("../php/upload_timetable.php") ?>
        <!--students' list upload form-->
          <form action="" method="post" class="form" enctype="multipart/form-data" id="upload-files">
              <h2 class="form-signin-heading">להעלות רשימת סטודנטים</h2>
              <label>בחר/י קבצים מהמחשב שלך</label>
              <div class="form-group">
                    <button type="button" class="btn btn-lg btn-default" id="choice">
                      בחר/י קבצים</button>
                    <span id="file-list-st">לא נבחר קובץ</span>
                    <input type="file" accept='text/csv' name="files[]" id="upload-files" multiple onchange='uploadFileSt(this)'>
                  </div>
              <button type="submit" class="btn btn-lg btn-primary" id="upload-submit" name="loadStudents">
                  להעלות רשימת סטודנטים</button>
              
          </form>
        </div> <!--/upload div-->
      </div> <!--end of container-->
      </div> <!-- end of page not including the footer -->
    
    <!--footer-->
      <footer class="footer">
          <div class="container">
        <p class="text-muted">&copy; 2017 בית הספר הארצי להנדסאים בקריית הטכניון</p>
          </div>
    </footer>
</body>
</html>