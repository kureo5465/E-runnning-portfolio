<?php
require_once("../libs/functions.php");
require_once("../libs/HistoryDAO.php");

//セッションからアカウントIDを取得。
$account_id = get_account_id();

//サインインしているかチェック
if ($account_id === false) {
    error_log("Not signud in.");
    header("Location: error.php");
    exit();
}

//detail.phpのformから受け取る。
$csrf_token = filter_input(INPUT_POST, "csrf_token");

//トークンをチェック
if (validate_csrf_token($csrf_token) === false) {
    error_log("Invalid csrf token.");
    header("Location: error.php");
    exit();
}


//detail.phpのformから受け取る。
$course_id = (string)filter_input(INPUT_POST, "course_id");

//入力チエック  空文字ならエラー
if ($course_id === "") {
    error_log("Validate: course_id is required.");
    header("Location: error.php");
    exit();
}

//整数以外ならエラー
if (filter_var($course_id, FILTER_VALIDATE_INT) === false) {
    error_log("Validate: course_id is not int.");
    header("Location: error.php");
    exit();
}


//detail.phpのformから受け取る。
$section_id = (string)filter_input(INPUT_POST, "section_id");

//入力チエック  空文字ならエラー
if ($section_id === "") {
    error_log("Validate: section_id is required.");
    header("Location: error.php");
    exit();
}

//整数以外ならエラー
if (filter_var($section_id, FILTER_VALIDATE_INT) === false) {
    error_log("Validate: section_id is not int.");
    header("Location: error.php");
    exit();
}

try {
    $pdo = new_PDO();
    $history_dao = new HistoryDAO($pdo);
    
    //HistoryDAO.php
    //学習履歴を作る。
    $history_dao->insert($account_id, $section_id);

    //function.php
    set_message(MESSAGE_FINISH_SECTION);
    
    //学習画面に戻る。
    header("Location: detail.php?course_id=$course_id&section_id=$section_id");
} catch (PDOException $e) {
    error_log($e->getMessage());
    header("Location: error.php");
}
