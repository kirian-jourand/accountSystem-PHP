<?php
declare(strict_types=1);

function isInputEmpty (string $username, string $pwd, string $email): bool {
    return empty($username) || empty($pwd) || empty($email);
}

