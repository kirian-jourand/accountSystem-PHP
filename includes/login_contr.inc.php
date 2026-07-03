<?php
declare(strict_types=1);


/**
 * Return an array filled with the name of the field that is empty.
 *
 * @param string $email
 * @param string $pwd
 *
 * @return array
 */
function getLoginEmptyFields(string $email, string $pwd): array {
    $emptyFields = [];

    if (empty($email)) {
        $emptyFields[] = "e-mail";
    }
    if (empty($pwd)) {
        $emptyFields[] = "pwd";
    }

    return $emptyFields;
}

function isBruteForce(): bool {
    if (!isset($_SESSION["login_attempts"])) {
        $_SESSION["login_attempts"] = 0;
    }

    if (!isset($_SESSION["last_attempt"])) {
        $_SESSION["last_attempt"] = time();
    }

    // Reset après 2 minutes
    if (time() - $_SESSION["last_attempt"] > 120) {
        $_SESSION["login_attempts"] = 0;
        $_SESSION["last_attempt"] = time();
    }

    return  $_SESSION["login_attempts"] >= 5;
}

function incrementLoginAttempts(): void {
    $_SESSION["login_attempts"]++;
    $_SESSION["last_attempt"] = time();
}

function resetLoginAttempts(): void {
    $_SESSION["login_attempts"] = 0;
}

/**
 * @param object $pdo
 * @param string $email
 * @param string $pwd
 * @return array|false[]
 */
function checkCredentials(object $pdo, string $email, string $pwd): array {
    $user = getUserByEmail($pdo, $email);
    if (!empty($user) && password_verify($pwd, $user["pwd"])) {
        return ["isCredentialsValid"=> true, "user" => $user];
    }
    return ["isCredentialsValid"=> false];
}
