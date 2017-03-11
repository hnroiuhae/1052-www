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
    ?>
  <!DOCTYPE html>
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
    include 'db.php';
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
      <script>
        var link = document.querySelector('link[rel="import"]');
        var content = link.import;
        // Grab DOM from modals.html's document.
        var el = content.querySelector('.modals');
        document.body.appendChild(el.cloneNode(true));
      </script>
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
        $("#NoLoginModal").modal('show');
      </script>
    </body>

    </html>
    <?php
}
?>
