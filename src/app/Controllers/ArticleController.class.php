<?php


namespace semestralkaweb\Controllers;


use DateTime;
use semestralkaweb\Models\Article;
use semestralkaweb\Models\Review;
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

        return $this->viewResultDB("AllArticle", "Články", "articles", $articles);
    }

    public function detail($id = null): IActionResult
    {
        if ($id == null) {
            $id = Utils::getOrDefault($_GET, "id", null);
        }

        if ($id == null) {
            return new NotFoundResult();
        }

        $article = $this->db->getArticleById($id);
        $reviews = $this->db->getArticleReviews($id);
        $reviewers = $this->db->getArticlePossibleReviewers($id);

        $data = array(
            "reviews" => $reviews,
            "reviewers" => $reviewers,
        );


        return $this->viewResultDB("ArticleDetail", "Článek", "article", $article, $data);
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

    public function addReview(): IActionResult
    {
        /** @var Review $review */
        $review = Utils::fillFromRequest(Review::class);

        $this->db->createReview($review);

        return $this->detail($review->id_article);
    }

    public function deleteReview(): IActionResult
    {
        /** @var Review $review */
        $id_review = Utils::getOrDefault($_GET, "id_review", null);
        $id = Utils::getOrDefault($_GET, "id", null);

        if ($id_review != null) {
            $this->db->deleteReview($id_review);
        }

        return $this->detail($id);
    }

    public function createArticle(): IActionResult
    {
        /** @var Article $newArticle */
        $newArticle = Utils::fillFromRequest(Article::class);

        $pdfFile = Utils::getOrDefault($_FILES, "pdf", null);

        if ($newArticle->display_name != null || $newArticle->abstract != null || $pdfFile != null) {
            if ($newArticle->display_name == null) {
                ErrorMessages::instance()->addMessage("Chybí název příspěvku");
            }

            if ($newArticle->abstract == null) {
                ErrorMessages::instance()->addMessage("Chybí abstrakt příspěvku");
            }

            if ($pdfFile == null) {
                ErrorMessages::instance()->addMessage("Chybí pdf soubor");
            } else if (ErrorMessages::instance()->messageCount() == 0) {
                if ($pdfFile["type"] != "application/pdf") {
                    ErrorMessages::instance()->addMessage("Soubor není typu pdf");
                } else {
                    $date = new DateTime();
                    $filename = "upload/article" . $date->getTimestamp() . ".pdf";
                    $newArticle->pdf_file = $filename;
                    if (!move_uploaded_file($pdfFile["tmp_name"], $filename)) {
                        ErrorMessages::instance()->addMessage("Chyba uploadu");
                    }
                }
            }

            if (ErrorMessages::instance()->messageCount() > 0) {
                return $this->viewResultDB("ArticleNew", "Nový příspěvěk", "article", $newArticle);
            }

            $newArticle->id_user = $this->ulm->getCurrentUser()->id;
            $this->db->createArticle($newArticle);
            return $this->index();
        }

        return $this->viewResultDB("ArticleNew", "Nový příspěvěk");
    }
}