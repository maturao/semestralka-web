<?php


namespace semestralkaweb\MVC;


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

    protected function viewResultDB(string $view, string $title, string $modelName = null, $model = null): ViewResult
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

        return $this->viewResult($view, $data);
    }
}