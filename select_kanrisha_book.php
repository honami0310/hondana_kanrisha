<?php
//0. SESSION開始！！
session_start();

require_once('funcs_book.php'); //php02発展の記載。includeより一般的、間違ってると動かなくなる
$pdo = db_conn();      //DB接続関数
// funcs.phpで作ったログインしてないとselect.phpが開けないコード
sschk();

// funcs2.phpでdb_conn();引っ張ってるので以下は不要
//1.  DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   // 最後２つの'',''はxamppのidとパスワード。idはroot、pwはなしでOKなので空欄
//   // (1)ローカルに保存用
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
//     // (2)さくらサーバー用
//     // $pdo = new PDO('mysql:dbname=gshycheese_gs_db;charset=utf8;host=mysql57.gshycheese.sakura.ne.jp','gshycheese','sirabasu0310');
// } catch (PDOException $e) {
//   // 失敗したときexit文章を出す。''内は任意の言葉
//   exit('DBConnection Error:' . $e->getMessage());
// }

//２．データ登録SQL作成
// ここもSQLで習った引っ張り方。まるまるとるためfromの先はtable名
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
  //SQLエラーの場合
  sql_error($stmt);
  // 以下通常コード省略
  //execute（SQL実行時にエラーがある場合）
  // $error = $stmt->errorInfo();
  // exit("SQL_ERROR:" . $error[2]);
} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  // $resはすべて入ってる(どこで設定してるか再確認)
  // fetchとするとぐるぐる回して情報引っ張ってるらしい、詳細不明
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // tableで表示、タイトルクリックすると別tabでURL先に飛ぶ
    // hでfuncs.php適用して守ってる
    $view .= '<tr><td class="id">' . h($res['id'] ). '</td>';
    $view .= '</td><td><button class="title" onclick="window.open(\'' . h($res['bookurl']) . '\', \'_blank\')">' . h($res['bookname']) . '</button></td>';
    $view .= '<td class="author">' . h($res['author']) . '</td>';
    $view .= '<td class="category">' . h($res['category']) . '</td>';
    $view .= '<td class="star">' . h($res['star']) . '</td><td class="time" colspan="2">' . h($res['indate']) . '</td></tr>';
    $view .= '<tr><td colspan="5" class="comment">' . h($res['comment']) . '</td>';
    // 更新エリアに飛ばす
    $view .= '<td><a href="detail_book.php? id='.h($res["id"]).'">';
    $view .= '[更新]</td>';
    $view .= '<td><a href="delete_book.php?id='.h($res["id"]).'">';
    $view .= '[削除]</td></tr>';

    // // その場でアップデートするパターンはURLで飛ぶの難しくなるから中止
    // $view .= '<tr><td class="id">' . h($res['id'] ). '</td>';
    // $view .= '<td><button onclick="window.open(\'' . $res['bookurl']. '\', \'_blank\')">' . $res['bookname']. '</button></td>';
    // $view .= '<td><input type="text" name="author" value="'.$res["author"].'"></td>';
    // $view .= '<td><input type="text" name="category" value="'.$res["category"].'"></td>';
    // $view .= '<td><input type="text" name="star" value="'.$res["star"].'"></td>';
    // $view .= '<td><input type="text" name="indate" value="'.$res["indate"].'"></td></tr>';
    // $view .= '<tr><td colspan="4"><textArea name="comment" rows="4" cols="40">'.$res["comment"].'</textArea>';
    // $view .= '<tr><td> ID: <a href="delete_book.php?id='.h($res["id"]).'"></td>';

  }
}
?>

<!--
// $sql = "UPDATE gs_ab_table SET bookname=:bookname, author=:author, category=:category, star=:star, indate=:indate, star=:star, comment=:comment WHERE id=:id";
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':bookname',  $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':author', $email,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':category',   $age,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':star',$naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':indate',$naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// $stmt->bindValue(':star',$naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// $stmt->bindValue(':id',$id,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
// $status = $stmt->execute(); //実行
// ?> -->


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>登録済み本棚表示</title>
  <link rel="stylesheet" href="css/style.css">
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body id="main">
  <!-- Head[Start] -->
  <header>
          <div class="hondanahead">本棚</div>
          <?php include("menu_kanrisha.php"); ?>      
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <div>
    <!-- phpで設定したviewを引っ張る -->
    <div class="container jumbotron">
    <!-- phpで設定したviewを引っ張る -->
    <table>
      <tr class="tablehead">
        <td class="id">No.</td>
        <td class="title">タイトル</td>
        <td class="author">著者</td>
        <td class="category">カテゴリ</td>
        <td class="star">評価</td>
        <td class="time" colspan="2">登録日時</td>
      </tr>
      <tr class="tablehead">
        <td colspan="7" class="comment">コメント</td>
      </tr>
      <?= $view ?>
    </table>
  </div>
  <!-- Main[End] -->
<div style="height: 50px"></div>
<ul>
		<li><a href="index_book.php">本棚に新規登録</a></li>
	</ul>
</body>

</html>