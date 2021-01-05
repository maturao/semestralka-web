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
}