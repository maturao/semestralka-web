<?php


namespace semestralkaweb\Controllers;


use semestralkaweb\Models\User;
use semestralkaweb\MVC\ADBController;
use semestralkaweb\MVC\ErrorMessages;
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

    public function adminUsers(): IActionResult
    {
        $users = $this->db->getAllUsers();
        $roles = $this->db->getAllRoles();

        return $this->viewResultDB("AdminUsers", "Správa uživatelů", "users", $users, array("roles" => $roles));
    }

    public function editUserRole(): IActionResult
    {
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