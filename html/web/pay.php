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
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Start</th>
                <th>End</th>
                <th>Cost</th>
                <th>Paid</th>
                <th>Got</th>
              </tr>
            </thead>

            <tbody>
              <?php
    $conn = new mysqli("db", "pi", "pi", "pi");
    
    // Check connection
    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn, "utf8");
    $sql = "SELECT id, title, cost, tableName, durationStart, durationEnd FROM activity WHERE CURDATE() >= durationStart AND CURDATE() <= durationEnd";
    $result = $conn->query($sql);
    $no = 1;
    $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128));
    if($result !== false) {
        while($row = $result->fetch_assoc()) {
            $sql2 = "SELECT paid, got FROM " . $row["tableName"] . " WHERE clientID = " . $_SESSION['login'];
            $result2 = $conn->query($sql2);
            ?>
                <tr>
                  <td>
                    <?php echo $no; ?>
                  </td>
                  <td>
                    <?php echo $row["title"]; ?>
                  </td>
                  <td>
                    <?php echo $row["durationStart"]; ?>
                  </td>
                  <td>
                    <?php echo $row["durationEnd"]; ?>
                  </td>
                  <td>
                    <?php echo $row["cost"]; ?>
                  </td>

                  <!--以備份!-->
                  <td>
                    <?php
            if($row2 = $result2->fetch_assoc()) {
                if($row2["paid"] == 1) {
                    echo "<span style=\"color:blue\">YES</span>";
                } else {
                    ?>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#CheckPayModal" data-aid=<?php echo '"' . $row[ "id"] . '"' ?> data-confirm=
                        <?php echo '"' . hash( "sha512", $_SESSION[ 'last_action'] . 'paid.php?aid=' . $row[ "id"]) . '"' ?> >Paid</button>
                      <?php
                }
            } else {
                echo "<span style=\"color:red\">Not Qualified</span>";
            }
            ?>
                  </td>
                  <td>

                    <?php
            if($result2->num_rows > 0) {
                if($row2["got"] == 1) {
                    echo "<span style=\"color:purple\">YES</span>";
                }
                else if($row2["paid"] == 1) {
                    echo "<span style=\"color:blue\"><a href=\"get.php\">NO</a></span>";
                }
                else { ?>
                      <p class="text-danger">
                        <?php echo "NO" ?>
                      </p>
                      <?php } ?>
                        <?php } else { ?>
                          <span style="color:red">Not Qualified</span>
                          <?php } ?>
                  </td>

                </tr>
                <?php
            $no += 1;
        }
    }
    $conn->close();
    ?>
            </tbody>
          </table>
        </div>
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
      <!-- Modal -->
      <div id="CheckPayModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <form action="paid.php" method="GET">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">付款確認</h3>
              </div>
              <div class="modal-body">
                <input type="hidden" class="form-control" id="aid" name="aid" value="" />
                <input type="hidden" class="form-control" id="confirm" name="confirm" value="" />
                <div class="form-group">
                  <h1>您確認要付款嗎?</h1>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" onclick="window.location.href='./pay.php' ">關閉</button>
                <button type="submit" class="btn btn-primary btn-lg" onclick="">確認</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--Modal End-->
      <script>
        $('#CheckPayModal').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget)
          var aid = button.data('aid')
          var confirm = button.data('confirm')
          var modal = $(this)
            //modal.find('.modal-title').text(recipient)
          modal.find('.modal-body #aid').val(aid)
          modal.find('.modal-body #confirm').val(confirm)
        })
      </script>

  </body>
  <?php
}
else {
    //echo "未登入<br />";
    ?>
    <!DOCTYPE html>
    <html>

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
      <script src="../assets/js/vendor/jquery-3.1.1.slim.min.js"></script>
      <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')
      </script>
      <script src="../assets/js/vendor/tether.min.js"></script>
      <script src="../dist/js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
      <!-- Modal -->
      <div id="NoLoginModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title">登入狀態</h3>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <h1>請先登入!</h1>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='./index.php'">確認</button>
            </div>
          </div>
        </div>
      </div>
      <!--Modal End-->
      <script>
        $("#NoLoginModal").modal('show');
      </script>
    </body>

    </html>
    <?php
}
?>
