<?php


namespace semestralkaweb\Models;


/**
 * Reprezentuje objekt z tabulky `article`
 * @package semestralkaweb\Models
 */
class Article
{
    public $id;
    public $id_user;
    public $user;
    public $display_name;
    public $abstract;
    public $pdf_file;
    public $id_article_state;
    public $article_state;
    public $review_count;
}