<?php

declare(strict_types=1);

namespace App\Actions\Chat\DTO;

/**
 * Data Transfer Object to transfer data to the Service Layer Command
 */
final class SearchUsersDTO
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @var array
     */
    private array $except = [];

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getExcept(): array
    {
        return $this->except;
    }

    /**
     * @param array $except
     */
    public function setExcept(array $except): void
    {
        $this->except = $except;
    }

}
