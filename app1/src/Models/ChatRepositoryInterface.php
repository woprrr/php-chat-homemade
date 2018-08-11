<?php

namespace App\Models;

/**
 * Interface ChatRepositoryInterface.
 *
 * @package App\Models
 */
interface ChatRepositoryInterface
{
    /**
     * Find user by unique identifier.
     *
     * @param int $userId The Id of user to found.
     *
     * @return User|null  The user found for given Id.
     */
    public function findChatById(int $userId): ?Chat;

    /**
     * Find uer by name field.
     *
     * @param string $name The name of user.
     *
     * @return User|null   The user found by given name.
     */
    public function findChatByType(string $type): ?Chat;

    /**
     * Find uer by name field.
     *
     * @param string $name The name of user.
     *
     * @return User|null   The user found by given name.
     */
    public function savePublicChat(): void;

    /**
     * Find uer by name field.
     *
     * @param string $name The name of user.
     *
     * @return User|null   The user found by given name.
     */
    public function savePrivateChat(): void;

    /**
     * Save/Add given user from database.
     *
     * @param Movie $movie The user to add.
     */
    public function save(string $type): void;

    /**
     * Delete given user from database.
     *
     * @param User $user The user to delete.
     */
    public function delete(Chat $chat): void;
}
