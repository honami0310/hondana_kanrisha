<?php
//0. SESSION開始！！
session_start();

//1. GETデータ取得
$id   = $_GET["id"];

//2. DB接続します
include("funcs_book.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数
// funcs.phpで作ったログインしてないとselect.phpが開けないコード
sschk();

//３．データ登録SQL作成
$sql = "DELETE FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT STRは文章)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    if($_SESSION["kanri_flg"] != 1){
        redirect("select_book.php");
    }else{
      // 管理者用
      redirect("select_kanrisha_book.php");
    }
}

?>
