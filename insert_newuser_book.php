<?php
//0. SESSION開始！！
session_start();


//1. POSTデータ取得
$uname = $_POST['uname'];
$uid = $_POST['uid'];
$upw = $_POST['upw'];
// $ukanri = $_POST['ukanri'];
// $ulife = $_POST['ulife'];

//*** 外部ファイルを読み込む ***
include("funcs_book.php");
$pdo = db_conn();
// funcs.phpで作ったログインしてないとselect.phpが開けないコード
sschk();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table (name, lid, lpw, realpw, kanri_flg, life_flg )VALUES( :name, :lid, :lpw, :realpw, 0, 0)");
$stmt->bindValue(':name', $uname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)parameter streemの略。strは文字
$stmt->bindValue(':lid', $uid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', password_hash("$upw", PASSWORD_DEFAULT), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':realpw', $upw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)



// stmt=statement
// statementを実行する指示
$status = $stmt->execute();
// 

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  //５．index.phpへリダイレクト
  redirect("newuser_book.php");
}
?>
