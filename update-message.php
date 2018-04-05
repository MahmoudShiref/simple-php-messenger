<?php
require_once 'init.php';

//RECEIVING USERNAME WITH CSRF TOKEN
if(isset($_POST['username']) || isset($_POST['csrf'])){
  $user = htmlspecialchars($_POST['username']);
  $csrf = htmlspecialchars($_POST['csrf']);
  $res  = array(
    'state' => 'success',
    'errorCode' => 0,
    'errorMsg' => ''
  );
  if(Token::check('csrf', $csrf, 'delete')){
    //Save user session and connect him to chat
    Session::put('username', $user);
    $res['state']     = 'success';
    echo json_encode($res);
  }else{
    $res['state']     = 'failed';
    $res['errorCode'] = 1;
    $res['errorMsg']  = 'Invalid CSRF Value';
    echo json_encode($res);
  }
}

//RECEIVING Message WITH CSRF TOKEN
if(isset($_POST['message']) || isset($_POST['msg_csrf'])){
  $msg  = htmlspecialchars($_POST['message']);
  $csrf = htmlspecialchars($_POST['msg_csrf']);
  $res  = array(
    'state' => 'success',
    'errorCode' => 0,
    'errorMsg' => ''
  );
  if(Token::check('msg_csrf', $csrf)){
    //Save Message to database
    $user = Session::get('username');
    DB::getInstance('mysql.hostinger.ae', 'u162919964_msg', 'u162919964_msng', '68WBY0i31xwo')->insert('messages', array(
      'username' => $user,
      'message' => $msg,
    ));
    $res['state']     = 'success';
    echo json_encode($res);
  }else{
    $res['state']     = 'failed';
    $res['errorCode'] = 1;
    $res['errorMsg']  = 'Invalid CSRF Value';
    echo json_encode($res);
  }
}
