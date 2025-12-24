<?php
require __DIR__. '/../db/dbconnect.php';
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
        <h1>問題一覧</h1>
        <p class="theme">ID　問題</p>
        <?php
        foreach($dbh->query("SELECT * FROM Question_Table") as $row){?>
        <div class="qustions">
            <p class="id"><? echo $row['id']."　";?></p>
            <a href=""><?php echo $row['content']."<br>"; ?></a>
            <button id="delete-btn">削除</button>
        </div>

        <?php
        };?>
    </section>
</body>
</html>