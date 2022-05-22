<?php
require_once("../libs/functions.php");

//サーフトークン作成実行。
$csrf_token = generate_csrf_token();

require("../window/signup_window.php");