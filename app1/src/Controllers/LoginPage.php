<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginPage.
 *
 * @package App\Controllers
 */
class LoginPage
{

  use BaseControllerTrait;

  /**
   * Controller of login page.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function login(): Response
  {
    $this->setUserSession();
    if ($this->session->get('userId')) {
      $this->session->getFlashBag()->add('notice', "You'r already loggedIn");
      return new RedirectResponse('/chatroom');
    }

    return $this->render('login.html.twig', [
      'title' => 'Login Page',
      'statusNotices' => $this->getStatusNotice(),
    ]);
  }

  /**
   * Evaluate if credentials are not empty.
   *
   * @param $userName The username from login form.
   * @param $password The password from login from.
   *
   * @return bool True if all fields are completed or False.
   */
  private function isBadCredentials (string $userName, string $password): bool
  {
    return empty($userName) || empty($password);
  }

  /**
   * Controller of authentication endpoint.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function authentication(Request $request): Response
  {
    $redirectResponse = new RedirectResponse('/login');
    $userName = htmlentities($request->get('_username'), ENT_QUOTES);
    $password = htmlentities($request->get('_password'), ENT_QUOTES);

    if ($this->isBadCredentials($userName, $password)) {
      // Add Message error reasons and log it.
      return $redirectResponse;
    }

    $userRepository = new UserRepository();
    $user = $userRepository->findOneByName($userName);

    if (empty($user)) {
      return $redirectResponse;
    }

    if (!password_verify($password, $user->getPassword())) {
      return $redirectResponse;
    }

    $this->setUserSession();
    if ($userName === $user->getName()) {
      $this->loginUser($user);
      $redirectResponse = new RedirectResponse('/chatroom');
    }

    return $redirectResponse;
  }

  /**
   * Controller of loginUser.
   *
   * @param \App\Models\User $user
   */
  public function loginUser(User $user): void
  {
    $this->setUserSession();
    $this->session->set('userId', $user->getId());
    $this->session->set('userName', $user->getName());
    $this->session->getFlashBag()->add('notice', "You're logged in");
  }

  /**
   * Controller of logout.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function logoutUser(): Response
  {
    $this->setUserSession();
    $this->session->invalidate();
    $this->session->getFlashBag()->add('notice', "You're correctly logout.");
    return new RedirectResponse('/login');
  }

}
