<?php if (STEP == 3) { ?>
    <h2>Step 3 - Composer</h2>
    <?php
    $session_ok = isset($_SESSION['x5-install-parameters']) && is_array($_SESSION['x5-install-parameters']) && !empty($_SESSION['x5-install-parameters']);
    $all_ok = $check_all && $session_ok;
    if (!$all_ok) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'The installation was not successful. Please start over.';
        echo '</div>';
        echo '<a href="' . BASEURL_SCRIPT . '?step=1" class="btn btn-primary">Go to Step 1</a>';
    } else {
        file_put_contents(DIR_ROOT . 'composer.json', file_get_contents(DIR_ROOT . '../files/composer.json'));
        echo '<div class="alert alert-info" role="alert">';
        echo 'Please manually execute the following commands in your project directory:<br>';
        echo '<textarea id="composerCommands" class="form-control" rows="1" onclick="this.focus();this.select()">';
        echo 'composer update && composer install';
        echo '</textarea>';
        echo '</div>';
        echo '<button id="installApp" class="btn btn-success">Install App after Composer Installation</button>';
        echo '<div id="installResult"></div>';
    }
?>
<?php } ?>