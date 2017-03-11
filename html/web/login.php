<?php session_start(); ?>
  <!DOCTYPE html>
  <html lang="zh-tw">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/icon_linux.png">
    <link rel="import" href="./page/modals.php">
    <title>金門領酒系統 - 登入頁面</title>
    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/mainstyle.css" rel="stylesheet">
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
  <!-- Custom Modal for this -->
  <script>
    var link = document.querySelector('link[rel="import"]');
    var content = link.import;
    // Grab DOM from modals.html's document.
    var el = content.querySelector('.modals');
    document.body.appendChild(el.cloneNode(true));
  </script>

  </body>

  </html>

  <?php
if(isset($_SESSION['login'])) {
    ?>
    <!DOCTYPE html>
    <html>

    <body>
      <script>
        //alert("您已經登入");
        //window.location.replace("index.php");
        $("#AlreadyLoggedinModal").modal('show');
        setTimeout(function() {
          window.location.href = './index.php';
        }, 3000);
      </script>
    </body>

    </html>
    <?php
}
else {
    include 'db.php';
    $sql = "SELECT name FROM clients WHERE clientID = " . $_POST["userid"] . " AND pw = \"" . $_POST["pwd"] . "\"";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['login'] = $_POST["userid"];
        $row = $result->fetch_assoc();
        $_SESSION['login_name'] = $row["name"];
        $_SESSION['last_action'] = '';
        //echo "登入成功<br />";
        ?>
      <!DOCTYPE html>
      <html>

      <body>
        <script>
          //alert("登入成功");
          //window.location.replace("index.php");
          $("#LoginSuccessModal").modal('show');
          setTimeout(function() {
            window.location.href = './pay.php';
          }, 3000);
        </script>
      </body>

      </html>
      <?php
        $conn->close();
    }
    else {
        //echo "帳號密碼錯誤<br />";
        ?>
        <!DOCTYPE html>
        <html>

        <body>
          <script>
            //alert("帳號密碼錯誤");
            //window.location.replace("index.php");
            $("#LoginPasswordIncorrectModal").modal('show');
            setTimeout(function() {
              window.location.href = './index.php';
            }, 3000);
          </script>
        </body>

        </html>
        <?php
    }
}
?>
