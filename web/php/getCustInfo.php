<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/icon_linux.png">

    <title>金門領酒系統</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/mainstyle.css" rel="stylesheet">

  </head>

  <body>
    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-12 col-md-12">

          <!--
<div class="jumbotron">
<h1>Hello, world!</h1>
<p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
</div>
-->
          <div class="row">
            <?php
$dateFormat = "Y/m/d H:i:s";
$arr = array();
$register = array();
$myfile = fopen("/var/www/mac", "r") or die("Unable to open file!");
while (($buffer = fgets($myfile)) !== false) {
    $buffer = str_replace(PHP_EOL, '', $buffer);
    $buffer1 = explode("\t", $buffer);
    if(time() - $buffer1[2] <= 6000) {
        array_push($arr, $buffer1);
    }
}
fclose($myfile);
$myfile = fopen("/var/www/bmac", "r") or die("Unable to open file!");
while (($buffer = fgets($myfile)) !== false) {
    $buffer = str_replace(PHP_EOL, '', $buffer);
    $buffer1 = explode("\t", $buffer);
    if(time() - $buffer1[2] <= 600) {
        array_push($arr, $buffer1);
    }
}
fclose($myfile);
function cmp($a, $b)
{
    $ts = time();
    return ($b[1] - $ts + $b[2]) - ($a[1] - $ts + $a[2]);
}
usort($arr, "cmp");
// Create connection
$conn = new mysqli("db", "pi", "pi", "pi");

// Check connection
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, "utf8");
foreach ($arr as $i => $v) {
    $sql = "SELECT name, phone, id, clients.clientID FROM mac2client INNER JOIN clients ON clients.clientID = mac2client.clientID WHERE mac = \"" . $v[0] . "\"";
    $result = $conn->query($sql);
    if ($result !== false) {
        if ($result->num_rows > 0) {
            // output data of each row
            $register[$i] = true;
            while($row = $result->fetch_assoc()) {
                ?>
              <div class="col-6 col-lg-4">
                <h2><?php echo $row["name"]; ?></h2>
                <p>
                  <?php echo $v[0]; ?>
                    <br />
                    <?php echo $row["id"]; ?>
                </p>
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#LoginModal" data-userid="<?php echo $row["clientID"]; ?>" data-username="<?php echo $row["name"]; ?>">Login</button>
              </div>
              <!--/span-->
              <?php
            }
        } else $register[$i] = false;
    } else $register[$i] = false;
}
$conn->close();
?>
          </div>
          <!--/row-->
        </div>
        <!--/span-->
      </div>
      <!--/row-->

      <hr>
      <p>
        上次更新時間:
        <br />
        <?php echo date($dateFormat); ?>
          <br />
      </p>
      <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <h2>有註冊</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>MAC</th>
                <th>RSSI</th>
                <th>Channel</th>
                <th>Receive Time</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <?php
$no = 0;
foreach ($arr as $i => $v) { if($register[$i]) {
    ?>
                <?php if($v[4] == "w") { ?>
                  <tr>
                    <td>
                      <?php echo $no + 1; $no += 1; ?>
                    </td>
                    <td>
                      <?php echo $v[0]; ?>
                    </td>
                    <td>
                      <?php echo $v[1]; ?>
                    </td>
                    <td>
                      <?php echo $v[3]; ?>
                    </td>
                    <td>
                      <?php echo date($dateFormat, $v[2]); ?>
                    </td>
                    <td>Wi-Fi</dt>
                  </tr>
                  <?php } else if($v[4] == "b") { ?>
                    <td>
                      <?php echo $no + 1; $no += 1; ?>
                    </td>
                    <td>
                      <?php echo $v[0]; ?>
                    </td>
                    <td>
                      <?php echo $v[1]; ?>
                    </td>
                    <td>BT</td>
                    <td>
                      <?php echo date($dateFormat, $v[2]); ?>
                    </td>
                    <td>BT</td>
                    <?php } ?>
                      <?php }} ?>
            </tbody>
          </table>
        </div>
        <h2>未註冊</h2>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>MAC</th>
                <th>RSSI</th>
                <th>Channel</th>
                <th>Receive Time</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <?php
$no = 0;
foreach ($arr as $i => $v) { if(!$register[$i]) {
    ?>
                <?php if($v[4] == "w") { ?>
                  <tr>
                    <td>
                      <?php echo $no + 1; $no += 1; ?>
                    </td>
                    <td>
                      <?php echo $v[0]; ?>
                    </td>
                    <td>
                      <?php echo $v[1]; ?>
                    </td>
                    <td>
                      <?php echo $v[3]; ?>
                    </td>
                    <td>
                      <?php echo date($dateFormat, $v[2]); ?>
                    </td>
                    <td>Wi-Fi</dt>
                  </tr>
                  <?php } else if($v[4] == "b") { ?>
                    <td>
                      <?php echo $no + 1; $no += 1; ?>
                    </td>
                    <td>
                      <?php echo $v[0]; ?>
                    </td>
                    <td>
                      <?php echo $v[1]; ?>
                    </td>
                    <td>BT</td>
                    <td>
                      <?php echo date($dateFormat, $v[2]); ?>
                    </td>
                    <td>BT</td>
                    <?php } ?>
                      <?php }} ?>
            </tbody>
          </table>
        </div>
        
          <hr />
      </main>
      
      <footer>
        <p>&copy; 2017 All rights reserved</p>
        <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#LoginModal" data-userid="123">Login</button>-->
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/vendor/jquery-3.1.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/vendor/tether.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
    <!-- Custom JS for this -->
    <!--script src="XXX.js"></script-->
	
    <!-- Custom Modal for this -->
    <!-- Modal -->
      <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="LoginModalLabel">帳戶登入</h4>
            </div>
            <div class="modal-body">
              <form action="login.php" method="POST">
                <input type="hidden" class="form-control" id="userid_hidden" name="userid">
                <fieldset disabled>
                  <div class="form-group">
                    <label for="username" class="control-label">User ID:</label>
                    <input type="text" class="form-control" id="userid">
                  </div>
                </fieldset disabled>
                <fieldset disabled>
                  <div class="form-group">
                    <label for="username" class="control-label">Username:</label>
                    <input type="text" class="form-control" id="username">
                  </div>
                </fieldset disabled>
                <div class="form-group">
                  <label for="pwd" class="control-label">Password:</label>
                  <input type="password" class="form-control" id="pwd" name="pwd" placeholder="請輸入密碼">
                  </textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="sumbit" class="btn btn-primary">登入</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--Modal End-->
    <!-- Custom JS for this -->
    <script src="../js/main.js"></script>
  </body>
</html>
