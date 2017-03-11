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
    if(!isset($_GET["aid"])) {
        ?>
  <!DOCTYPE html>
  <html>

  <body>
    <script>
      alert("未知的錯誤");
      window.location.replace("index.php");
    </script>
  </body>

  </html>
  <?php
        
    } else if ($_GET["confirm"] !== hash("sha512", $_SESSION['last_action'] . 'got.php?aid=' . $_GET["aid"])) {
        ?>
    <!DOCTYPE html>
    <html>

    <body>
      <script>
        alert("未知的錯誤");
        window.location.replace("index.php");
      </script>
    </body>

    </html>
    <?php
    }
    $conn = new mysqli("db", "pi", "pi", "pi");
    
    // Check connection
    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn, "utf8");
    $sql = "SELECT tableName FROM activity WHERE id = " . $_GET["aid"];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $sql = "SELECT clientID, paid, got FROM " . $row["tableName"] . " WHERE clientID = " . $_SESSION['login'];
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $sql = "UPDATE " . $row["tableName"] . " SET got = 1 WHERE clientID = " . $_SESSION['login'];
        $result = $conn->query($sql);
    }
    else $result = false;
    if($result !== true) {
        ?>
      <!DOCTYPE html>
      <html>

      <body>
        <script>
          alert("資料庫操作失敗");
          window.location.replace("get.php");
        </script>
      </body>

      </html>
      <?php
    }
    else {
        ?>
        <!DOCTYPE html>
        <html>

        <body>
          <script>
            alert("資料庫更新成功");
            window.location.replace("get.php");
          </script>
        </body>

        </html>
        <?php
    }
}
else {
    //echo "未登入<br />";
    ?>
          <!DOCTYPE html>
          <html>

          <body>
            <script>
              alert("未登入");
              window.location.replace("index.php");
            </script>
          </body>

          </html>
          <?php
}
?>
