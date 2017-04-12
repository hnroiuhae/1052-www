<?php
session_start();
if(isset($_SESSION['login'])) {
    ?>
  <!DOCTYPE html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/icon_linux.png">
    <title>金門領酒系統 - 付款頁面</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/mainstyle.css" rel="stylesheet">

  </head>

  <body>
    <?php include 'nav.php'; ?>
      <div class="container">
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>帳戶資訊</h2>
          <div class="table-responsive">
            <?php
    include 'db.php';
    $sql = "SELECT name, phone, id FROM clients WHERE clientID = \"" . $_SESSION['login'] . "\"";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $conn->close();
    ?>
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td><b>姓名</b></td>
                    <td>
                      <?php echo $row["name"] ; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>手機號碼</b></td>
                    <td>
                      <?php echo $row["phone"] ; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>身分證字號</b></td>
                    <td>
                      <?php echo $row["id"] ; ?>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
          <hr />
          <a href="detail_modify.php">修改資料</a>
          <hr />
        </main>
        <?php include 'footer.php'; ?>
      </div>
      <script src="./js/vendor/jquery-3.1.1.slim.min.js"></script>
      <script>
        window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')
      </script>
      <script src="./js/vendor/tether.min.js"></script>
      <script src="./js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="./js/ie10-viewport-bug-workaround.js"></script>
  </body>
  <?php
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
      <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
