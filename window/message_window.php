<?php
$message = get_message();
if ($message !== false) {
?>
    <div class="message">
    <?= h($message); ?>
    </div>
<?php } ?>