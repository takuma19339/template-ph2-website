<?php
require __DIR__. '/../../db/dbconnect.php';
session_start();
if(isset($_SESSION['id'])){
    header('Location: ../index.php')
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt=$dbh->prepare('SELECT * FROM Users WHERE email = :email');
    $stmt=bindValue(":email",$_POST["email"]);
    $stmt=execute();
    $user=$stmt->fetch();
    if($_POST['password'] == $user['password']){
        $_SESSION['id']=$user['id'];
        header('Location: ../index.php');
        exit;
    }else{
        header('Location: signin.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignIn</title>
    <link rel="stylesheet" href="../../assets/styles/admin.css">
</head>
<body>
    <header>
        <img src="../../assets/img/logo.svg" alt="POSSE" />
        <form action="../auth/signout.php" method="post">
            <button type="submit">ログアウト</button>
        </form>
    </header>
    <div class="signin">
        <h2>ログイン画面</h2>
        <form action="../../actions/admin/auth/signin.php" method="post">
            <label for="email">Eメール</label><br />
            <input type="email" name="email" placeholder="Email" class="sign" required>
            <label for="password">パスワード</label><br />
            <input type="password" name="password" placeholder="Password" class="sign" required>
            <br /><br /><br />
            <button type="submit">ログイン</button>
        </form>
    </div>
</body>
</html>