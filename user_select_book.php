<?php
//0. SESSION開始！！
session_start();

require_once('funcs_book.php'); //php02発展の記載。includeより一般的、間違ってると動かなくなる
$pdo = db_conn();      //DB接続関数
// funcs.phpで作ったログインしてないとselect.phpが開けないコード
sschk();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
  //SQLエラーの場合
  sql_error($stmt);
} else {
  while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<tr><td class="id">' . h($res['id'] ). '</td>';
    $view .= '<td class="name">' . h($res['name']) . '</td>';
    $view .= '<td class="lid">' . h($res['lid']) . '</td>';
    $view .= '<td class="realpw">' . h($res['realpw']) . '</td>';
    $view .= '<td class="lwp">' . h($res['lpw']) . '</td>';
    $view .= '<td class="kanri_flg">' . h($res['kanri_flg']) . '</td>';
    $view .= '<td class="life_flg">' . h($res['life_flg']) . '</td>';
    // 更新エリアに飛ばす
    $view .= '<td><a href="detail_user_book.php? id='.h($res["id"]).'">';
    $view .= '[更新]</td>';
    $view .= '<td><a href="delete_user_book.php?id='.h($res["id"]).'">';
    $view .= '[削除]</td></tr>';

  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>管理者用 ユーザー一覧</title>
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
          <div class="hondanahead">管理者用 ユーザー一覧</div>
          <?php include("menu.php"); ?>     
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
        <td class="name">名前</td>
        <td class="lid">ID</td>
        <td class="realpw">PW</td>
        <td class="lwp">ハッシュ後PW</td>
        <td class="lwp">管理者(1)/一般ユーザー(0)</td>
        <td class="lwp">life flug</td>
      </tr>
      <?= $view ?>
    </table>
  </div>
  <!-- Main[End] -->
<div style="height: 50px"></div>
<ul>
		<li><a href="select_kanrisha_book.php">本棚に戻る</a></li>
	</ul>
</body>

</html>