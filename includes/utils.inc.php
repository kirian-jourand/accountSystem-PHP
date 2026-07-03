<?php
function isEmailInvalid(string $email): bool {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}
