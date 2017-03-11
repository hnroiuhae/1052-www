  <!DOCTYPE html>
  <html lang="zh-tw">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/icon_linux.png">
    <title>金門領酒系統</title>
    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/mainstyle.css" rel="stylesheet">
    <link rel="import" href="./page/modals.php">
  </head>
  <!-- Bootstrap core JavaScript
================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../assets/js/vendor/jquery-3.1.1.slim.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')
  </script>
  <script src="../assets/js/vendor/tether.min.js"></script>
  <script src="../dist/js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  <!-- Custom JS for this -->
  <!--script src="XXX.js"></script-->
</html>
<?php
session_start();
if(isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    unset($_SESSION['login_name']);
    unset($_SESSION['last_action']);
    //echo "已登出<br />";
    //header("location: index.php");
    ?>
  <!DOCTYPE html>
  <html>
  <body>
  <!-- Custom Modal for this -->
  <script>
    var link = document.querySelector('link[rel="import"]');
    var content = link.import;
    // Grab DOM from modals.html's document.
    var el = content.querySelector('.modals');
    document.body.appendChild(el.cloneNode(true));
  </script>
    <script>
      //alert("您已登出");
      //window.location.replace("index.php");
      $("#LogoutModal").modal('show');
        setTimeout(function() {
          window.location.href = './index.php';
        }, 1500);
    </script>
  </body>
  </html>
  <?php
}
else {
    //echo "未登入<br />";
    ?>
    <!DOCTYPE html>
    <html>
    <body>
      <!-- Custom Modal for this -->
      <script>
        var link = document.querySelector('link[rel="import"]');
        var content = link.import;
        // Grab DOM from modals.html's document.
        var el = content.querySelector('.modals');
        document.body.appendChild(el.cloneNode(true));
      </script>
      <script>
        //alert("未登入");
        //window.location.replace("index.php");
        $("#NoLoginModal").modal('show');
        setTimeout(function() {
          window.location.href = './index.php';
        }, 1500);
      </script>
    </body>
    </html>
    <?php
}
?>
