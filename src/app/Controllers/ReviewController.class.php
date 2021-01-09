<?php


namespace semestralkaweb\Controllers;


use semestralkaweb\Models\Review;
use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\ErrorMessages;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\MVC\RedirectResult;
use semestralkaweb\Utils;


class ReviewController extends ADBController
{
    public function userReviews(): IActionResult
    {
        if ($this->isRoleError("reviewer")) {
            return $this->redirectToHome();
        }

        $user = $this->ulm->getCurrentUser();

        if ($user == null) {
            ErrorMessages::instance()->addMessage("Nepřihlášený uživatel");
            return new RedirectResult(Utils::link("Home", "index"));
        }

        $reviews = $this->db->getUserReviews($user->id);

        return $this->viewResultDB("UserReviews", "Moje recenze", "reviews", $reviews);
    }

    public function editReview(?string $id = null): IActionResult
    {
        if ($this->isRoleError("reviewer")) {
            return $this->redirectToHome();
        }

        if ($id == null) {
            $id = Utils::getOrDefault($_GET, "id", null);
        }
        if ($id != null) {
            $reviewDb = $this->db->getReview($id);
            $article = $this->db->getArticleById($reviewDb->id_article);
            return $this->viewResultDB("EditReview", "Upravit recenzi", "review", $reviewDb, array("article" => $article));
        }

        /** @var Review $review */
        $review = Utils::fillFromRequest(Review::class);
        if (0 > $review->content_quality || $review->content_quality > 100) {
            ErrorMessages::instance()->addMessage("Hodnocení kvality obsahu musí být mezi 0 a 100");
        }
        if (0 > $review->technical_quality || $review->technical_quality > 100) {
            ErrorMessages::instance()->addMessage("Hodnocení kvality technického zpracování musí být mezi 0 a 100");
        }
        if (0 > $review->language_quality || $review->language_quality > 100) {
            ErrorMessages::instance()->addMessage("Hodnocení kvality jazyka musí být mezi 0 a 100");
        }

        if (ErrorMessages::instance()->messageCount() > 0) {
            $reviewDb = $this->db->getReview($review->id);
            $article = $this->db->getArticleById($reviewDb->id_article);
            return $this->viewResultDB("EditReview", "Upravit recenzi", "review", $reviewDb, array("article" => $article));
        }

        $this->db->editReview($review);
        return $this->userReviews();
    }
}