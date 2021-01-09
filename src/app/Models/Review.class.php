<?php


namespace semestralkaweb\Models;


/**
 * Reprezentuje objekt z tabulky `review`
 * @package semestralkaweb\Models
 */
class Review
{
    public $id;
    public $id_user;
    public $user;
    public $id_article;
    public $article;
    public $content_quality;
    public $technical_quality;
    public $language_quality;
}