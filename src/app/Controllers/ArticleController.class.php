<?php


namespace semestralkaweb\Controllers;


use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\MVC\ViewResult;


class ArticleController extends ADBController
{
    public function index(): IActionResult
    {
        $articles = $this->db->getAllArticles();

        $data = array(
            "title" => "Article Index",
            "articles" => $articles
        );

        return new ViewResult("AllArticle", $data);
    }
}