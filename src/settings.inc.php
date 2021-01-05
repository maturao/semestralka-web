<?php

//// Pripojeni k databazi ////

/** Adresa serveru. */
const DB_SERVER = "localhost";
/** Nazev databaze. */
const DB_NAME = "semestralka-web";
/** Uzivatel databaze. */
const DB_USER = "root";
/** Heslo uzivatele databaze */
const DB_PASS = "";


//// Nazvy tabulek v DB ////

const TABLE_USER = "maturao_user";
const TABLE_ROLE = "maturao_role";
const TABLE_ARTICLE = "maturao_article";
const TABLE_ARTICLE_STATE = "maturao_article_state";
const TABLE_REVIEW = "maturao_review";

//
///** Dostupne webove stranky. */
//const WEB_PAGES = array(//// Uvodni stranka ////
//    "uvod" => array(
//        "title" => "Úvodní stránka",
//
//        //// kontroler
//        //"file_name" => "IntroductionController.class.php",
//        "controller_class_name" => \semestralkaweb\Controllers\IntroductionController::class, // poskytne nazev tridy vcetne namespace
//
//        // ClassBased sablona
//        "view_class_name" => \semestralkaweb\Views\ClassBased\IntroductionTemplate::class,
//
//        // TemplateBased sablona
//        //"view_class_name" => \semestralkaweb\Views\TemplateBased\TemplateBasics::class,
//        "template_type" => \semestralkaweb\Views\TemplateBased\TemplateBasics::PAGE_INTRODUCTION,
//    ),
//    //// KONEC: Uvodni stranka ////
//
//    //// Sprava uzivatelu ////
//    "sprava" => array(
//        "title" => "Správa uživatelů",
//
//        //// kontroler
//        //"file_name" => "UserManagementController.class.php",
//        "controller_class_name" => \semestralkaweb\Controllers\UserManagementController::class,
//
//        // ClassBased sablona
//        //"view_class_name" => \semestralkaweb\Views\ClassBased\UserManagementTemplate::class,
//
//        // TemplateBased sablona
//        "view_class_name" => \semestralkaweb\Views\TemplateBased\TemplateBasics::class,
//        "template_type" => \semestralkaweb\Views\TemplateBased\TemplateBasics::PAGE_USER_MANAGEMENT,
//    ),
//    //// KONEC: Sprava uzivatelu ////
//
//);


