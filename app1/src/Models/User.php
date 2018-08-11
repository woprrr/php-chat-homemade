<?php

namespace App\Models;

/**
 * Class User.
 *
 * @package App\Models
 */
class User implements UserInterface
{
    /**
     * The unique identifier of user.
     *
     * @var int
     */
    protected $id;

    /**
     * The name of user.
     *
     * @var string
     */
    protected $name;

    /**
     * The hashed password of user.
     *
     * @var string
     */
    private $password;

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
}
