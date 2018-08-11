<?php

namespace App\Controllers;

use App\Models\Message;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SendPrivateMessage.
 *
 * @package App\Controllers
 */
class SendPrivateMessage extends SendMessage
{

  use BaseControllerTrait;

  /*
   * The id of private chat room.
   *
   * @var id
   * @TODO make possible to find dynamically private room.
   */
  const CHAT_PRIVATE_ID = 2;


  /**
   * Controller to persist private message from database.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function privateMessage(Request $request): Response
  {
    $this->setUserSession();
    try {
      $user = $this->loadUser($this->session->get('userId'));
      $newMessage = new Message();
      $newMessage->setUserId($user);
      $newMessage->setChatId(self::CHAT_PRIVATE_ID);
      $newMessage->setText($request->get('_text'));
      $this->sendMessage($newMessage);
    }
    catch (\Exception $exception) {
      echo $exception->getMessage();
    }

    return new RedirectResponse('/privateroom');
  }

}
