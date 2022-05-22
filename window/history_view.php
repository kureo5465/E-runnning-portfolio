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
         <!-- メッセージ表示 -->
     <?php require("message_window.php"); ?>
        <div class="main_inner">

        
    <h3 class="history_title">Learning history   (学習履歴)</h3>
        <ul>
        <?php foreach ($histories as $history) : ?>
            <li class="history_learning">
                <a href="detail.php?course_id=<?= h($history["course_id"]) ?>
                &section_id=<?= h($history["section_id"]) ?>">
                    <?= h($history["course_title"]) ?>
                        Section
                    <?= h($history["section_no"]) ?>
                    :
                    <?= h($history["section_title"]) ?>
                    (
                    <?= h($history["created_at"]) ?>
                    )
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class="running_button">
            <a href="running.php">
                courseへ戻る
            </a>
        </div>
        </div>
    </main>

    <!-- footer -->
    <?php require("footer.php"); ?>

    </div>
</body>
</html>