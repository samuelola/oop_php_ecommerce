<?php

session_start();
session_unset();
session_destroy();

header("Location:./admin/index.php");
// ../admin/index.php
