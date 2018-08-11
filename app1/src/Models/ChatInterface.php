<?php

namespace App\Models;

/**
 * Interface ChatInterface.
 *
 * @package App\Models
 */
interface ChatInterface
{
  const PUBLIC = 'public';

  const PRIVATE = 'private';

  const DEFAULT = '1';

  /**
   * Get title of movie.
   *
   * @return int The unique identifier of chat.
   */
  public function getId(): int;

  /**
   * Get title of movie.
   *
   * @return string The type of chat (public or private).
   */
  public function getType(): string;
}
