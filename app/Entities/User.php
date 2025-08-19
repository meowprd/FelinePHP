<?php

namespace App\Entities;

use meowprd\FelinePHP\Entity\AbstractEntity;

class User extends AbstractEntity
{
    private string $login;
    private string $password;

    public function __construct(string $login) {
        parent::__construct();
        $this->login = $login;
    }

    public function getLogin(): string { return $this->login; }
    public function setLogin(string $login): User {
        $this->login = $login;
        $this->touch();
        return $this;
    }

    public function setPasswordWithTouch(string $password): User {
        $this->setPasswordWithoutTouch($password)->touch();
        return $this;
    }
    public function setPasswordWithoutTouch(string $password): User {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }
    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }


    public function toArray(): array
    {
        return array(
          'login' => $this->login,
          'password' => $this->password,
          'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
          'updated_at' => $this->updatedAt->format('Y-m-d H:i:s'),
        );
    }
}