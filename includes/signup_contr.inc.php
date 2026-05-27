<?php
declare(strict_types=1);

function isEmailInvalid(string $email): bool {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isEmailRegistered(object $pdo, string $email): bool {
    if (getEmail($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}
