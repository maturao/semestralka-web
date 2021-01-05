<?php


namespace semestralkaweb\MVC;


use semestralkaweb\Models\DatabaseModel;


abstract class ADBController extends ABaseController
{
    /**
     * @var DatabaseModel
     */
    protected $db;

    public function __construct()
    {
        $this->db = DatabaseModel::getDatabaseModel();
    }
}