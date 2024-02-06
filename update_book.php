<?php
//0. SESSION開始！！
session_start();

//1. POSTデータ取得
$bookname = $_POST['bookname'];
$author = $_POST['author'];
$category = $_POST['category'];
$bookurl = $_POST['bookurl'];
$star = $_POST['star'];
$comment = $_POST['comment'];
$id = $_POST['id'];


//2. DB接続します
include("funcs_book.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数
// funcs.phpで作ったログインしてないとselect.phpが開けないコード
sschk();


//３．データ登録SQL作成
// $sqlでUPDATE文を書く
$sql = "UPDATE gs_bm_table SET bookname=:bookname, author=:author, category=:category, bookurl=:bookurl, indate=sysdate(), star=:star, comment=:comment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookname',  $bookname,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':author', $author,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':category', $category,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl',$bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':star',$star, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment',$comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',$id,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
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
