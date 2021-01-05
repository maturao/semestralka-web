<?php


namespace semestralkaweb\Models;


class UserLoginModel
{
    /** @var DatabaseModel $db Objekt pro spravu databaze */
    public $db;

    /** @var string $userSessionKey Klicem pro data uzivatele, ktera jsou ulozena v session. */
    private $userSessionKey = "current_user_id";

    /**
     * UserLoginModel constructor.
     */
    public function __construct()
    {
        $this->db = DatabaseModel::getDatabaseModel();
        session_start();
    }

    ///////////////////  Sprava prihlaseni uzivatele  ////////////////////////////////////////

    /**
     * Prihlasi uzivatele
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function userLogin(string $login, string $password): bool
    {
        $db_user = $this->db->getUser(null, $login);
        if ($db_user == null) {
            return false;
        }


        if (!password_verify($password, $db_user->password)) {
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
            $this->userLogout();
            return null;
        }

        $user = $this->db->getUser($userId);

        if (empty($userData)) {
            $this->userLogout();
            return null;
        }

        return $user;
    }
}