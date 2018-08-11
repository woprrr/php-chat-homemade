<?php

namespace App\Controllers;

use App\Models\Message;
use App\Models\MessageRepository;

/**
 * Class SendMessage.
 *
 * @package App\Controllers
 * @TODO Make interface.
 */
class SendMessage
{
    use BaseControllerTrait;

    /**
     * Controller used to persist messages from database.
     *
     * @param \App\Models\Message $newMessage The new message instance to persist.
     */
    protected function sendMessage(Message $newMessage): void
    {
        try {
            $messageRepo = new MessageRepository();
            $messageRepo->save($newMessage);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        $this->setNotice("Message correctly added.");
    }
}
