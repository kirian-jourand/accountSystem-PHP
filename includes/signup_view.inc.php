<?php
declare(strict_types=1);

function getSignupSubmitFeedback(): array {
    if (isset($_SESSION["errorsSignup"]) && isset($_SESSION["submitData"])) {
        $errors = $_SESSION["errorsSignup"];
        unset($_SESSION["errorsSignup"]);
        $submitData = $_SESSION["submitData"];
        unset($_SESSION["submitData"]);
        return ["errors" => $errors, "submitData" => $submitData];
    } elseif (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        return ["signup" => "success"];
    }
    else {
        return [];
    }
}
