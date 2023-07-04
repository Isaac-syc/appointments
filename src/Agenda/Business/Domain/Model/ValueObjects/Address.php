<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class Address extends ValueObject
{
    private string $address;

    public function __construct(?string $address)
    {

        if (!$address) {
            throw new RequiredException('address');
        }

        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->address;
    }

    public function jsonSerialize(): string
    {
        return $this->address;
    }
}
