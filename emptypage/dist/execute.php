<?php

if(@is_file('/var/www/U42_Xtreme5/latest/x5_start.php')) {
    include '/var/www/U42_Xtreme5/latest/x5_start.php';
} else if(@is_file('D:/Webserver/U42/Intern/Xtreme5/latest/x5_start.php')) {
    include 'D:/Webserver/U42/Intern/Xtreme5/latest/x5_start.php';
} else if(@is_file('/Users/mark/Development/mp/x5/latest/x5_start.php')) {
    include '/Users/mark/Development/mp/x5/latest/x5_start.php';
} else {
    include '../vendor/u42/x5/latest/x5_start.php';
}
