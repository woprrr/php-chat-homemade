<?php

namespace App\Models;

/**
 * Interface MessageInterface.
 *
 * @package App\Models
 */
interface MessageInterface
{

  /**
   * Get the id of message.
   *
   * @return int The unique dentifier of message.
   */
    public function getId(): int;

    /**
     * Get the user_id of message.
     *
     * @return int The user id of message owner.
     */
    public function getUserId(): int;

    /**
     * Get the user_name of message.
     *
     * @return string The user name of message owner.
     */
    public function getUserName(): string;

    /**
     * Get the chat_id of message.
     *
     * @return int The chat id that message is linked.
     */
    public function getChatId(): int;

    /**
     * Get the text of message.
     *
     * @return string|NULL The text entered by user owner.
     */
    public function getText(): ?string;

    /**
     * Get create date of message.
     *
     * @return int The date of create of message.
     */
    public function getCreatedAt(): int;
}
