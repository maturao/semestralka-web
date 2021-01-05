<?php


namespace semestralkaweb\MVC;


use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class ViewResult implements IActionResult
{
    /** @var string $view název view (bez pripony) */
    private $view;

    /** @var array $data data pro view */
    private $data;

    /**
     * ViewResult constructor.
     * @param string $view
     * @param array $data
     */
    public function __construct(string $view, array $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function execute(): void
    {
        $templatesDirectory = 'app/Views';
        $currentTemplateName = $this->view . ".twig";
        $loader = new FilesystemLoader($templatesDirectory);

        $twig = new Environment($loader, [
            'debug' => true,
            /*'cache' => 'vlastni_cache',*/
        ]);
        $twig->addExtension(new DebugExtension());

        echo $twig->render($currentTemplateName, $this->data);
    }
}