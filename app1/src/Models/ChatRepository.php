<?php

namespace App\Models;

use App\Database;
use PDO;

/**
 * Class ChatRepository.
 *
 * @package App\Models
 */
final class ChatRepository implements ChatRepositoryInterface
{
    /**
     * The unique instance of Database.
     *
     * @var \PDO
     */
    private $db;

    /**
     * ChatRepository class constructor.
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Find user by unique identifier.
     *
     * @param int $userId The Id of user to found.
     *
     * @return User|null  The user found for given Id.
     */
    public function findChatById(int $chatId): ?Chat
    {
        $stmt = $this->db->prepare("SELECT * FROM chats c WHERE c.id = :chat_id");
        $stmt->bindParam(':chat_id', $chatId, PDO::PARAM_INT);
        $chat = null;
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, Chat::class);
            $chat = $stmt->fetch();
        }

        return $chat;
    }

    /**
     * Find uer by name field.
     *
     * @param string $name The name of user.
     *
     * @return User|null   The user found by given name.
     */
    public function findChatByType(string $type): ?Chat
    {
        $stmt = $this->db->prepare("SELECT * FROM chats c WHERE c.type = :chat_type");
        $stmt->bindParam(':chat_type', $type, PDO::PARAM_STR);
        $chat = null;
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, Chat::class);
            $chat = $stmt->fetchAll();
        }

        return $chat;
    }

    /**
     * {@inheritdoc}
     */
    public function savePrivateChat(): void
    {
        $this->save(ChatInterface::PRIVATE);
    }

    /**
     * {@inheritdoc}
     */
    public function savePublicChat(): void
    {
        $this->save(ChatInterface::PUBLIC);
    }

    /**
     * {@inheritdoc}
     */
    public function save(string $type): void
    {
        $stmt = $this->db->prepare('INSERT INTO "chats" ("type") VALUES (:type)');
        $stmt->bindParam(':type', $type, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Chat $chat): void
    {
        $stmt = $this->db->prepare('DELETE FROM "chats" WHERE id = :chat_id');
        $stmt->bindParam(':chat_id', $chat->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
}
