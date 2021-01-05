<?php


namespace semestralkaweb\Controllers;


use semestralkaweb\Models\User;
use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\Utils;


class UserController extends ADBController
{
    public function index(): IActionResult
    {
        return $this->viewResultDB("User", "Uživatel");
    }

    public function login(): IActionResult
    {
        /** @var User $user */
        $user = Utils::fillFromRequest(User::class);

        $this->ulm->userLogin($user->login, $user->password);

        return $this->viewResultDB("User", "Uživatel", "login_user", $user);
    }

    public function logout(): IActionResult
    {
        $this->ulm->userLogout();

        return $this->index();
    }

    public function register(): IActionResult
    {
        /** @var User $user */
        $user = Utils::fillFromRequest(User::class);

        $this->ulm->userRegister($user->login, $user->password);

        return $this->viewResultDB("User", "Uživatel", "register_user", $user);
    }
}