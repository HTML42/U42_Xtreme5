<?php if (STEP == 2) { ?>
    <h2>Step 2 - Parameters</h2>
    <?php
    // Initialisiere Werte mit Standardwerten
    $values = [
        'website_name' => 'Meine Webseite', // Standardwert gesetzt
        'domain' => 'example.de', // Standardwert gesetzt
        'db_host' => 'localhost', // Standardwert gesetzt
        'db_user' => '',
        'db_password' => '',
        'db_name' => '',
        'db_type' => 'jsondb',
    ];
    $errors = [];
    $success = null;
    //
    if (isset($_POST['website_name'])) {
        $success = true;
        foreach ($_POST as $key => &$post_val) {
            $post_val = trim($post_val);
            $values[$key] = $post_val;
        }
        if (strlen($_POST['website_name']) < 2) {
            $errors['website_name'] = 'Website-Name zu kurz.';
            $success = false;
        }
        if (strlen($_POST['domain']) < 3 || !preg_match("/.+\..+/", $_POST['domain'])) {
            $errors['domain'] = 'Domain ungültig.';
            $success = false;
        }
        //
        if ($_POST['db_type'] == 'mysql') {
            $dbFields = ['db_host', 'db_user', 'db_name'];
            foreach ($dbFields as $field) {
                if (strlen($_POST[$field]) < 1) {
                    $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " can't be empty.";
                    $success = false;
                }
            }
            if ($success) {
                try {
                    $pdo = new PDO('mysql:host=' . $_POST['db_host'] . ';dbname=' . $_POST['db_name'], $_POST['db_user'], $_POST['db_password']);
                } catch (PDOException $e) {
                    $errors['db_connection'] = "Can't connect to database.";
                    $success = false;
                }
            }
        }
        //
        if ($success) {
            $_SESSION['x5-install-parameters'] = $values;
            echo '<div class="alert alert-success" role="alert">Parameters valid. Redirect in 3 seconds..</div>';
            echo '<meta http-equiv="refresh" content="3;url=' . BASEURL_SCRIPT . '?step=3" />';
        }
    } else {
        if(isset($_SESSION['x5-install-parameters']) && is_array($_SESSION['x5-install-parameters']) && !empty($_SESSION['x5-install-parameters'])) {
            $values = $_SESSION['x5-install-parameters'];
        }
    }
    ?>
    <?php if (!$success) { ?>
        <form action="<?= BASEURL_SCRIPT ?>?step=2" method="post" class="needs-validation <?= $success === false ? 'is-invalid' : '' ?>" novalidate>
            <fieldset>
                <legend>General Information</legend>
                <div class="mb-3">
                    <label for="website_name" class="form-label">Website Name:</label>
                    <input type="text" class="form-control" id="website_name" name="website_name" required
                        value="<?= htmlspecialchars($values['website_name']) ?>">
                    <?php if (isset($errors['website_name'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['website_name'] ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="domain" class="form-label">Domain:</label>
                    <input type="text" class="form-control" id="domain" name="domain" required
                        value="<?= htmlspecialchars($values['domain']) ?>">
                    <?php if (isset($errors['domain'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['domain'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </fieldset>
            <fieldset>
                <legend>Database</legend>
                <div class="mb-3">
                    <label for="db_type" class="form-label">Database Type:</label>
                    <select class="form-select" id="db_type" name="db_type">
                        <option value="jsondb" <?= $values['db_type'] == 'jsondb' ? 'SELECTED' : '' ?>>JSONDB</option>
                        <option value="mysql" <?= $values['db_type'] == 'mysql' ? 'SELECTED' : '' ?>>MySQL</option>
                    </select>
                </div>
                <div id="mysql-fields" style="display:none;">
                    <div class="mb-3">
                        <label for="db_host" class="form-label">Database Host:</label>
                        <input type="text" class="form-control <?= isset($errors['db_host']) ? 'is-invalid' : '' ?>"
                            id="db_host" name="db_host" value="<?= htmlspecialchars($values['db_host']) ?>">
                        <?php if (isset($errors['db_host'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['db_host'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="db_user" class="form-label">Database User:</label>
                        <input type="text" class="form-control <?= isset($errors['db_user']) ? 'is-invalid' : '' ?>"
                            id="db_user" name="db_user" value="<?= htmlspecialchars($values['db_user']) ?>">
                        <?php if (isset($errors['db_user'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['db_user'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="db_password" class="form-label">Database Password:</label>
                        <input type="password" class="form-control <?= isset($errors['db_password']) ? 'is-invalid' : '' ?>"
                            id="db_password" name="db_password">
                        <!-- Optional: Fehlermeldung für das Passwort, falls benötigt -->
                    </div>
                    <div class="mb-3">
                        <label for="db_name" class="form-label">Database Name:</label>
                        <input type="text" class="form-control <?= isset($errors['db_name']) ? 'is-invalid' : '' ?>"
                            id="db_name" name="db_name" value="<?= htmlspecialchars($values['db_name']) ?>">
                        <?php if (isset($errors['db_name'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['db_name'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-primary">Complete Installation</button>
        </form>
    <?php } ?>


<?php } ?>