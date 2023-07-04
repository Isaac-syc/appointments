<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class City extends ValueObject
{
    private string $city;

    public function __construct(?string $city)
    {

        if (!$city) {
            throw new RequiredException('city');
        }

        $this->city = $city;
    }

    public function __toString(): string
    {
        return $this->city;
    }

    public function jsonSerialize(): string
    {
        return $this->city;
    }
}
