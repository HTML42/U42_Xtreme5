<?php if (STEP == 4) { ?>
    <h2>Step 4 - Create App</h2>
<?php
$success = true;
?>
<?php
if(isset($_GET['ajax'])) {
    ob_clean();
    echo $success ? 1 : 0;
    die();
}
?> 
<?php } ?>