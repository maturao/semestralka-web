<?php


namespace semestralkaweb\Controllers;


use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\ErrorMessages;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\MVC\RedirectResult;
use semestralkaweb\Utils;


class ReviewController extends ADBController
{
    public function userReviews(): IActionResult
    {
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
        return $this->viewResultDB("EditReview", "Upravit recenzi");
    }
}