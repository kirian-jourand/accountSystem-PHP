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
        require_once "utils.inc.php";

        // Error handler
        $errors = [];

        $emptyFields = getSignupEmptyFields($username, $email, $pwd, $confirmPwd);
        if (!empty($emptyFields)) {
            $errors["emptyFields"] = $emptyFields;
        }

        if (isEmailInvalid($email)) {
            $errors["invalidEmail"] = true;
        }

        $isUsernameLengthInvalid = isUsernameLengthInvalid($username);
        if ($isUsernameLengthInvalid) {
            $errors["usernameLengthInvalid"] = true;
        }

        $isEmailRegistered = isEmailRegistered($pdo, $email);
        if ($isEmailRegistered) {
            $errors["isEmailRegistered"] = true;
        }

        $passwordComplexity = isPasswordComplex($pwd);
        if (in_array(0, $passwordComplexity)) {
            $errors["passwordComplexity"] = $passwordComplexity;
        }

        if(!confirmPasswordTest($pwd, $confirmPwd)) {
            $errors["isPwdFieldsMatch"] = false;
        }

        require_once "config_session.inc.php";
        if (empty($errors)) {
            createUser($pdo, $username, $email, $pwd);
            $pdo = null;
            $stmt=null;
            header("location: ../index.php?signup=success");
        }
        else {
            $_SESSION["errorsSignup"] = $errors;
            $_SESSION["submitData"] = ["username" => $username, "e-mail" => $email];
            $pdo = null;
            $stmt=null;
            header("location: ../index.php");
        }
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("location: ../index.php");
    die();
}
