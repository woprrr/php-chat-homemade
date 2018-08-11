<?php

namespace App\Controllers;

use App\Models\ChatInterface;
use App\Models\MessageRepository;
use App\Models\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ChatRoomPage.
 *
 * @package App\Controllers
 */
class ChatRoomPage
{

  use BaseControllerTrait;

  /**
   * Controller of general chat room.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function generalRoom(): Response
  {
    $this->init();
    $userId = $this->session->get('userId');
    if (empty($userId)) {
      return new RedirectResponse('/login');
    }

    try {
      // $this->loadMessages($defaultChatId).
      $messageRepo = new MessageRepository();
      $content['messages'] = $messageRepo->findPublicChatMessages(ChatInterface::DEFAULT);
      $userLoggedIn = $this->loadUser($userId);
    }
    catch (\Exception $exception) {
      echo $exception->getMessage();
    }

    return $this->render('chatroom.html.twig', [
      'content' => $content,
      'title' => 'General T\'chat room',
      'users' => $this->loadUser(0),
      'statusNotices' => $this->getStatusNotice(),
      'userLoggedIn' => $userLoggedIn,
    ]);
  }

  /**
   * Controller of private chat room.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function privateRoom(Request $request): Response
  {
    $this->init();
    $userId = $this->session->get('userId');
    if (empty($userId)) {
      return new RedirectResponse('/login');
    }

    try {
      $userLoggedIn = $this->loadUser($userId);

      // We need to load chat dynamically but not time to finish it.
      $chatId = 2;
      $messageRepo = new MessageRepository();
      $content['messages'] = $messageRepo->findPrivateChatMessages($chatId);

      $userRepo = new UserRepository();
      $usersRegistered = $userRepo->findPrivateChatUsers($chatId);
    }
    catch (\Exception $exception) {
      echo $exception->getMessage();
    }

    return $this->render('privateroom.html.twig', [
      'content' => $content,
      'title' => 'Private Room',
      'users' => $usersRegistered,
      'statusNotices' => $this->getStatusNotice(),
      'userLoggedIn' => $userLoggedIn,
    ]);
  }

}
