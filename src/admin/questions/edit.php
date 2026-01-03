<?php
require __DIR__. '/../../db/dbconnect.php';

$question_id = $_GET['id'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $dbh->prepare('UPDATE Question_Table SET content = :content, image = :image, supplement = :supplement WHERE id = :id');
    $stmt->bindValue(':content', $_POST['content']);
    $stmt->bindValue(':image', $_POST['image']);
    $stmt->bindValue(':supplement', $_POST['supplement']);
    $stmt->bindValue(':id', $question_id);
    $stmt->execute();

    header('Location: http://localhost:8080/admin/index.php');
    exit;
}
$stmt = $dbh->prepare('SELECT * FROM Question_Table WHERE id = :id');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/../../assets/styles/admin.css">
</head>
<body>
    <header>
        <img src="../../assets/img/logo.svg" alt="POSSE" />
        <a href="">ログアウト</a>
    </header>
    <section>
    <div class="index">
        <nav>
            <a>ユーザー招待</a><br />
            <a href="http://localhost:8080/admin/index.php">問題一覧</a><br />
            <a href="http://localhost:8080/admin/questions/create.php">問題作成</a><br />
        </nav>
    </div>
    <div class="main">
        <h1>問題編集</h1>
    <form action method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $question['id']; ?>" />

        <label for="content">問題文:</label><br />
        <input id="content"type="text" name="content" value="<?php echo $question['content']; ?>" />
        <br /><br />

        <label for ="name">選択肢:</label><br />
        <input class="choices" id="choice1" type="text" name="name" value="<?php echo $question['choice1']; ?>" />
        <input class="choices" id="choice2"type="text" name="name" value="<?php echo $question['choice2']; ?>" />
        <input class="choices" id="choice3"type="text" name="name" value="<?php echo $question['choice3']; ?>" />
        <br /><br />

        <label for="valid">正解の選択肢:</label><br />
        <input class="answer" id="answer1" type="radio" name="valid" value="choice1" />選択肢1
        <input class="answer" id="answer2" type="radio" name="valid" value="choice2" />選択肢2
        <input class="answer" id="answer3" type="radio" name="valid" value="choice3" />選択肢3
        <br /><br />

        <label for="image">問題の画像:</label><br />
        <input id="file" type="file" name="image" />
        <br /><br />

        <label for="supplement">補足:</label><br />
        <input id="exp"type="text" name="supplement" placeholder="補足を入力してください" />
        <br /><br />

        <button id="create-btn" type="submit">作成</button>
    </form>
</div>
</section>
</body>
</html>