<?php

namespace App\Models;

/**
 * Class Message.
 *
 * @package App\Models
 */
class Message implements MessageInterface
{
    /**
     * The unique identifier of message.
     *
     * @var int
     */
    protected $id;

    /**
     * The text of message.
     *
     * @var string
     */
    protected $text;

    /**
     * The message owner user id.
     *
     * @var int
     */
    protected $user_id;

    /**
     * The message chat id that this message was written.
     *
     * @var int
     */
    protected $chat_id;

    /**
     * The date (UTC) of creation of message.
     *
     * @var int
     */
    protected $created_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setUserId(User $user): void
    {
        $this->user_id = $user->getId();
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getUserName(): string
    {
        $userRepo = new UserRepository();
        $user = $userRepo->findById($this->getUserId());
        // @TODO Try / catch throw si null...

        return $user->getName();
    }

    public function setChatId($chatId): void
    {
        $this->chat_id = $chatId;
    }

    public function getChatId(): int
    {
        return $this->chat_id;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    public function setCreatedAt($timestamp): void
    {
        $this->created_at = $timestamp;
    }
}
