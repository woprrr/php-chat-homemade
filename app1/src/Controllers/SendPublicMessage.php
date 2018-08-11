<?php

namespace App\Controllers;

use App\Models\ChatInterface;
use App\Models\Message;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SendPublicMessage.
 *
 * @package App\Controllers
 */
class SendPublicMessage extends SendMessage
{

  use BaseControllerTrait;

  /**
   * Controller to persist public message from database.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function publicMessage(Request $request): Response
  {
    $this->setUserSession();
    try {
      $user = $this->loadUser($this->session->get('userId'));
      $newMessage = new Message();
      $newMessage->setUserId($user);
      // @TODO in future feature we can change that to make,
      // ability to create N public chats...
      $newMessage->setChatId(ChatInterface::DEFAULT);
      $newMessage->setText($request->get('_text'));

      $this->sendMessage($newMessage);
    }
    catch (\Exception $exception) {
      echo $exception->getMessage();
    }

    return new RedirectResponse('/chatroom');
  }

}
