<?php
require_once 'init.php';

$msgs = DB::getInstance('mysql.hostinger.ae', 'u162919964_msg', 'u162919964_msng', '68WBY0i31xwo')->query("SELECT * FROM messages");
if(!$msgs->error()){
  $msgs = $msgs->result();
}else{
  die('Error fetching messages please contact the admin');
}

?>

<?php
foreach($msgs as $msg){
?>
  <div class="message <?php echo ($msg->username === Session::get('username')) ? 'me': 'other'; ?>">
    <span class="text"><?php echo $msg->message; ?></span>
    <span class="by">Sent by: <?php echo $msg->username; ?></span>
  </div>
<?php
}
?>
