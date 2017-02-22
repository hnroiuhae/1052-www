<!DOCTYPE html>
<?php session_start();
$_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128));
?>
  <?php if(!isset($_GET['mac'])) {
    ?>
    <html>

    <body>
      <script>
        alert("未知的錯誤");
        window.location.replace("index.php");
      </script>
    </body>

    </html>
    <?php
} else if(!isset($_SESSION['login'])) {
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
} else { ?>

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="">
          <meta name="author" content="">
          <!--<meta http-equiv="refresh" content="10">-->
          <link rel="icon" href="./img/icon_linux.png">
          <title>金門領酒系統</title>

          <!-- Bootstrap core CSS -->
          <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

          <!-- Custom styles for this template -->
          <link href="./css/mainstyle.css" rel="stylesheet">
        </head>

        <body>
          <?php include 'nav.php'; ?>
            <div class="container">
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
              <?php include 'footer.php'; ?>
            </div>
            <!--container-->
            <!-- Modal -->
            <div class="modal fade" id="RegModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="LoginModalLabel">MAC註冊</h4>
                  </div>
                  <div class="modal-body">
                    <form action="regmac.php" method="GET">
                      <input type="hidden" name="mac" value=<?php echo '"' . $_GET[ 'mac'] . '"'; ?>>
                      <input type="hidden" name="confirm" value=<?php echo '"' . hash( "sha512", $_SESSION[ 'last_action'] . 'regmac.php?mac=' . $_GET[ 'mac']) . '"' ?>>
                      <fieldset disabled>
                        <div class="form-group">
                          <label for="username" class="control-label">User ID:</label>
                          <input type="text" class="form-control" id="userid" value=<?php echo '"' . $_SESSION[ 'login'] . '"'; ?>>
                        </div>
                      </fieldset disabled>
                      <fieldset disabled>
                        <div class="form-group">
                          <label for="username" class="control-label">Username:</label>
                          <input type="text" class="form-control" id="username" value=<?php echo '"' . $_SESSION[ 'login_name'] . '"'; ?>>
                        </div>
                      </fieldset disabled>
                      <fieldset disabled>
                        <div class="form-group">
                          <label for="mac" class="control-label">MAC:</label>
                          <input type="text" class="form-control" id="mac" value=<?php echo '"' . $_GET[ 'mac'] . '"'; ?>>
                        </div>
                      </fieldset disabled>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.href='./index.php'">Close</button>
                        <button type="sumbit" class="btn btn-primary">確認</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--Modal End-->
            <script>
              $("#RegModal").modal('show');
            </script>
        </body>

        </html>
        <?php } ?>
