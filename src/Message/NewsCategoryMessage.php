<?php
declare(strict_types=1);

namespace App\Message;

readonly class NewsCategoryMessage implements AsyncMessageInterface
{
    private string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}
