<?php


namespace semestralkaweb\Controllers;


use semestralkaweb\Models\Article;
use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\ErrorMessages;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\MVC\NotFoundResult;
use semestralkaweb\MVC\ViewResult;
use semestralkaweb\Utils;


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

    public function detail(): IActionResult
    {
        $id = Utils::getOrDefault($_GET, "id", null);

        if ($id == null) {
            return new NotFoundResult();
        }

        $article = $this->db->getArticleById($id);

        return $this->viewResultDB("ArticleDetail", "Článek", "article", $article);
    }

    public function adminArticles(): IActionResult
    {
        $articles = $this->db->getAllArticles();
        $article_states = $this->db->getAllArticleStates();

        $data = array(
            "articles" => $articles,
            "article_states" => $article_states,
        );

        return $this->viewResultDB("AdminArticles", "Správa článků", null, null, $data);
    }

    public function editArticleState(): IActionResult
    {
        /** @var Article $article */
        $article = Utils::fillFromRequest(Article::class);

        if ($article->id != null && $article->id_article_state != null) {
            $this->db->updateArticleState($article);
        } else {
            ErrorMessages::instance()->addMessage("Chyba při editaci stavu");
        }

        return $this->adminArticles();
    }
}