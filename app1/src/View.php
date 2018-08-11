<?php

namespace App;

use Twig_Extension_Debug;

/**
 * Class View.
 *
 * @package App
 */
class View
{
    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = dirname(__DIR__) . "/Views/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return string The rendered template
     */
    public static function renderTwig($template, $args = [])
    {
        static $twig = null;
        $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/src/Views');
        // Enable Dev mode.
        $twig = new \Twig_Environment($loader, ['debug' => true]);
        $twig->addExtension(new Twig_Extension_Debug());

        return $twig->render($template, $args);
    }
}
