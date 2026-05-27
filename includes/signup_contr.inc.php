<?php
declare(strict_types=1);

function isInputEmpty (string $username, string $pwd, string $email): bool {
    return empty($username) || empty($pwd) || empty($email);
}

function isEmailInvalid(string $email): bool {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}
