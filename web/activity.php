<?php session_start(); ?>
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
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/mainstyle.css" rel="stylesheet">
    <link rel="import" href="./php/modals.php">
  </head>
  <!-- Bootstrap core JavaScript
================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="./js/vendor/jquery-3.1.1.slim.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')
  </script>
  <script src="./js/vendor/tether.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="./js/ie10-viewport-bug-workaround.js"></script>
  <!-- Custom JS for this -->
  <!--script src="XXX.js"></script-->

  </html>

  <body>
    <?php include 'nav.php'; ?>
      <div class="container">
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>領酒期資訊</h2>
          <div class="table-responsive">
            <?php
include 'db.php';
$sql = "SELECT id, title, durationStart, durationEnd, cost FROM activity";
$result = $conn->query($sql);
?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>名稱</th>
                    <th>開始日期</th>
                    <th>結束日期</th>
                    <th>價格</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td>
                        <?php echo '<a href="activity_id.php?aid=' . $row["id"] . '">' . $row["id"] . '</a>' ; ?>
                      </td>
                      <td>
                        <?php echo $row["title"] ; ?>
                      </td>
                      <td>
                        <?php echo $row["durationStart"] ; ?>
                      </td>
                      <td>
                        <?php echo $row["durationEnd"] ; ?>
                      </td>
                      <td>
                        <?php echo $row["cost"] ; ?>
                      </td>
                    </tr>
                    <?php } $conn->close(); ?>
                </tbody>
              </table>
          </div>
          <hr />
        </main>
        <?php include 'footer.php'; ?>
      </div>
  </body>
  <?php
?>
    <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
