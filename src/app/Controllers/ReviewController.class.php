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

    public function editReview(): IActionResult
    {
        if ($this->isRoleError("reviewer")) {
            return $this->redirectToHome();
        }

        $id = Utils::getOrDefault($_GET, "id", null);
        if ($id != null) {
            $review = $this->db->getReview($id);
            $article = $this->db->getArticleById($review->id_article);
            return $this->viewResultDB("EditReview", "Upravit recenzi", "review", $review, array("article" => $article));
        }

        /** @var Review $review */
        $review = Utils::fillFromRequest(Review::class);
        $this->db->editReview($review);

        return $this->userReviews();
    }
}