<?php if (STEP == 1) { ?>
    <h2>Step 1 - Checks</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Check</th>
                    <th>Current</th>
                    <th>Supported</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $all_checks_pass = true;
                foreach ($requirements as $requirement) {
                ?>
                    <tr class="<?= $requirement[4] ? 'table-ok' : 'table-fail' ?>">
                        <td><?= $requirement[0] ?></td>
                        <td><?= $requirement[1] ?></td>
                        <td><?= $requirement[2] ?> - <?= $requirement[3] ?></td>
                        <td><?= $requirement[4] ? 'OK' : 'FAIL' ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <div>
        <button class="btn btn-primary" onclick="location.reload(true)">Reload Check</button>
        <button class="btn btn-success" onclick="location.href = '<?= BASEURL_SCRIPT ?>?step=2'" <?= $check_all ? '' : ' disabled' ?>>Next</button>
    </div>
<?php } ?>
