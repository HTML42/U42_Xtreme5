<?php

setcookie('X5_login', '', time() + 7, "/");

Response::ajax(true, 200, []);