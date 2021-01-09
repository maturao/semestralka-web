<?php

/** @var string BASE_NAMESPACE_NAME  Zakladni namespace. */
const BASE_NAMESPACE_NAME = "semestralkaweb";
/** @var string BASE_APP_DIR_NAME  Vychozi adresar aplikace. */
const BASE_APP_DIR_NAME = "app";

/** @var array FILE_EXTENSIONS  Dostupne pripony souboru, ktere budou testovany pri nacitani souboru pozadovanych trid. */
const FILE_EXTENSIONS = array(".class.php", ".interface.php", ".abstract.php");

// automaticka registrace pozadovanych trid
spl_autoload_register(function ($className) {
    $className = str_replace(BASE_NAMESPACE_NAME, BASE_APP_DIR_NAME, $className);
    $fileName = dirname(__FILE__) . "\\" . $className;

    foreach (FILE_EXTENSIONS as $ext) {
        if (file_exists($fileName . $ext)) {
            require_once($fileName . $ext);
            break;
        }
    }
});
