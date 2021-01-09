<?php


namespace semestralkaweb\Controllers;


use DateTime;
use semestralkaweb\Models\Article;
use semestralkaweb\Models\Review;
use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\ErrorMessages;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\MVC\NotFoundResult;
use semestralkaweb\Utils;

/**
 * Controller, ktery obsluhuje stranky souvisejici s tabulkou `article`
 * @package semestralkaweb\Controllers
 */
class ArticleController extends ADBController
{
    /**
     * Vychozi akce; vrati stranku se vsemi prispevky
     * @return IActionResult AllArticle view
     */
    public function index(): IActionResult
    {
        $articles = $this->db->getAllAcceptedArticles();

        return $this->viewResultDB("AllArticle", "Články", "articles", $articles);
    }

    /**
     * Vrati stranku se vsemi prispevky prihlaseneho uzivatele
     * @return IActionResult UserArticles view
     */
    public function userArticles(): IActionResult
    {
        if ($this->isRoleError("author")) {
            return $this->redirectToHome();
        }

        $user = $this->ulm->getCurrentUser();
        if ($user == null) {
            return $this->index();
        }

        $articles = $this->db->getAllUserArticles($user->id);

        return $this->viewResultDB("UserArticles", "Články", "articles", $articles);
    }

    /**
     * Vrati stranku s detailem prispevku
     * @param null $id id prispevku
     * @return IActionResult ArticleDetail view
     */
    public function detail($id = null): IActionResult
    {
        if ($this->isRoleError("admin")) {
            return $this->redirectToHome();
        }

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

    /**
     * Vrati stranku pro administraci clanku
     * @return IActionResult AdminArticles view
     */
    public function adminArticles(): IActionResult
    {
        if ($this->isRoleError("admin")) {
            return $this->redirectToHome();
        }

        $articles = $this->db->getAllArticles();
        $article_states = $this->db->getAllArticleStates();

        $data = array(
            "articles" => $articles,
            "article_states" => $article_states,
        );

        return $this->viewResultDB("AdminArticles", "Správa článků", null, null, $data);
    }

    /**
     * Akce, pro editaci stavu clanku.
     * Vraci stranku pro administraci clanku
     * @return IActionResult AdminArticles view
     */
    public function editArticleState(): IActionResult
    {
        if ($this->isRoleError("admin")) {
            return $this->redirectToHome();
        }

        /** @var Article $article */
        $article = Utils::fillFromRequest(Article::class);

        if ($article->id != null && $article->id_article_state != null) {
            $articleDb = $this->db->getArticleById($article->id);
            if ($articleDb->review_count < 3) {
                ErrorMessages::instance()->addMessage("Pro změnu stavu musí mít članék alespoň 3 hotové recenze");
            } else {
                $this->db->updateArticleState($article);
            }
        } else {
            ErrorMessages::instance()->addMessage("Chyba při editaci stavu");
        }

        return $this->adminArticles();
    }

    /**
     * Akce pro prideleni clanku recenzentovi - tedy vytvoreni nove recenze.
     * Vraci stranku s detailem prispevku
     * @return IActionResult ArticleDetail view
     */
    public function addReview(): IActionResult
    {
        if ($this->isRoleError("admin")) {
            return $this->redirectToHome();
        }

        /** @var Review $review */
        $review = Utils::fillFromRequest(Review::class);

        $this->db->createReview($review);

        return $this->detail($review->id_article);
    }

    /**
     * Akce pro mazani recenzi
     * Vraci stranku s detailem prispevku
     * @return IActionResult ArticleDetail view
     */
    public function deleteReview(): IActionResult
    {
        if ($this->isRoleError("admin")) {
            return $this->redirectToHome();
        }

        /** @var Review $review */
        $id_review = Utils::getOrDefault($_GET, "id_review", null);
        $id = Utils::getOrDefault($_GET, "id", null);

        if ($id_review != null) {
            $this->db->deleteReview($id_review);
        }

        return $this->detail($id);
    }

    /**
     * Akce pro vytvoreni clanku.
     * Vraci bud stranku pro vytvoreni clanku, nebo stranku s clanky uzivatele
     * @return IActionResult ArticleNew view, UserArticles view
     */
    public function createArticle(): IActionResult
    {
        if ($this->isRoleError("author")) {
            return $this->redirectToHome();
        }

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
            return $this->userArticles();
        }

        return $this->viewResultDB("ArticleNew", "Nový příspěvěk");
    }
}