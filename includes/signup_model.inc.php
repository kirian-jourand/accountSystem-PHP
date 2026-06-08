<?php
declare(strict_types=1);

function getEmail(object $pdo, string $email) {
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: [];
}

function setUser(object $pdo, string $username, string $email, string $pwd): bool {
    $query = "INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd);";
    $stmt = $pdo->prepare($query);

    $options = ["cost" => 12];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $hashedPwd);
    return $stmt->execute();
}
