<?php
session_start();
if(isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    unset($_SESSION['login_name']);
    unset($_SESSION['last_action']);
    //echo "已登出<br />";
    //header("location: index.php");
    ?>
  <!DOCTYPE html>
  <html>

  <body>
    <script>
      alert("您已登出");
      window.location.replace("index.php");
    </script>
  </body>

  </html>
  <?php
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
