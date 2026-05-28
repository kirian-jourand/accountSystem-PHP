<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["e-mail"];
    $pwd = $_POST["pwd"];
    $confirmPwd = $_POST["confirmPwd"];

    try {
        require_once "dbh.inc.php";
        /** @var PDO $pdo */
        require_once "signup_model.inc.php";
        require_once "signup_contr.inc.php";

        // Error handler
        $errors = [];

        $emptyFields = getEmptyFields($username, $email, $pwd, $confirmPwd);
        if (!empty($emptyFields)) {
            $errors["emptyFields"] = $emptyFields;
        }

        if (isEmailInvalid($email)) {
            $errors["invalidEmail"] = true;
        }

        $invalidInputsLength = invalidInputsLength($username, $pwd);
        if (!empty($invalidInputsLength)) {
            $errors["invalidInputLength"] = $invalidInputsLength;
        }

        if (isEmailRegistered($pdo, $email)) {
            $errors["emailUsed"] = true;
        }

        $passwordComplexity = isPasswordComplex($pwd);
        if (in_array(0, $passwordComplexity, false)) {
            $errors["passwordComplexity"] = $passwordComplexity;
        }

        require_once "config_session.inc.php";
        if (!empty($errors)) {
            $_SESSION["errorsSignup"] = $errors;
            header("location: ../index.php");
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("location: ../index.php");
    die();
}
