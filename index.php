<?php
require_once 'init.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Messenger</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
  </head>
  <body>
    <?php
    if(!Session::exists('username')){
      ?>
      <div id="loginbox">
        <div class="login">
          <h1>Login</h1>
          <div class="username">
            <label for="username"><h3>Pick a username</h3></label>
            <input type="text" placeholder="Choose a username (Press enter to submit)" id="username" />
            <input type="hidden" id="csrf" value="<?php echo Token::generate('csrf'); ?>" />
            <a id="alert_msg"></a>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
    <h1 class='fixed-top page-header'>Messenger</h1>
    <?php
    if(Session::exists('username')){ // if user logged in show him messages
    ?>
      <!-- Messages -->
      <div class="messages" id="messages">
      </div>
      <!-- Messages -->
    <div class='fixed-bottom msg-box'>
      <input type="text" id="new_messsage" placeholder="Type your message (Press enter to send)" />
      <a id="alert_msg"></a>
      <input type="hidden" id="msg_csrf" value="<?php echo Token::generate('msg_csrf'); ?>" />
    </div>
    <?php
    }
    ?>
    <script src="js/script.js"></script>
  </body>
</html>
