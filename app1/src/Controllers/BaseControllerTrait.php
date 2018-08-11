<?php

namespace App\Controllers;

use App\Models\UserRepository;
use App\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Trait BaseControllerTrait.
 *
 * @package App\Controllers
 */
trait BaseControllerTrait
{
    /**
     * The current session object.
     *
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    public $session;

    /**
     * Common method that responsible of rendering of HTML content.
     *
     * @param string $name  The name of template to render.
     * @param array $args   The argument given to twig render.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render(string $name, array $args = []): Response
    {
        return new Response(View::renderTwig($name, $args), Response::HTTP_OK);
    }

    /**
     * Set the session if any session are already active.
     */
    public function setUserSession(): void
    {
        if (!isset($this->session)) {
            $session = new Session();
            $session->start();
            $this->session = $session;
        }
    }

    /**
     * Get all notices message from the session flash bag.
     *
     * @return array|null An array containing all notices from the FlashBag.
     */
    public function getStatusNotice(): ?array
    {
        $statusMessages = [];
        $notices = $this->getStatus('notice');
        for ($l = 0; $l < count($notices); $l++) {
            $statusMessages[] = $notices[$l];
        }

        return $statusMessages;
    }

    /**
     * Get the status message from the flash bag for given type.
     *
     * @return array|null An array containing all notices for given type.
     */
    public function getStatus(string $type): ?array
    {
        return $this->session->getFlashBag()->get($type, []);
    }

    /**
     * Evaluate if current user is loggedIn from session.
     *
     * @return bool True if current user is logged in or False.
     */
    public function isLoggedIn(): bool
    {
        return !empty($this->session->get('userId'));
    }

    /**
     * Set a notice message from session flash bag.
     */
    public function setNotice(string $message): void
    {
        if (!empty($message)) {
            $this->session->getFlashBag()->add('notice', $message);
        }
    }

    /**
     * Redirect from given uri.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect(string $uri): RedirectResponse
    {
        return new RedirectResponse($uri);
    }

    /**
     * Initialize the session and perform common checks for controllers.
     *
     * In this project we need to manage sessions manually,
     * instead of use session.auto_start in php.ini.
     *
     * @param string $message     The message to display during init.
     * @param string $redirectUri The uri to redirect client if not loggedIn.
     */
    public function init(string $message = '', string $redirectUri = '/login'): void
    {
        $this->setUserSession();
        if ($this->isLoggedIn()) {
            $this->setNotice($message);
            $this->redirect($redirectUri);
        }
    }

    /**
     * Load user for given id.
     *
     * @param int $userId The id of user to load.
     *
     * @return \App\Models\User|array|null  One or a collection of users loaded.
     */
    public function loadUser(int $userId = 0)
    {
        $userRepo = new UserRepository();
        /* NITPICK : Always return an array.
         * In the first case an array with one user.
         * In the second case an array with all users.
         */
        if (!empty($userId)) {
            return $userRepo->findById($this->session->get('userId'));
        } else {
            return $userRepo->findAllUsers();
        }
    }
}
