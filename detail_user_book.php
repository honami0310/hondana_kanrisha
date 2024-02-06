<!-- エラーを検知するphp -->
<?php
//0. SESSION開始！！
session_start();

ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
error_reporting(E_ALL); // 全てのレベルのエラーを表示してください
?>

<?php
//１．PHP
//select.phpの[PHPコードだけ！]をマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。

// どこから取ってるの？後で確認
$id = $_GET["id"];

include("funcs_book.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数
// funcs.phpで作ったログインしてないとselect.phpが開けないコード
sschk();

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM gs_user_table WHERE id = :id "); //SQLをセット
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  $res = $stmt->fetch();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザーの登録変更</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_book.php">ユーザーの登録変更</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update_user_book.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザーの登録変更</legend>
    <table>
     <tr><td><label>名前：</td><td><input type="text" name="name" value="<?=$res["name"]?>"></label></td></tr>
     <tr><td><label>ID：</td><td><input type="text" name="lid" value="<?=$res["lid"]?>"></label></td></tr>
     <tr><td><label>パスワード：</td><td><input type="text" name="realpw" value="<?=$res["realpw"]?>"></label></td></tr>
     <tr><td><label>管理者権限付与(1)</td><td><input type="text" name="kanri_flg" value="<?=$res["kanri_flg"]?>"></label></td></tr>
     <tr><td><label>life flug変更(0/1)</td><td><input type="text" name="life_flg" value="<?=$res["life_flg"]?>"></label></td></tr>


     </table>
     <!-- idをhiddenで隠して送信 -->
     <input type="hidden" name="id" value="<?=$res["id"]?>">
     <!-- <input type="hidden" name="lpw" value="<?=$res["id"]?>"> -->
     <!-- idを隠して送信 -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>




