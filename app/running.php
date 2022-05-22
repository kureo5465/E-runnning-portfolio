<?php
require_once("../libs/functions.php");
require_once("../libs/CourseDAO.php");

try 
{   
    //DB読み込み。
    $pdo = new_PDO();
    $course_dao = new CourseDAO($pdo);
    $courses = $course_dao->selectAll();

    //画面表示
    require("../window/running_window.php");
} catch (PDOException $e) {
    header("Location: index.php");
}
?>
