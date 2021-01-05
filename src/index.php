<?php
// nactu funkci vlastniho autoloaderu trid
// pozn.: protoze je pouzit autoloader trid, tak toto je (vyjma TemplateBased sablon) jediny soubor aplikace, ktery pouziva funkci require_once
use semestralkaweb\ApplicationStart;

require_once "autoloader.inc.php";
require_once "../composer/vendor/autoload.php";


// nactu vlastni nastaveni webu
require_once "settings.inc.php";

// spustim aplikaci
$app = new ApplicationStart();
$app->appStart();
