<!DOCTYPE html>
<head>
    <?php require("head.php"); ?>
</head>
<body>
    <div class="wrapper">
    <!-- header -->
    <?php require("header.php"); ?>

    <main class="main">
    <!-- サインイン成功時にメッセージ表示 -->
     <?php require("message_window.php"); ?>
          <div class="main_inner">
              <div class="main_title_container">
                  <h3 class="main_course_title">coursetitle</h3>
                  <h4 class="main_course_sub_title">学習動画へようこそ！<?= h(get_account_name()) ?>さん！</h4>
              </div>
                <section class="course">
                    <?php foreach ($courses as $course) :?>
                        <div class="course_block">
                            <div class="course_img">
                                <img src="../img/<?= h($course["id"]) ?>.png" alt="course image"> 
                            </div>
                            <h5 class="course_title">
                                <?= h($course["course_title"]) ?>
                            </h5>
    
                            <h6 class="course_sub_title">
                                <?= h($course["category_title"]) ?>
                            </h6>

                            <button class="course_button">
                                <a href="detail.php?course_id=<?= h($course['id']) ?>">
                                    学習動画
                                </a>
                            </button>
                        </div>
                     <?php endforeach; ?>
                </section>

                <div class="signout">
                    <a href="signout.php">Sign out</a>
                </div>
          </div>
           <!-- footer -->
        <?php require("footer.php"); ?>

        </div>
</body>

    </main>
</html>