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

    protected function userHasRole(string $id_role): bool
    {
        $user = $this->ulm->getCurrentUser();

        if ($user == null) {
            return false;
        }

        if ($user->id_role == "admin") {
            return true;
        }

        if ($user->id_role == "reviewer") {
            return $id_role == "reviewer" || $id_role == "author";
        }

        if ($user->id_role == "author") {
            return $id_role == "author";
        }

        return false;
    }

    protected function isRoleError(string $id_role): bool
    {
        if ($this->userHasRole($id_role)) {
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