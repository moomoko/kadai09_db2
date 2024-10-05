<?php
session_start();

// try {
//     $pdo = new PDO('mysql:host=localhost;dbname=ranking_db;charset=utf8', 'root', '');
// } catch (PDOException $e) {
//     echo 'データベース接続失敗: ' . $e->getMessage();
//     exit();
// }

try {
    $pdo = new PDO('mysql:host=;dbname=;charset=utf8', '', '');
} catch (PDOException $e) {
    echo 'データベース接続失敗: ' . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $username = $_SESSION['username']; // ログイン中のユーザー名

    $stmt = $pdo->prepare("INSERT INTO posts (username, content, created_at) VALUES (:username, :content, NOW())");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        header('Location: community.php');
    } else {
        echo "投稿に失敗しました。";
    }
}
?>
