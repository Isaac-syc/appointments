<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class Street2 extends ValueObject
{
    private string $street2;

    public function __construct(?string $street2)
    {

        if (!$street2) {
            throw new RequiredException('street2');
        }

        $this->street2 = $street2;
    }

    public function __toString(): string
    {
        return $this->street2;
    }

    public function jsonSerialize(): string
    {
        return $this->street2;
    }
}
