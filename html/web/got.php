<?php
session_start();
if(isset($_SESSION['login'])) {
    if(!isset($_GET["aid"])) {
        ?>
  <!DOCTYPE html>
  <html>

  <body>
    <script>
      alert("未知的錯誤");
      window.location.replace("index.php");
    </script>
  </body>

  </html>
  <?php
        
    } else if ($_GET["confirm"] !== hash("sha512", $_SESSION['last_action'] . 'got.php?aid=' . $_GET["aid"])) {
        ?>
    <!DOCTYPE html>
    <html>

    <body>
      <script>
        alert("未知的錯誤");
        window.location.replace("index.php");
      </script>
    </body>

    </html>
    <?php
    }
    $conn = new mysqli("db", "pi", "pi", "pi");
    
    // Check connection
    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    }
    mysqli_set_charset($conn, "utf8");
    $sql = "SELECT tableName FROM activity WHERE id = " . $_GET["aid"];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $sql = "SELECT clientID, paid, got FROM " . $row["tableName"] . " WHERE clientID = " . $_SESSION['login'];
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $sql = "UPDATE " . $row["tableName"] . " SET got = 1 WHERE clientID = " . $_SESSION['login'];
        $result = $conn->query($sql);
    }
    else $result = false;
    if($result !== true) {
        ?>
      <!DOCTYPE html>
      <html>

      <body>
        <script>
          alert("資料庫操作失敗");
          window.location.replace("get.php");
        </script>
      </body>

      </html>
      <?php
    }
    else {
        ?>
        <!DOCTYPE html>
        <html>

        <body>
          <script>
            alert("資料庫更新成功");
            window.location.replace("get.php");
          </script>
        </body>

        </html>
        <?php
    }
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
