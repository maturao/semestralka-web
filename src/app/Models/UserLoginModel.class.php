<?php


namespace semestralkaweb\Models;


use semestralkaweb\MVC\ErrorMessages;

class UserLoginModel
{
    /** @var DatabaseModel $db Objekt pro spravu databaze */
    private $db;

    /** @var ErrorMessages $em Objekt pro spravu chybovych hlasek */
    private $em;

    /** @var string $userSessionKey Klic pro id uzivatele v session */
    private $userSessionKey = "logged_user_id";

    /**
     * UserLoginModel constructor.
     */
    public function __construct()
    {
        $this->db = DatabaseModel::getDatabaseModel();
        $this->em = ErrorMessages::instance();
        session_start();
    }

    /**
     * Prihlasi uzivatele
     * @param string $login
     * @param string $password
     * @return bool
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
     * Odhlasi soucasneho uzivatele.
     */
    public function userLogout()
    {
        unset($_SESSION[$this->userSessionKey]);
    }

    /**
     * Test, zda je nyni uzivatel prihlasen.
     */
    public function isUserLogged(): bool
    {
        return isset($_SESSION[$this->userSessionKey]);
    }


    /**
     * Vrátí přihlášeného uživatele
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