<?php
session_start();
if(isset($_GET['aid'])) {
    ?>
  <!DOCTYPE html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/icon_linux.png">
    <title>金門領酒系統 - 領酒期詳細資訊</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/mainstyle.css" rel="stylesheet">

  </head>

  <body>
    <?php include 'nav.php'; ?>
      <div class="container">
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>領酒期詳細資訊</h2>
          <div class="table-responsive">
            <?php
    include 'db.php';
    $sql = "SELECT title, durationStart, durationEnd, cost, tableName FROM activity WHERE id = " . $_GET['aid'];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td><b>#</b></td>
                    <td>
                      <?php echo $_GET['aid'] ; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>名稱</b></td>
                    <td>
                      <?php echo $row["title"] ; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>開始日期</b></td>
                    <td>
                      <?php echo $row["durationStart"] ; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>結束日期</b></td>
                    <td>
                      <?php echo $row["durationEnd"] ; ?>
                    </td>
                  </tr>
                  <tr>
                    <td><b>價格</b></td>
                    <td>
                      <?php echo $row["cost"] ; ?>
                    </td>
                  </tr>
                </tbody>
              </table>
              <hr />
              <?php
    $tableName = $row["tableName"];
    $sql = "SELECT clients.clientID AS cid, name, paid, got FROM clients LEFT OUTER JOIN " . $tableName . " ON clients.clientID = " . $tableName . ".clientID";
    $result = $conn->query($sql);
    ?>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>客戶名稱</th>
                      <th>付款狀態</th>
                      <th>領取狀態</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
    while($row = $result->fetch_assoc()) { ?>
                      <tr>
                        <td>
                          <?php echo $row["cid"] ; ?>
                        </td>
                        <td>
                          <?php echo $row["name"] ; ?>
                        </td>
                        <td>
                          <?php
        if(isset($row["paid"])) {
            if($row["paid"] == 1)
            echo '<span style="color:green">YES</span>';
            else
                echo '<span style="color:red">NO</span>';
        }
        else echo '<span style="color:red">Not Qualified</span>';
            ?>
                        </td>
                        <td>
                          <?php
        if(isset($row["got"])) {
            if($row["got"] == 1)
            echo '<span style="color:green">YES</span>';
            else
                echo '<span style="color:red">NO</span>';
        }
        else echo '<span style="color:red">Not Qualified</span>';
            ?>
                        </td>
                      </tr>
                      <?php } ?>
                  </tbody>
                </table>
          </div>
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
        alert("未知的錯誤");
        window.location.replace("index2.php");
      </script>
    </body>

    </html>
    <?php
}
?>
      <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
