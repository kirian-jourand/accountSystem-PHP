<?php
declare(strict_types=1);

function getSignupSubmitFeedback(): array {
    if (isset($_SESSION["errorsSignup"])) {
        $errors = $_SESSION["errorsSignup"];
        unset($_SESSION["errorsSignup"]);
        $submitData = $_SESSION["submitData"];
        unset($_SESSION["submitData"]);
        return ["errors" => $errors, "submitData" => $submitData];
    } else {
        return [];
    }
}
