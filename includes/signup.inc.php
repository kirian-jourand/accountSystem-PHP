<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["e-mail"];
    $pwd = $_POST["pwd"];
    $confimPwd = $_POST["confimPwd"];

    try {
        require_once "dbh.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_contr.inc.php";

        // Error handler
        $errors = [];

        // WIP test à faire

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
