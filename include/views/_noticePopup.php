<?php

function view_notice()
{
    $notice = isset($_GET["notice"]) ? $_GET["notice"] : null;
    $error = isset($_GET["error"]) ? $_GET["error"] : null;

    $message = $notice ? $notice : ($error ? $error : null);
    $message = htmlspecialchars($message);

    if ($message) :
?>
        <script type="module" src="js/noticePopup.js"></script>

        <dialog class="notice <?= $error ? "notice-error" : "" ?>" open>
            <span class="notice-text"><?= $error ? "Error: " : "" ?><?= $message ?></span>
            <form method="dialog">
                <button class="button">OK</button>
            </form>
        </dialog>
<?php
    endif;
}
