<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomePage.
 *
 * @package App\Controllers
 */
class HomePage
{
    use BaseControllerTrait;

    /**
     * Redirect from login page if not connected or general room if logged in.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(): Response
    {
        $this->init();
        $userId = $this->session->get('userId');
        if (empty($userId)) {
            return new RedirectResponse('/login');
        }

        return new RedirectResponse('/chatroom');
    }
}
