<?php

namespace App\Models;

use App\Database;
use PDO;

/**
 * Class UserRepository.
 *
 * @package App\Models
 */
final class UserRepository implements UserRepositoryInterface
{
    /**
     * The unique instance of Database.
     *
     * @var \PDO
     */
    private $db;

    /**
     * UserRepository class constructor.
     */
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
        $user = null;
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            $user = $stmt->fetch();
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByName(string $name): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name = :user_name LIMIT 1");
        $stmt->bindParam(':user_name', $name, PDO::PARAM_STR);
        $user = null;
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            $user = $stmt->fetch();
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function findAllUsers(): ?array
    {
        $stmt = $this->db->prepare("SELECT id, name FROM users u");
        $users = null;
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            $users = $stmt->fetchAll();
        }

        return $users;
    }

    /**
     * {@inheritdoc}
     */
    public function findPrivateChatUsers(int $chatId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM user_chats us WHERE us.chat_id = :chat_id");
        $stmt->bindParam(':chat_id', $chatId, PDO::PARAM_INT);
        $users = null;
        if ($stmt->execute()) {
            $users = $stmt->fetchAll();
            if (!empty($users)) {
                // @TODO No time to use PDO fetch mode with,
                // specific object userChats I make it manually :(.
                $userRepo = new UserRepository();
                $user1 = $userRepo->findById($users[0]['user_chat_id']);
                $user2 = $userRepo->findById($users[0]['user2_chat_id']);
                return [$user1, $user2];
            }
        }

        return $users;
    }

    /**
     * {@inheritdoc}
     */
    public function save(User $user): void
    {
        $stmt = $this->db->prepare('INSERT INTO users ("name", "password") VALUES (:name, :password)');
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(User $user): void
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :user_id');
        $stmt->bindParam(':user_id', $user->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
}
