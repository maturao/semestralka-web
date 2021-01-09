<?php

use semestralkaweb\ApplicationStart;

require_once "autoloader.inc.php";
require_once "../composer/vendor/autoload.php";
require_once "settings.inc.php";

// spustim aplikaci
$app = new ApplicationStart();
$app->appStart();
