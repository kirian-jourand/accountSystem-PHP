<?php
declare(strict_types=1);

function getLoginFeedback(): array
{
    if (isset($_SESSION["errorsLogin"])) {
        $errors = $_SESSION["errorsLogin"];
        unset($_SESSION["errorsLogin"]);
        return ["errors" => $errors];
    } elseif (isset($_GET["login"]) && $_GET["login"] === "success") {
        return ["login" => "success"];
    }
    else {
        return [];
    }
}
