<?php


namespace semestralkaweb\MVC;


use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
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
        ]);
        $twig->addExtension(new DebugExtension());

        try {
            echo $twig->render($currentTemplateName, $this->data);
        } catch (LoaderError $e) {
            echo "Twig loader error<br/>";
            var_dump($e);
        } catch (RuntimeError $e) {
            echo "Twig runtime error error<br/>";
            var_dump($e);
        } catch (SyntaxError $e) {
            echo "Twig syntax error<br/>";
            var_dump($e);
        }
    }
}