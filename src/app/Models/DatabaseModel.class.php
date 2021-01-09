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

    public function getAllUsers(): array
    {
        $q = "SELECT * FROM `maturao_user_view`";

        $pst = $this->pdo->prepare($q);
        $pst->execute();
        return $pst->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function updateUserRole(User $user): void
    {
        $q = "UPDATE `maturao_user` SET id_role=:id_role WHERE id=:id";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id_role", $user->id_role);
        $pst->bindParam(":id", $user->id);
        $pst->execute();
    }

    public function getAllRoles(): array
    {
        $q = "SELECT * FROM `maturao_role`";

        $pst = $this->pdo->prepare($q);
        $pst->execute();
        return $pst->fetchAll(PDO::FETCH_CLASS, Role::class);
    }

    public function getAllArticles(): array
    {
        $q = "SELECT * FROM `maturao_article_view`";

        $pst = $this->pdo->prepare($q);
        $pst->execute();
        return $pst->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function getAllAcceptedArticles(): array
    {
        $q = "SELECT * FROM `maturao_article_view` WHERE id_article_state='accepted' ";

        $pst = $this->pdo->prepare($q);
        $pst->execute();
        return $pst->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function getAllArticleStates(): array
    {
        $q = "SELECT * FROM `maturao_article_state`";

        $pst = $this->pdo->prepare($q);
        $pst->execute();
        return $pst->fetchAll(PDO::FETCH_CLASS, ArticleState::class);
    }

    public function updateArticleState(Article $article): void
    {
        $q = "UPDATE `maturao_article` SET id_article_state=:id_article_state WHERE id=:id";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id_article_state", $article->id_article_state);
        $pst->bindParam(":id", $article->id);
        $pst->execute();
    }

    public function getArticleById(string $id): ?Article
    {
        $q = "SELECT * FROM maturao_article_view WHERE id=:id";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id", $id);

        $pst->execute();

        $article = $pst->fetchObject(Article::class);
        if ($article === false) {
            return null;
        }

        return $article;
    }

    public function getArticleReviews(string $id): array
    {
        $q = "SELECT * FROM maturao_review_view WHERE id_article=:id";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id", $id);

        $pst->execute();

        return $pst->fetchAll(PDO::FETCH_CLASS, Review::class);
    }

    public function getArticlePossibleReviewers($id): array
    {
        $q = "
            SELECT
                *
            FROM
                `maturao_user_view`
            WHERE
                id_role = 'reviewer' AND NOT EXISTS(
                SELECT
                    *
                FROM
                    maturao_review
                WHERE
                    id_article = :id AND id_user = `maturao_user_view`.`id`
            )";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id", $id);
        $pst->execute();
        return $pst->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function createReview(Review $review): void
    {
        $q = "INSERT INTO `maturao_review` (`id_user`, `id_article`) VALUES (:id_user, :id_article)";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id_user", $review->id_user);
        $pst->bindParam(":id_article", $review->id_article);
        $pst->execute();
    }

    public function deleteReview(string $id): void
    {
        $q = "DELETE FROM `maturao_review` WHERE id=:id";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id", $id);
        $pst->execute();
    }

    public function createArticle(Article $newArticle): void
    {
        $q = "INSERT INTO `maturao_article` (`id_user`, `display_name`, `abstract`, `pdf_file`, `id_article_state`) 
        VALUES (:id_user, :display_name, :abstract, :pdf_file, 'reviewing')";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id_user", $newArticle->id_user);
        $pst->bindParam(":display_name", $newArticle->display_name);
        $pst->bindParam(":abstract", $newArticle->abstract);
        $pst->bindParam(":pdf_file", $newArticle->pdf_file);

        $pst->execute();
    }

    public function getAllUserArticles(string $id_user): array
    {
        $q = "SELECT * FROM `maturao_article_view` WHERE id_user=:id_user";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id_user", $id_user);
        $pst->execute();
        return $pst->fetchAll(PDO::FETCH_CLASS, Article::class);
    }

    public function getUserReviews($id): array
    {
        $q = "SELECT * FROM maturao_review_view WHERE id_user=:id AND id_article_state='reviewing'";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id", $id);

        $pst->execute();

        return $pst->fetchAll(PDO::FETCH_CLASS, Review::class);
    }

    public function getReview($id): ?Review
    {
        $q = "SELECT * FROM `maturao_review_view` WHERE id=:id";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id", $id);

        $pst->execute();

        $review = $pst->fetchObject(Review::class);
        if ($review === false) {
            return null;
        }

        return $review;
    }

    public function editReview(Review $review): void
    {
        $q = "UPDATE `maturao_review` SET content_quality=:content_quality, technical_quality=:technical_quality, language_quality=:language_quality WHERE id=:id";

        $pst = $this->pdo->prepare($q);
        $pst->bindParam(":id", $review->id);
        $pst->bindParam(":content_quality", $review->content_quality);
        $pst->bindParam(":technical_quality", $review->technical_quality);
        $pst->bindParam(":language_quality", $review->language_quality);
        $pst->execute();
    }


}
