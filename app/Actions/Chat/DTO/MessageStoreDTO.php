<?php

declare(strict_types=1);

namespace App\Actions\Chat\DTO;

final class MessageStoreDTO
{
    /**
     * @var int
     */
    private int $chatId;

    /**
     * @var int
     */
    private int $userId;

    /**
     * @var string
     */
    private string $text;

    /**
     * @var int|null
     */
    private ?int $fileId = null;

    /**
     * @param int $chatId
     * @param int $userId
     * @param string $text
     */
    public function __construct(int $chatId, int $userId, string $text)
    {
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getChatId(): int
    {
        return $this->chatId;
    }

    /**
     * @param int $chatId
     */
    public function setChatId(int $chatId): void
    {
        $this->chatId = $chatId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return int|null
     */
    public function getFileId(): ?int
    {
        return $this->fileId;
    }

    /**
     * @param int|null $fileId
     */
    public function setFileId(?int $fileId): void
    {
        $this->fileId = $fileId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

}
