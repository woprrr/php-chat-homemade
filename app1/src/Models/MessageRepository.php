<?php

namespace App\Models;

use App\Database;
use PDO;

/**
 * Class MessageRepository.
 *
 * @package App\Models
 */
final class MessageRepository implements MessageRepositoryInterface
{
  /**
   * The unique instance of Database.
   *
   * @var \PDO
   */
  private $db;

  /**
   * MessageRepository class constructor.
   */
  public function __construct()
  {
    $this->db = Database::getInstance();
  }

  /**
   * {@inheritdoc}
   */
  public function findMessagesById(int $messageId): ?Message
  {
    $stmt = $this->db->prepare("SELECT * FROM messages WHERE id = :message_id ORDER BY m.created_at");
    $stmt->bindParam(':message_id', $messageId, PDO::PARAM_INT);
    $message = NULL;
    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_CLASS, Message::class);
      $message = $stmt->fetch();
    }

    return $message;
  }

  /**
   * Find Messages with given specifications.
   *
   * @param string $type  The type of chat containing the messages.
   * @param int $userId   The user id of first where clause case.
   * @param int $chatId   The chat id of second where clause case.
   *
   * @return array|null   An array contain the messages or null.
   */
  public function findMessages(string $type, int $userId, int $chatId): ?array
  {

    if (!empty($userId)) {
      $sqlWhereClause = "AND m.user_id = :id";
      $id = $userId;
    }
    else {
      $sqlWhereClause = "AND m.chat_id = :id";
      $id = $chatId;
    }

    $stmt = $this->db->prepare("SELECT m.* FROM messages m LEFT JOIN chats c ON c.id = m.chat_id WHERE c.type = :type " . $sqlWhereClause ." ORDER BY m.created_at");
    $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $message = NULL;
    if ($stmt->execute()) {
      $stmt->setFetchMode(PDO::FETCH_CLASS, Message::class);
      $message = $stmt->fetchAll();
    }

    return $message;
  }

  /**
   * {@inheritdoc}
   */
  public function findMessagesByUser(User $user): ?array
  {
    return $this->findMessages(ChatInterface::PUBLIC, $user->getId(), 0);
  }

  /**
   * {@inheritdoc}
   */
  public function findPublicChatMessages(int $chatId = 1): ?array
  {
    return $this->findMessages(ChatInterface::PUBLIC, 0, $chatId);
  }

  /**
   * {@inheritdoc}
   */
  public function findPrivateChatMessages(int $chatId = 1): ?array
  {
    return $this->findMessages(ChatInterface::PRIVATE, 0, $chatId);
  }

  /**
   * {@inheritdoc}
   */
  public function save(Message $message): void
  {
    $stmt = $this->db->prepare('INSERT INTO "messages" ("user_id", "chat_id", "text") VALUES (:user_id, :chat_id, :text)');
    $stmt->bindParam(':user_id', $message->getUserId(), PDO::PARAM_INT);
    $stmt->bindParam(':chat_id', $message->getChatId(), PDO::PARAM_INT);
    $stmt->bindParam(':text', $message->getText(), PDO::PARAM_STR);
    $stmt->execute();
  }

  /**
   * {@inheritdoc}
   */
  public function delete(Message $message): void
  {
    $stmt = $this->db->prepare('DELETE FROM "messages" WHERE id = :message_id');
    $stmt->bindParam(':message_id', $message->getId(), PDO::PARAM_INT);
    $stmt->execute();
  }

}
