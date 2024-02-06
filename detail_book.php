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
$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id = :id "); //SQLをセット
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  // whileをなんで消したかよく分からん要確認
  $res = $stmt->fetch();
  // while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ //データ取得数分繰り返す
  //   //以下でリンクの文字列を作成, $r["id"]でidをdetail.phpに渡しています
  //   $view .= '<a href="detail.php?id='.h($r["id"]).'">';
  //   $view .= h($r["id"])."|".h($r["name"])."|".h($r["email"])."<br>";
  //   $view .= '</a>';
  // }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>本の登録更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_book.php">登録本の更新</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update_book.php">
  <div class="jumbotron">
   <fieldset>
    <legend>登録本の更新</legend>
    <table>
     <tr><td><label>タイトル：</td><td><input type="text" name="bookname" value="<?=$res["bookname"]?>"></label></td></tr>
     <tr><td><label>著者：</td><td><input type="text" name="author" value="<?=$res["author"]?>"></label></td></tr>
     <tr><td><label>URL：</td><td><input type="text" name="bookurl" value="<?=$res["bookurl"]?>"></label></td></tr>
     <tr><td><label>感想：</td><td><textArea name="comment" rows="4" cols="40"><?=$res["comment"]?></textArea></label></td></tr>
     <tr><td><label>カテゴリ：</td><td><input type="text" name="category" value="<?=$res["category"]?>"></label></td></tr>
     <tr><td><label>評価(1~5)：</td><td><input type="text" name="star" value="<?=$res["star"]?>"></label></td></tr>
     </table>
     <!-- idをhiddenで隠して送信 -->
     <input type="hidden" name="id" value="<?=$res["id"]?>">
     <!-- idを隠して送信 -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>




