<?php

declare(strict_types=1);

namespace App\Actions\Chat\DTO;

final class ManageChatDTO
{
    /**
     * @var int|null
     */
    private ?int $chatId = null;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var array
     */
    private array $usersIds = [];

    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getUsersIds(): array
    {
        return $this->usersIds;
    }

    /**
     * @param array $usersIds
     */
    public function setUsersIds(array $usersIds): void
    {
        $this->usersIds = $usersIds;
    }

    /**
     * @return int|null
     */
    public function getChatId(): ?int
    {
        return $this->chatId;
    }

    /**
     * @param int|null $chatId
     */
    public function setChatId(?int $chatId): void
    {
        $this->chatId = $chatId;
    }
    
}
