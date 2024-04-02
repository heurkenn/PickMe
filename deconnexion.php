<?php

session_start();

session_destroy();

header("Location: InsCon.php");
exit();
