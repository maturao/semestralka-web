<?php


namespace semestralkaweb\Models;


use semestralkaweb\MVC\ErrorMessages;


/**
 * Trida pro praci s prihlasenum uzivatelem
 * @package semestralkaweb\Models
 */
class UserLoginModel
{
    /** @var DatabaseModel $db Objekt pro spravu databaze */
    private $db;

    /** @var ErrorMessages $em Objekt pro spravu chybovych hlasek */
    private $em;

    /** @var string $userSessionKey Klic pro id uzivatele v session */
    private $userSessionKey = "logged_user_id";

    /**
     * Spusti session
     * UserLoginModel constructor.
     */
    public function __construct()
    {
        $this->db = DatabaseModel::getDatabaseModel();
        $this->em = ErrorMessages::instance();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Pokusi se prihlasit uzivatele
     * @param string|null $login logion
     * @param string|null $password heslo
     * @return bool zda se prihlaseni povedlo
     */
    public function userLogin(?string $login, ?string $password): bool
    {
        if ($login == null) {
            $this->em->addMessage("Nebyl zadaný login");
            return false;
        }

        if ($password == null) {
            $this->em->addMessage("Nebylo zadané heslo");
            return false;
        }

        $db_user = $this->db->getUserByLogin($login);
        if ($db_user == null) {
            $this->em->addMessage("Nesprávný login");
            return false;
        }

        if (!password_verify($password, $db_user->password)) {
            $this->em->addMessage("Nesprávné heslo");
            return false;
        }

        $_SESSION[$this->userSessionKey] = $db_user->id;

        return true;
    }

    /**
     * Odhlasi prihlaseneho uzivatele
     */
    public function userLogout()
    {
        unset($_SESSION[$this->userSessionKey]);
    }

    /**
     * Zjisti zda je uzivatel prihlasen
     * @return bool zda je uzivatel prihlasen
     */
    public function isUserLogged(): bool
    {
        return isset($_SESSION[$this->userSessionKey]);
    }


    /**
     * Vrati prihlaseneho uzivatele, nebo null
     * @return User|null prihlazeny uzivatel
     */
    public function getCurrentUser(): ?User
    {
        if (!$this->isUserLogged()) {
            return null;
        }

        $userId = $_SESSION[$this->userSessionKey];
        if ($userId == null) {
            $this->em->addMessage("Není přihlášen uživatel");
            $this->userLogout();
            return null;
        }

        $user = $this->db->getUserById($userId);

        if ($user == null) {
            $this->em->addMessage("Přihlášený uživatel je neplatný");
            $this->userLogout();
            return null;
        }

        return $user;
    }

    /**
     * Zaregistruje uzivatele
     * @param string|null $login login
     * @param string|null $password heslo
     */
    public function userRegister(?string $login, ?string $password): void
    {
        if ($login == null) {
            $this->em->addMessage("Nebyl zadaný login");
            return;
        }

        if ($password == null) {
            $this->em->addMessage("Nebylo zadané heslo");
            return;
        }

        $db_user = $this->db->getUserByLogin($login);
        if ($db_user != null) {
            $this->em->addMessage("Login již existuje");
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $newUser = new User();
        $newUser->password = $passwordHash;
        $newUser->login = $login;

        $this->db->createUser($newUser);

        $db_user = $this->db->getUserByLogin($login);
        $_SESSION[$this->userSessionKey] = $db_user->id;
    }
}