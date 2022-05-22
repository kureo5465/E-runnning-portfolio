<?php
require_once("../libs/functions.php");
require_once("../libs/CourseDAO.php");
require_once("../libs/SectionDAO.php");

//DB course_idを読み込み。
$course_id = (string)filter_input(INPUT_GET, "course_id");

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

//DB section_idを読み込み。
$section_id = (string)filter_input(INPUT_GET, "section_id");

//入力時、整数じゃなかったらエラー
if ($section_id !== "" && filter_var($section_id, FILTER_VALIDATE_INT) === false) {
    error_log("Validate: section_id is not int.");
    header("Location: error.php");
    exit();
}

try {
 $pdo = new_PDO();//DBセット

 $course_dao = new CourseDAO($pdo);
 $course = $course_dao->selectById($course_id);

 if ($course === false) {
    error_log("Invalid course id." . $course_id);
    header("Location: error.php");
    exit();
 }

 $section_dao = new SectionDAO($pdo);

 //サインインしてアカウントがあればcourse_id, account_id取得
 $account_id = get_account_id();
 if ($account_id !== false) {
    $sections = $section_dao->selectByCourseIdAndAccoutId($course_id, $account_id);
 } else {
    $sections = $section_dao->selectByCourseId($course_id);
 }

 //検索結果が0件場合、エラー
 if (count($sections) === 0) {
    error_log("Invalid sections." . $course_id);
    header("Location: error.php");
    exit();
 }

 //メインタイトル・サブタイトル蓄積用配列。
 $current_section = $sections[0];

 //メインタイトル・サブタイトル画面。
 foreach ($sections as $section) {
    if ((int)$section["id"] === (int)$section_id) {
        //再代入。
        $current_section = $section;
        break;
    }
 }
 
 //csrfトークン作成。
 if (is_sign_in()) {
    $csrf_token = generate_csrf_token();
 }

 require("../window/detail_window.php");
} catch (PDOException $e) {
    error_log($e->getMessage());
    header("Location: error.php");
}