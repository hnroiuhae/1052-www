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
<?php session_start(); ?>
  <body>
    <?php include 'nav.php'; ?>
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
include 'db.php';
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

                  <?php if(!isset($_SESSION['login'])) { ?>
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#LoginModal" data-userid="<?php echo $row["clientID"]; ?>" data-username="<?php echo $row["name"]; ?>">Login</button>
                    <?php } else { ?>
                      <button type="button" class="btn btn-info btn-lg">Logged In</button>
                      <?php } ?>
                </div>
                <!--/span-->
                <?php
            }
        } else $register[$i] = false;
    } else $register[$i] = false;
}
$conn->close();
if(!isset($_SESSION['login'])) {?>
                  <div class="col-6 col-lg-4">
                    <h2>手動登入</h2>
                    <p>
                      <br />
                    </p>

                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#LoginModalM">Login</button>
                  </div>
                  <?php } ?>
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
            <script>
              autorefresh = true
            </script>
            <button type="button" class="btn btn-lg btn-info" id="autorefresh" onclick="autorefresh = !autorefresh; document.getElementById('autorefresh').innerText = 'Auto Refresh: ' + autorefresh.toString();">Auto Refresh: true</button>
        </p>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <div class="form-group">
            <input type="text" id="SearchForIn" onkeyup="SearchClus()" placeholder="Search for ..." title="example (type,wifi)">
          </div>
          <h2>有註冊</h2>
          <div class="table-responsive">
            <table class="table table-striped" id="regTable">
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
                        <?php echo '<a href="reg.php?mac=' . urlencode($v[0]) . '">' . $v[0] . '</a>'; ?>
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
                        <?php echo '<a href="reg.php?mac=' . urlencode($v[0]) . '">' . $v[0] . '</a>'; ?>
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
        <?php include 'footer.php'; ?>
      </div>
      <!--/.container-->
      <!-- Custom Modal for this -->
      <script>
        var link = document.querySelector('link[rel="import"]');
        var content = link.import;
        // Grab DOM from modals.html's document.
        var el = content.querySelector('.modals');
        document.body.appendChild(el.cloneNode(true));
      </script>
      <!-- Custom JS for this -->
      <script>
        logining = false;
        setInterval(reload, 10000);

        function reload() {
          if (logining || !autorefresh) {} else {
            location.reload(true);
          }
        }
      </script>

      <script src="./js/main.js"></script>
  </body>

  </html>
  <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
