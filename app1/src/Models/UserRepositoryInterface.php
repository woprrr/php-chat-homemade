<?php

namespace App\Models;

/**
 * Interface UserRepositoryInterface.
 *
 * @package App\Models
 */
interface UserRepositoryInterface {

  /**
   * Find user by unique identifier.
   *
   * @param int $userId The id of user to found.
   *
   * @return User|null  The user found for given id.
   */
  public function findById(int $userId): ?User;

  /**
   * Find user by name field.
   *
   * @param string $name The name of user.
   *
   * @return User|null   The user found by given name.
   */
  public function findOneByName(string $name): ?User;

  /**
   * Find all users from database.
   *
   * @return array|null $users An array contain all user loaded.
   */
  public function findAllUsers(): ?array;

  /**
   * Find all private chat users for given private chat id.
   *
   * @param array|null $chatId The chat id to find users.
   *
   * @return array|null $users An array contain all user loaded for given chat.
   */
  public function findPrivateChatUsers(int $chatId): ?array;

  /**
   * Save/Add given user from database.
   *
   * @param Movie $movie The user to add.
   */
  public function save(User $user): void;

  /**
   * Delete given user from database.
   *
   * @param User $user The user to delete.
   */
  public function delete(User $user): void;

}
