<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_book.php">本棚アプリ新規ユーザー登録</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- insert.phpにpost方式で飛ばす -->
<!-- 質問：登録後にinsert_book.phpに飛べない、どうしたいいの？ -->
<form method="post" action="insert_newuser_book.php">
  <!-- このjumbotronが複雑、質問 -->
  <div class="jumbotron">
   <fieldset> 
    <legend>新規ユーザー登録をする</legend>
    <table>
     <tr><td><label>お名前：</td><td><input type="text" name="uname"></label></td></tr>
     <tr><td><label>ID：</td><td><input type="text" name="uid"></label></td></tr>
     <tr><td><label>パスワード：</td><td><input type="text" name="upw"></label></td></tr>
     </table>
     <tr><input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<div style='height: 10px'></div>
<ul>
		<li><a href="login_book.php" style="font-size: 30px;">ログイン</a></li>
	</ul>
<!-- Main[End] -->


</body>
</html>
