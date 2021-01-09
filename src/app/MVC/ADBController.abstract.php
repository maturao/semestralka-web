<?php


namespace semestralkaweb\MVC;


use semestralkaweb\Controllers\HomeController;
use semestralkaweb\Models\DatabaseModel;
use semestralkaweb\Models\UserLoginModel;


/**
 * Zakladni trida pro controllery pracujici s databazi a prihlasenym uzivatelem
 * @package semestralkaweb\MVC
 */
abstract class ADBController extends ABaseController
{
    /** @var DatabaseModel model databaze */
    protected $db;
    /** @var UserLoginModel model prihlaseneho uzivatele */
    protected $ulm;

    /**
     * Nastavi zakladni atributy
     */
    public function __construct()
    {
        $this->db = DatabaseModel::getDatabaseModel();
        $this->ulm = new UserLoginModel();
    }

    /**
     * Vrati, zda ma prihlaseny uzivatel dostatecne opravneni
     * @param string $id_role opravneni, ktere zkontrolovat
     * @return bool zda ma prihlaseny uzivatel dostatecne opravneni
     */
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

    /**
     * Pomoci funkce userHasRole zjisti, zda ma prihlaseny
     * uzivatel dostatecna opraveni a popride nastavi chybovoou hlasku
     * @param string $id_role opravneni
     * @return bool zda uzivatel nema dostatecna opravneni
     */
    protected function isRoleError(string $id_role): bool
    {
        if ($this->userHasRole($id_role)) {
            return false;
        }

        ErrorMessages::instance()->addMessage("Nedostatečná oprávnění");
        return true;
    }

    /**
     * Vrati domovskou stranku
     * @return IActionResult domovska stranka
     */
    protected function redirectToHome(): IActionResult
    {
        return (new HomeController())->index();
    }

    /**
     * Vrati view vysledek
     * @param string $view nazev view
     * @param string $title nadpis stranky
     * @param string|null $modelName jmeno modelu pro view
     * @param null $model model pro view
     * @param array|null $additionalData dalsi data pro view
     * @return ViewResult view vysledek
     */
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