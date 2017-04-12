<nav class="navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="http://www.kkl.gov.tw/index.aspx">金門領酒系統</a>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">首頁 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index2.php">主選單 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">帳戶</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <?php if(isset($_SESSION['login'])) { ?>
            <a class="dropdown-item" href="#">
              <?php echo "帳戶: " . $_SESSION['login_name']; ?>
            </a>
            <a class="dropdown-item" href="detail.php">帳戶資訊</a>
            <a class="dropdown-item" href="activity.php">領酒資訊</a>
            <a class="dropdown-item" href="pay.php">付款</a>
            <a class="dropdown-item" href="get.php">領酒</a>
            <a class="dropdown-item" href="logout.php">登出</a>
            <?php } else { ?>
              <a class="dropdown-item" href="#">未登入</a>
              <a class="dropdown-item" href="activity.php">領酒資訊</a>
              <a class="dropdown-item" href="register.php">註冊用戶</a>
              <?php } ?>
                <!--<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>-->
        </div>
      </li>
    </ul>
    <!--form class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" type="text" placeholder="Search">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form-->
  </div>
</nav>
