<?php

namespace semestralkaweb\Models;

use PDO;

/**
 * Trida spravujici databazi.
 * @package semestralkaweb\Models
 */
class DatabaseModel
{

    /** @var DatabaseModel $instance Singleton databazoveho modelu. */
    private static $instance;

    /** @var PDO $pdo Objekt pracujici s databazi prostrednictvim PDO. */
    private $pdo;

    /**
     * Inicializace pripojeni k databazi.
     */
    private function __construct()
    {
        $this->pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $this->pdo->exec("set names utf8");
    }

    /**
     * Tovarni metoda pro poskytnuti singletonu databazoveho modelu.
     * @return DatabaseModel    Databazovy model.
     */
    public static function getDatabaseModel(): DatabaseModel
    {
        if (empty(self::$instance)) {
            self::$instance = new DatabaseModel();
        }
        return self::$instance;
    }

    public function getUserById(string $id): ?User
    {
        $q = "SELECT * FROM maturao_user_view WHERE id=:id";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id", $id);

        $pst->execute();

        $user = $pst->fetchObject(User::class);
        if ($user === false) {
            return null;
        }

        return $user;
    }

    public function getUserByLogin(string $login): ?User
    {
        $q = "SELECT * FROM maturao_user_view WHERE login=:login ";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":login", $login);

        $pst->execute();

        $user = $pst->fetchObject(User::class);
        if ($user === false) {
            return null;
        }

        return $user;
    }

    public function createUser(User $newUser): void
    {
        $q = "INSERT INTO `maturao_user` (`login`, `password`, `id_role`) VALUES (:login, :password, 'author')";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":login", $newUser->login);
        $pst->bindParam(":password", $newUser->password);
        $pst->execute();
    }

    public function getAllArticles(): array
    {
        $q = "SELECT * FROM " . TABLE_ARTICLE;

        $pst = $this->pdo->prepare($q);
        $pst->execute();
        return $pst->fetchAll(PDO::FETCH_CLASS, Article::class);
    }


}
