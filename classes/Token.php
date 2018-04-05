<?php
class Token{

  public static function RandomHash(){
    return hash('sha256', uniqid());
  }

  public static function generate($name){
    if($name){
      return Session::put($name, self::RandomHash());
    }
  }

  public static function check($name, $value, $hok = ''){
    $val = Session::get($name);
    if($val === $value){
      if($hok === 'delete'){
        Session::delete($name);
      }
      return true;
    }
    return false;
  }

}
