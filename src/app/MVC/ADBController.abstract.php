<?php


namespace semestralkaweb\MVC;


use semestralkaweb\Controllers\HomeController;
use semestralkaweb\Models\DatabaseModel;
use semestralkaweb\Models\UserLoginModel;


abstract class ADBController extends ABaseController
{
    /**
     * @var DatabaseModel
     */
    protected $db;
    protected $ulm;

    public function __construct()
    {
        $this->db = DatabaseModel::getDatabaseModel();
        $this->ulm = new UserLoginModel();
    }

    protected function userHasRole(string $role): bool
    {
        $user = $this->ulm->getCurrentUser();
        if ($user == null) {
            return false;
        }

        if ($user->role == "admin") {
            return true;
        }

        if ($user->role == "reviewer") {
            return $role == "reviewer" || $role == "author";
        }

        if ($user->role == "author") {
            return $role == "author";
        }

        return false;
    }

    protected function isRoleError(string $role): bool
    {
        if ($this->userHasRole($role)) {
            return false;
        }

        ErrorMessages::instance()->addMessage("Nedostatečná oprávnění");
        return true;
    }

    protected function redirectToHome(): IActionResult
    {
        return (new HomeController())->index();
    }

    protected function viewResultDB(string $view, string $title, string $modelName = null, $model = null, ?array $additionalData = null): ViewResult
    {
        $data = array(
            "title" => $title,
            "user" => $this->ulm->getCurrentUser()
        );

        if (ErrorMessages::instance()->messageCount() > 0) {
            $data["error_messages"] = ErrorMessages::instance()->popMessages();
        }

        if ($model != null && $modelName != null) {
            $data[$modelName] = $model;
        }

        if ($additionalData != null) {
            foreach ($additionalData as $key => $value) {
                $data[$key] = $value;
            }
        }

        return $this->viewResult($view, $data);
    }
}