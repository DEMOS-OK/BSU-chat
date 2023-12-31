<?php

declare(strict_types=1);

namespace App\Actions\Chat\DTO;

final class GetMessagesForChatDTO
{
    /**
     * @var int
     */
    private int $step = 0;

    /**
     * @var int|null
     */
    private ?int $chatId;

    /**
     * @param int|null $chatId
     */
    public function __construct(?int $chatId = null)
    {
        $this->chatId = $chatId;
    }

    /**
     * @return int
     */
    public function getStep(): int
    {
        return $this->step;
    }

    /**
     * @param int $step
     */
    public function setStep(int $step): void
    {
        $this->step = $step;
    }

    /**
     * @return ?int
     */
    public function getChatId(): ?int
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

}
