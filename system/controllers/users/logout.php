<?php

setcookie('user_id', 0, time()-3600, '/');
header('Location: http://localhost/catalog.php');