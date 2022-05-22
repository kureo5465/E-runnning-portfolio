<?php
//メッセージ
define("SESSION_ACCOUNT", "SESSION_ACCOUNT");
define("SESSION_MESSAGE", "SESSION_MESSAGE");
define("SESSION_CSRF_TOKEN", "SESSION_CSRF_TOKEN");
define("MESSAGE_SIGNIN_SUCCESS", "Sign in successful.");
define("MESSAGE_SIGNIN_ERROR", "Sign in error.");
define("MESSAGE_SIGNUP_SUCCESS", "Sign up successful.");
define("MESSAGE_SIGNUP_ERROR", "Sign up error.");
define("MESSAGE_SIGNUP_ERROR_NOT_AVAILABLE_NAME", 
        "Sign up error. This name is notavailable.");
define("MESSAGE_FINISH_SECTION", "Learning completed.");
define("MESSAGE_NO_LEARNING_HISTORY", "No learning history.");

session_start();

//データーベース
function new_PDO()
{
   $options = 
   [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
   ];

   $pdo = new PDO("sqlite:../db/running.sqlite3", null, null, $options);
   return $pdo;
}

//HTML特殊⽂字を変換する
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

/*セッションパート*/


//セッションにアカウントデータを保存する
function sign_in($account)
{
    session_regenerate_id();

    //アカウント保存
    $_SESSION[SESSION_ACCOUNT] = $account;
}

//サインイン
function is_sign_in()
{
    return isset($_SESSION[SESSION_ACCOUNT]);
}

//サインアウト
function sign_out()
{
    //サインインチェック
    if (is_sign_in() === false) {
    return false;
 }

    //初期化。
    $_SESSION = [];

    //クッキー設定
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
    );
 }
    session_destroy();
}

//セッションからアカウントデータを取得する
function get_account()
{
    if (is_sign_in() === false) {
        return false;
    }

    return $_SESSION[SESSION_ACCOUNT];
}

//セッションからアカウントIDを取得する
function get_account_id()
{
    $account = get_account();
    if ($account === false) {
         return false;
    }

    return $account["id"];
}

//セッションからアカウント名を取得する
function get_account_name()
{
    $account = get_account();

    if ($account === false) {
      return false;
 }
    return $account["name"];
}

//セッションにメッセージを保存する
function set_message($message)
{
    //$_SESSION[SESSION_MESSAGE]に$messageを格納。
    $_SESSION[SESSION_MESSAGE] = $message;
}

//セッションからメッセージを取得する
function get_message()
{
    if (isset($_SESSION[SESSION_MESSAGE]) === false) {
         return false;
    }

    $message = $_SESSION[SESSION_MESSAGE];
    unset($_SESSION[SESSION_MESSAGE]);
    return $message;
}



//CSRFトークンを⽣成する
function generate_csrf_token()
{
    $bytes = random_bytes(32);
    $token = bin2hex($bytes);

    //トークン保存
    $_SESSION[SESSION_CSRF_TOKEN] = $token;
    return $token;
}

//CSRFトークンを検証する
//$tokenにsignin.phpの$csrf_token代入。
function validate_csrf_token($token)
{
    if (isset($_SESSION[SESSION_CSRF_TOKEN]) === false) {
        return false;
    }

    $result = $_SESSION[SESSION_CSRF_TOKEN] === $token;
    unset($_SESSION[SESSION_CSRF_TOKEN]);
    return $result;
}