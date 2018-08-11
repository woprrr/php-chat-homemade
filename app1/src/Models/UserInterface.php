<?php

namespace App\Models;

/**
 * Interface UserInterface.
 *
 * @package App\Models
 */
interface UserInterface
{

  /**
   * Get the id of user.
   *
   * @return int The unique dentifier of user.
   */
    public function getId(): int;

    /**
     * Get the id of user.
     *
     * @return int The public name of user.
     */
    public function getName(): string;

    /**
     * Get the password of user.
     *
     * @return string The hashed password of user.
     */
    public function getPassword(): string;
}
