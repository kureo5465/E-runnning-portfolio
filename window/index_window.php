<!DOCTYPE html>
<html lang="ja">
<head>
    <?php require("head.php"); ?>
</head>
<body>
<div class="wrapper">
    <!-- header -->
    <?php require("header.php"); ?>

    <main class="main">
      <div class="main_inner">
          <h2 class="main_title">プログラミング学習を体験しましょう！</h2>
          <p class="main_text">
             人材育成の現場では「何度も同じ授業をしたくない」<br>
            「休講者へのフォローをしたい」「遠隔地の方に教育を届けたい」<br>
            「教材をオンライン販売したい」といったご要望があります。<br>
             このサイトは、これらのご要望にお応えするために、現場の声を元に必要な機能揃え、<br>
             使いやすさを追求してきたクラウド型の eラーニング システムです。<br>
          </p>

        <div class="main_account">
            <div class="main_login_button">
                <a href="signin.php">
                    Login
                </a>
            </div>
    
            <div class="main_app_account">
                <a href="signup.php">
                    アカウント作成。
                </a>
            </div>
        </div>
      </div>
    </main>

    <!-- footer -->
    <?php require("footer.php"); ?>

    </div>
</body>
</html>