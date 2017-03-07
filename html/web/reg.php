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
          <link rel="import" href="./page/modals.php">
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
            <!-- Custom Modal for this -->
             <script>
              var link = document.querySelector('link[rel="import"]');
              var content = link.import;
               // Grab DOM from modals.html's document.
              var el = content.querySelector('.modals');
             document.body.appendChild(el.cloneNode(true));
            </script>
            <script>
              $("#RegModal").modal('show');
            </script>
        </body>

        </html>
        <?php } ?>
