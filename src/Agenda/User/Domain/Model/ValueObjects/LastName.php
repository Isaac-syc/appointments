<?php

declare(strict_types=1);

namespace Src\Agenda\User\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class LastName extends ValueObject
{
    private string $last_name;

    public function __construct(?string $last_name)
    {

        if (!$last_name) {
            throw new RequiredException('last_name');
        }

        $this->last_name = $last_name;
    }

    public function __toString(): string
    {
        return $this->last_name;
    }

    public function jsonSerialize(): string
    {
        return $this->last_name;
    }
}
