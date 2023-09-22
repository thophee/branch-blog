<?php
if ($_SESSION['popup'] == 1) {
    ?>
    <script>
        let overlay = document.getElementById('overlay');
        window.onload = function () {
            overlay.style.top = 0;
        }
        document.getElementById('close').onclick = function() {
            overlay.style.top = '-100%';
        }
    </script>
    <?php $_SESSION['popup'] = null;
}