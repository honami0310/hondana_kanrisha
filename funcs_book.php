<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
  try {
    $db_name = "gs_db4";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "";      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = "localhost"; //DBホスト


    //localhost以外(さくらサーバーなど)の場合参照するようにかき分ける処理。デプロイ用にコメントアウト中
    // GitHubにあっぷしないように削除中、IDPWメモwordファイル参照
    
    return new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
  } catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
  }
}

//SQLエラー
function sql_error($stmt)
{
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:" . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
  header("Location: " . $file_name);
  exit();
}

//SessionCheck(スケルトン)そのユーザーがログインしているかどうかチェックする
function sschk()
{
  // chk_ssidはlogin_act.phpで設定したもの
  if ($_SESSION["chk_ssid"] != session_id()) {
    exit("LOGIN ERROR");
  } else {
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}
