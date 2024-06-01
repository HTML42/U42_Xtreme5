<?php if (STEP == 4) { ?>
    <h2>Step 4 - Create App</h2>
    <?php
    $success = true;
    $error_code = 0;
    $requiredPaths = [
        DIR_VENDOR,
        DIR_VENDOR . 'u42/x5/',
        DIR_VENDOR . 'u42/x5/install/',
        DIR_VENDOR . 'u42/x5/install/_structure/',
    ];

    foreach ($requiredPaths as $path) {
        if (!is_dir($path)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">Verzeichnis nicht gefunden: $path</div>";
            die;
            $success = false;
            $error_code = -1;
        }
    }

    if($success) {
        if (function_exists('exec')) {
            $output = [];
            $return_var = 0;
            cp_r(DIR_VENDOR . 'u42/x5/install/_structure/', DIR_ROOT);
            if(!is_dir(DIR_ROOT . 'translations/')) {
                $success = false;
                $error_code = -2;
            }
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">exec ist nicht ausführbar auf diesem Server.</div>";
            $success = false;
            $error_code = -3;
        }
    }
    ?>
    <?php if (isset($_GET['ajax'])) {
        ob_clean();
        echo $success ? 1 : ($error_code < 0 ? $error_code : 0);
        die();
    } ?>
<?php } ?>
