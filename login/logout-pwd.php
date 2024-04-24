<?php
session_start();

session_destroy();

setcookie('tk_sesion', '', time() - 3600);
setcookie('utk_sesion', '', time() - 3600);

header("Location: gacf");