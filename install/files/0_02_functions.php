<?php
function comp($min, $max, $current)
{
    $has_min = version_compare($current, $min, '>=');
    $has_max = version_compare($current, $max, '<=');
    return $has_min && $has_max;
}

?>