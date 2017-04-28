<div class="modals">

<!-- exampleModal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <form>
		  <div class="form-group">
            <label for="recipient-name-2" class="control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name-2">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
      <!--LoginModal Modal -->
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
      <!-- LoginModalM -->
      <div class="modal fade" id="LoginModalM" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="LoginModalLabel">帳戶登入</h4>
            </div>
            <div class="modal-body">
              <form action="loginm.php" method="POST">
                <div class="form-group">
                  <label for="id" class="control-label">ID:</label>
                  <input type="text" class="form-control" id="id" name="id" placeholder="請輸入ID">
                </div>
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
      <!-- CheckPayModal -->
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
      <!-- NoLoginModal -->
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
              <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='./index2.php'">確認</button>
            </div>
          </div>
        </div>
      </div>
            <!-- RegModal -->
            <?php if(isset($_GET[ 'mac']) && isset($_SESSION[ 'last_action']) && $_SESSION[ 'login'] && $_SESSION[ 'login_name']) { ?>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.href='./index2.php'">Close</button>
                        <button type="sumbit" class="btn btn-primary">確認</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
      <!-- CheckGetModal -->
      <div id="CheckGetModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content">
            <form action="got.php" method="GET">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">領酒確認</h3>
              </div>
              <div class="modal-body">
                <input type="hidden" class="form-control" id="aid" name="aid" value="" />
                <input type="hidden" class="form-control" id="confirm" name="confirm" value="" />
                <div class="form-group">
                  <h1>您確認要領酒嗎?</h1>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" onclick="window.location.href='./get.php' ">關閉</button>
                <button type="submit" class="btn btn-primary btn-lg" onclick="">確認</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  <!-- LoginSuccessModal -->
  <div id="LoginSuccessModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">登入狀態</h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h1>登入成功!</h1>
            <p><a href="./pay.php">3秒後跳轉，點我直接跳轉。</a></p>
            <p></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='./pay.php'">確認</button>
        </div>
      </div>
    </div>
  </div>
  <!-- AlreadyLoggedinModal -->
  <div id="AlreadyLoggedinModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">登入狀態</h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h1>您已經登入了!</h1>
            <p></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='./index2.php'">確認</button>
        </div>
      </div>
    </div>
  </div>
  <!-- LoginPasswordIncorrectModal -->
  <div id="LoginPasswordIncorrectModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h1>密碼錯誤!</h1>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='./index2.php'">確認</button>
        </div>
      </div>
    </div>
  </div>
  
</div>
