<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class PhoneNumber extends ValueObject
{
    private string $phoneNumber;

    public function __construct(?string $phoneNumber)
    {

        if (!$phoneNumber) {
            throw new RequiredException('phoneNumber');
        }

        $this->phoneNumber = $phoneNumber;
    }

    public function __toString(): string
    {
        return $this->phoneNumber;
    }

    public function jsonSerialize(): string
    {
        return $this->phoneNumber;
    }
}
