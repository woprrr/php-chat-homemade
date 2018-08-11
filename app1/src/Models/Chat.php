<?php

namespace App\Models;

class Chat implements ChatInterface
{
    /**
     * The unique identifier of chat.
     *
     * @var int
     */
    protected $id;

    /**
     * The type of chat (public or private).
     *
     * @var int
     */
    protected $type;

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set type of this Chat.
     *
     * @param string $chatTypeName The type name of this chat (public or private).
     */
    public function setType(string $chatTypeName): void
    {
        $this->type = $chatTypeName;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return $this->type;
    }
}
