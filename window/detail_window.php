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
      <h3 class="main_course_title">Section Course</h3>

  
      <!-- サブエリア -->
        <section class ="session">
           <div class="session_container">
             <aside class="session_aside">
               <div class="session_img">
                 <img src="../img/<?= h($course["id"]) ?>.png" alt="course image">
               </div>
                <h5 class ="session_title"><?= h($course["course_title"]) ?></h5>
                <h6 class ="session_sub_title"><?=h($course["category_title"]) ?></h6>
                <ul class ="session_ul">
                <?php foreach ($sections as $section) : ?>
                    <li class ="session_li">
                      <a href="detail.php?course_id=<?= h($course['id']) ?>&section_id=<?= h($section['id']) ?>"
                      class="<?= is_sign_in() && $section['created_at'] != null ? 'section-finished' : '' ?>">
                        Section <?= h($section["no"]) ?> : <?= h($section["title"])?>
                      </a>
                    </li>                  
                <?php endforeach; ?> 
                </ul>
                <div class="running_button">
                  <a href="running.php">
                    courseへ戻る
                  </a>
                 </div>

                <div class="running_button">
                  <a href="history.php">
                    学習履歴一覧
                  </a>
                 </div>
             </aside>

             <article>
               <div class="session_video">
               <video src="<?= h($current_section["url"])?>" 
                  playsinline controls class="section-video">
               </video>               
              </div>

          
               <h5 class ="session_title">
                <?= h($course["course_title"]) ?> - Section <?= h($current_section["no"]) ?> :
                <?= h($current_section["title"]) ?>
               </h5>
               
               <?php if (is_sign_in()) : ?>
                  <form action="history_post.php" method="post">
                    <input type="hidden" name="csrf_token" value="<?= h($csrf_token) ?>" />
                    <input type="hidden" name="course_id" value="<?= h($course["id"]) ?>">
                    <input type="hidden" name="section_id" value="<?=h($current_section["id"]) ?>">
                    <button type="submit" class="finish_button"
                    <?= $current_section["created_at"] !=null ? "disabled" : '' ?>>
                          Finish
                    </button>
                  </form>
                <?php endif ?>

            </article>
           </div>
        </section>


    
      </div> <!--main_inner-->

       <!-- footer -->
    <?php require("footer.php"); ?>
  </main>

    </div>
</body>
</html>