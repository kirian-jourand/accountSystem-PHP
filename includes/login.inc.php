<?php
declare(strict_types=1);

$indexPath = "location: ../index.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["e-mail"];
    $pwd = $_POST["pwd"];

    try {
        require_once "dbh.inc.php";
        /** @var PDO $pdo */
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";
        require_once "utils.inc.php";

        $errors = [];

        $emptyFields = getLoginEmptyFields($email, $pwd);
        if (!empty($emptyFields)) {
            $errors["emptyFields"] = $emptyFields;
        }

        if (isEmailInvalid($email)) {
            $errors["invalidEmail"] = true;
        }

        require_once "config_session.inc.php";
        if (isBruteForce()) {
            $errors["isBruteForce"] = true;
        }

        if (empty($errors)) {
            incrementLoginAttempts();
            $checkCredentialsResult = checkCredentials($pdo, $email, $pwd);
            if ($checkCredentialsResult["isCredentialsValid"]) {
                resetLoginAttempts();
                $newSessionId = session_create_id();
                $sessionId = $newSessionId."_".$checkCredentialsResult["user"]["id"];
                session_id($sessionId);

                $_SESSION["user_id"] = $checkCredentialsResult["user"]["id"];
                $_SESSION["user_username"] = htmlspecialchars($checkCredentialsResult["user"]["username"]);

                $_SESSION['last_regeneration'] = time();

                $pdo = null;
                $stmt = null;
                header("location: ../index.php?login=success");
            }
            else {
                $_SESSION["errorsLogin"]["invalidCredentials"] = $checkCredentialsResult;
                $pdo = null;
                $stmt = null;
                header($indexPath);
            }
        }
        else {
            $_SESSION["errorsLogin"] = $errors;
            $pdo = null;
            $stmt = null;
            header($indexPath);
        }
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header($indexPath);
    die();
}
