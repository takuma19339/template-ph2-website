<?php
require __DIR__. '/../db/dbconnect.php';
session_start();
if (!isset($_SESSION['id'])) {
  header('Location: /auth/signin.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $dbh->prepare('DELETE FROM Question_Table WHERE id = :id');
    $stmt->bindValue(':id', $_POST['question_id']);
    $stmt->execute();

    $stmt2 = $dbh->prepare('DELETE FROM Choices_Table WHERE question_id = :question_id');
    $stmt2->bindValue(':question_id', $_POST['question_id']);
    $stmt2->execute();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/admin.css">
</head>
<body>
    <header>
        <img src="../assets/img/logo.svg" alt="POSSE" />
        <form action="./auth/signout.php" method="post">
            <button type="submit">ログアウト</button>
        </form>
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
        <h1>問題一覧</h1>
        <p class="theme">ID　問題</p>
        <?php
        foreach($dbh->query("SELECT * FROM Question_Table") as $row){?>
        <div class="qustions">
            <p class="id"><? echo $row['id']."　";?></p>
            <a href="questions/edit.php?id=<?php echo $row['id']; ?>"><?php echo $row['content']."<br>"; ?></a>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="question_id" value="<?php echo $row['id']; ?>" />
                <button type="submit" id="delete-btn">削除</button>
            </form> 
        </div>

        <?php
        };?>
    </section>
</body>
</html>