<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Register.
 *
 * @package App\Controllers
 */
class Register
{

  use BaseControllerTrait;

  /**
   * Controller of register page.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function register(Request $request): Response
  {
    $this->init('You\'r already loggedIn', '/chatroom');

    /* We can refactor by extracting:
     * credentials,
     * user creation,
     * user persisting
     */
    try {
      // $this->userCredentials().
      $userName = htmlentities($request->get('_username'), ENT_QUOTES);
      $password = htmlentities($request->get('_password'), ENT_QUOTES);

      // $this->createUser($userName, $password).
      $newUser = new User();
      $newUser->setName($userName);
      $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT));

      // $this->persist($newUser).
      $userRepository = new UserRepository();
      $userRepository->save($newUser);
    }
    catch (\Exception $e) {
      // In future use LOGGER service.
      echo $e->getMessage();
    }

    return new RedirectResponse('/chatroom');
  }

  /**
   * Controller of register form page.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function registerForm(): Response
  {
    $this->init('You\'r already loggedIn', '/chatroom');
    return $this->render('register.html.twig');
  }

}
