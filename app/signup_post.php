<?php
require_once("../libs/functions.php");
require_once("../libs/AccountDAO.php");

$csrf_token = (string)filter_input(INPUT_POST, "csrf_token");

//トークン検証
if (validate_csrf_token($csrf_token) === false) {
    error_log("Invalid csrf token.");
    header("Location: error.php");
    exit();
}


/*nameパート*/

//formから受け取る。
$name = (string)filter_input(INPUT_POST, "name");

//未入力でエラー表示
if ($name === "") {
    set_message(MESSAGE_SIGNUP_ERROR);
    header("Location: signup.php");
    exit();
}
//10文字以上でエラー
if (mb_strlen($name) > 10) {
    set_message(MESSAGE_SIGNUP_ERROR);
    header("Location: signup.php");
    exit();
}


/*passwordパート*/
$password = (string)filter_input(INPUT_POST, "password");

//未入力でエラー表示
if ($password === "") {
    set_message(MESSAGE_SIGNUP_ERROR);
    header("Location: signup.php");
    exit();
}
//10文字以上でエラー
if (mb_strlen($password) > 10) {
    set_message(MESSAGE_SIGNUP_ERROR);
    header("Location: signup.php");
    exit();
}

//パスワードハッシュ化する。
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


//アカウント作成。
try {
    $pdo = new_PDO();
    $account_dao = new AccountDAO($pdo);
    $account_dao->insert($name, $hashed_password);

    //set_message(MESSAGE_SIGNUP_SUCCESS);

    header("Location: signin.php");
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        set_message(MESSAGE_SIGNUP_ERROR_NOT_AVAILABLE_NAME);
        header("Location: signup.php");
        exit();
    }

    error_log($e->getMessage());
    header("Location: signup.php");
}