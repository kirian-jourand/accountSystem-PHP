<?php
declare(strict_types=1);

/**
 * Returns a boolean if the given field matches the email format
 *
 * @param string $email
 *
 * @return bool
 */
function isEmailInvalid(string $email): bool {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Return a boolean if the email already used for an account or not
 *
 * @param object $pdo
 * @param string $email
 *
 * @return bool
 */
function isEmailRegistered(object $pdo, string $email): bool {
    return (bool) getEmail($pdo, $email);
}

/**
 * Return an array filled with the name of the field that is empty.
 *
 * @param string $username
 * @param string $email
 * @param string $pwd
 * @param string $confimPwd
 *
 * @return array
 */
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

/**
 * Return a boolean if the given field don't exceed 30 characters
 *
 * @param string $username
 *
 * @return bool
 */
function isUsernameLengthInvalid(string $username): bool {
    return strlen($username) > 30;
}

/**
 * Returns an associative array with the complexity rule as the key and a boolean value indicating whether the rule is satisfied
 * - **length** : Is the password more than 8 characters long<br>
 * - **uppercase letter** : is the password contain an uppercase letter<br>
 * - **number** : is the password contain a number<br>
 * - **special character** : is the password contain a special character (!@#$%^&*)
 *
 * @param string $pwd   Mot de passe
 *
 * @return array
 */
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
