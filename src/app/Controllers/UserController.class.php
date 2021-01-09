<?php


namespace semestralkaweb\Controllers;


use semestralkaweb\Models\User;
use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\ErrorMessages;
use semestralkaweb\MVC\IActionResult;
use semestralkaweb\Utils;


/**
 * Controller, ktery obsluhuje stranky souvisejici s tabulkou `user`
 * @package semestralkaweb\Controllers
 */
class UserController extends ADBController
{
    /**
     * Vraci stranku pro prihlaseni, registraci nebo odhlaseni
     * @return IActionResult User view
     */
    public function index(): IActionResult
    {
        return $this->viewResultDB("User", "Uživatel");
    }

    /**
     * Akce pro prihlaseni uzivatele
     * @return IActionResult User view
     */
    public function login(): IActionResult
    {
        /** @var User $user */
        $user = Utils::fillFromRequest(User::class);

        $this->ulm->userLogin($user->login, $user->password);

        return $this->viewResultDB("User", "Uživatel", "login_user", $user);
    }

    /**
     * Akce pro odhlaseni uzivatele
     * @return IActionResult User view
     */
    public function logout(): IActionResult
    {
        if ($this->isRoleError("author")) {
            return $this->redirectToHome();
        }

        $this->ulm->userLogout();

        return $this->index();
    }

    /**
     * Akce pro registraci uzivatele
     * @return IActionResult User view
     */
    public function register(): IActionResult
    {
        /** @var User $user */
        $user = Utils::fillFromRequest(User::class);

        $this->ulm->userRegister($user->login, $user->password);

        return $this->viewResultDB("User", "Uživatel", "register_user", $user);
    }

    /**
     * Vrati stranku pro administraci uzivatelu
     * @return IActionResult AdminUsers view
     */
    public function adminUsers(): IActionResult
    {
        if ($this->isRoleError("admin")) {
            return $this->redirectToHome();
        }

        $users = $this->db->getAllUsers();
        $roles = $this->db->getAllRoles();

        return $this->viewResultDB("AdminUsers", "Správa uživatelů", "users", $users, array("roles" => $roles));
    }

    /**
     * Akce pro editaci role uzivatele
     * @return IActionResult AdminUsers view
     */
    public function editUserRole(): IActionResult
    {
        if ($this->isRoleError("admin")) {
            return $this->redirectToHome();
        }

        /** @var User $user */
        $user = Utils::fillFromRequest(User::class);

        if ($user->id != null && $user->id_role != null) {
            $this->db->updateUserRole($user);
        } else {
            ErrorMessages::instance()->addMessage("Chyba při editaci role");
        }

        return $this->adminUsers();
    }
}