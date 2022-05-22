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
    set_message(MESSAGE_SIGNIN_ERROR);
    header("Location: signin.php");
    exit();
}
//10文字以上でエラー
if (mb_strlen($name) > 10) {
    set_message(MESSAGE_SIGNIN_ERROR);
    header("Location: signin.php");
    exit();
}


/*passwordパート*/
$password = (string)filter_input(INPUT_POST, "password");

//未入力でエラー表示
if ($password === "") {
    set_message(MESSAGE_SIGNIN_ERROR);
    header("Location: signin.php");
    exit();
}
//10文字以上でエラー
if (mb_strlen($password) > 10) {
    set_message(MESSAGE_SIGNIN_ERROR);
    header("Location: signin.php");
    exit();
}

//登録したアカウントを参照。
try {
    $pdo = new_PDO();
    $account_dao = new AccountDAO($pdo);
    $account = $account_dao->selectByName($name);

     //エラー
     if ($account === false) {
        set_message(MESSAGE_SIGNIN_ERROR);
        header("Location: signin.php");
        exit();
    }

    //入力したパスワードとハッシュ化されたパスワードの整合性を確かめる。
    if (password_verify($password, $account["hashed_password"]) === false) {
        set_message(MESSAGE_SIGNIN_ERROR);
        header("Location: signin.php");
        exit();
    }
    
    //アカウントをセッションに保存。
    sign_in($account);
    set_message(MESSAGE_SIGNIN_SUCCESS);
    header("Location: running.php");

} catch (PDOException $e) {
    error_log($e->getMessage());
    header("Location: error.php");
}