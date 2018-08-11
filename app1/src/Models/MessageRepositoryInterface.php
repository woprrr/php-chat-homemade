<?php

namespace App\Models;

/**
 * Interface MessageRepositoryInterface.
 *
 * @package App\Models
 */
interface MessageRepositoryInterface
{

  /**
   * Find user by unique identifier.
   *
   * @param int $userId The Id of user to found.
   *
   * @return User|null  The user found for given Id.
   */
    public function findMessagesById(int $messageId): ?Message;

    /**
     * Find uer by name field.
     *
     * @param string $name The name of user.
     *
     * @return User|null   The user found by given name.
     */
    public function findMessagesByUser(User $user): ?array;

    /**
     * Find uer by name field.
     *
     * @param string $name The name of user.
     *
     * @return User|null   The user found by given name.
     */
    public function findPrivateChatMessages(int $chatId = 1): ?array;

    /**
     * Find uer by name field.
     *
     * @param string $name The name of user.
     *
     * @return User|null   The user found by given name.
     */
    public function findPublicChatMessages(int $chatId = 1): ?array;

    /**
     * Save/Add given user from database.
     *
     * @param Movie $movie The user to add.
     */
    public function save(Message $message): void;

    /**
     * Delete given user from database.
     *
     * @param User $user The user to delete.
     */
    public function delete(Message $message): void;
}
