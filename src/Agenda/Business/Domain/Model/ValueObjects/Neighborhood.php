<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class Neighborhood extends ValueObject
{
    private string $neighborhood;

    public function __construct(?string $neighborhood)
    {

        if (!$neighborhood) {
            throw new RequiredException('neighborhood');
        }

        $this->neighborhood = $neighborhood;
    }

    public function __toString(): string
    {
        return $this->neighborhood;
    }

    public function jsonSerialize(): string
    {
        return $this->neighborhood;
    }
}
