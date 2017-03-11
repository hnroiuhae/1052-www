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
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/mainstyle.css" rel="stylesheet">

  </head>

  <body>
    <?php include 'nav.php'; ?>
      <div class="container">
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>帳戶資訊</h2>
          <div class="table-responsive">
            <?php
    $conn = new mysqli("db", "pi", "pi", "pi");
    
    // Check connection
    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn, "utf8");
    $sql = "SELECT clientID, name, phone, id FROM clients WHERE clientID = \"" . $_SESSION['login'] . "\"";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $conn->close();
    $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128));
    ?>
              <form method="POST" action="detail_send.php?id=<?php echo hash( 'sha512', $_SESSION[ 'last_action'] . 'detail_send.php?clientID=' . $row[ 'clientID'] . '&id=' . $row[ 'id']); ?>">
                <input type="hidden" name="clientID" value=<?php echo '"' . $row[ "clientID"] . '"' ; ?> />
                <input type="hidden" name="id" value=<?php echo '"' . $row[ "id"] . '"' ; ?> />
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td><b>姓名</b></td>
                      <td>
                        <input type="text" name="newname" value=<?php echo '"' . $row[ "name"] . '"' ; ?> />
                      </td>
                    </tr>
                    <tr>
                      <td><b>手機號碼</b></td>
                      <td>
                        <input type="text" name="newphone" value=<?php echo '"' . $row[ "phone"] . '"' ; ?> />
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
                <input type="submit" value="確認修改" />
              </form>
          </div>
          <hr />
          <a href="detail.php">返回檢視</a>
          <hr />
        </main>
        <?php include 'footer.php'; ?>
      </div>
      <script src="../assets/js/vendor/jquery-3.1.1.slim.min.js"></script>
      <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')
      </script>
      <script src="../assets/js/vendor/tether.min.js"></script>
      <script src="../dist/js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
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
