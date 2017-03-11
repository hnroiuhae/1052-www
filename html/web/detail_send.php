<?php
session_start();
//var_dump($_GET);
//var_dump($_POST);
//var_dump(hash( 'sha512', $_SESSION[ 'last_action'] . 'detail_send.php?clientID=' . $_POST[ 'clientID'] . '&id=' . $_POST[ 'id']))
if(!isset($_GET['id'])) {
    // Verification error
    ?>
  <!DOCTYPE html>
  <html>

  <body>
    <script>
      alert("不明原因錯誤");
      window.location.replace("detail_modify.php");
    </script>
  </body>

  </html>
  <?php
}
if($_GET['id'] !== hash( 'sha512', $_SESSION['last_action'] . 'detail_send.php?clientID=' . $_POST['clientID'] . '&id=' . $_POST['id'])) {
    // Verification error
    ?>
    <!DOCTYPE html>
    <html>

    <body>
      <script>
        alert("不明原因錯誤");
        window.location.replace("detail_modify.php");
      </script>
    </body>

    </html>
    <?php
}
$conn = new mysqli("db", "pi", "pi", "pi");
mysqli_set_charset($conn, "utf8");
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM clients WHERE clientID = " . $_POST['clientID'] . " AND id = \"" . $_POST['id'] . "\"";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // OK
    $sql = 'UPDATE `clients` SET `name`="' .  $_POST['newname'] . '", `phone`="' .  $_POST['newphone'] .'" WHERE `id`="' . $_POST['id'] . '";';
    $result = $conn->query($sql);
    if ($result) {
        //Update success
        ?>
      <!DOCTYPE html>
      <html>

      <body>
        <script>
          alert("修改成功");
          window.location.replace("detail_modify.php");
        </script>
      </body>

      </html>
      <?php
    }
    else {
        //Update fails
        ?>
        <!DOCTYPE html>
        <html>

        <body>
          <script>
            alert("修改失敗");
            window.location.replace("detail_modify.php");
          </script>
        </body>

        </html>
        <?php
    }
}
else {
    // Mismatch
    ?>
          <!DOCTYPE html>
          <html>

          <body>
            <script>
              alert("不明原因錯誤");
              window.location.replace("detail_modify.php");
            </script>
          </body>

          </html>
          <?php
}
?>
            <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
