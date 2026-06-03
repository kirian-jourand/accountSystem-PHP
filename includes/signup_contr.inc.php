<?php
declare(strict_types=1);

function isEmailInvalid(string $email): bool {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isEmailRegistered(object $pdo, string $email): bool {
    return (bool) getEmail($pdo, $email);
}

function getEmptyFields(string $username, string $email, string $pwd, string $confimPwd): array {
    $emptyFields = [];

    if (empty($username)) {
        $emptyFields[] = "username";
    }
    if (empty($email)) {
        $emptyFields[] = "e-mail";
    }
    if (empty($pwd)) {
        $emptyFields[] = "pwd";
    }
    if (empty($confimPwd)) {
        $emptyFields[] = "confirmPwd";
    }

    return $emptyFields;
}

function isUsernameLengthInvalid(string $username): bool {
    return strlen($username) > 30;
}

function isPasswordComplex(string $pwd): array {
    return [
        "length" => (bool) strlen($pwd) >= 8,
        "uppercase letter" => (bool) preg_match('/[A-Z]/', $pwd),
        "number" => (bool) preg_match('/\d/', $pwd),
        "special character" => (bool) preg_match('/[!@#$%^&*]/', $pwd)
    ];
}

/**
 * Vérifie si pwd est égale à confirmPwd
 *
 * @param string $pwd           Mot de passe
 * @param string $confirmPwd    Confirmation du mot de passe
 *
 * @return bool true: les deux paramètres sont égaux, false : le deux paramètres ne sont pas égaux
 */
function confirmPasswordTest(string $pwd, string $confirmPwd): bool {
    return $pwd === $confirmPwd;
}
