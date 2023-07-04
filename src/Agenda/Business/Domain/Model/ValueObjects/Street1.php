<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class Street1 extends ValueObject
{
    private string $street1;

    public function __construct(?string $street1)
    {

        if (!$street1) {
            throw new RequiredException('street1');
        }

        $this->street1 = $street1;
    }

    public function __toString(): string
    {
        return $this->street1;
    }

    public function jsonSerialize(): string
    {
        return $this->street1;
    }
}
