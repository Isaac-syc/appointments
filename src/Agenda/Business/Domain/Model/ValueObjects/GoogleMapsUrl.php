<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class GoogleMapsUrl extends ValueObject
{
    private string $googleMapsUrl;

    public function __construct(?string $googleMapsUrl)
    {

        if (!$googleMapsUrl) {
            throw new RequiredException('googleMapsUrl');
        }

        $this->googleMapsUrl = $googleMapsUrl;
    }

    public function __toString(): string
    {
        return $this->googleMapsUrl;
    }

    public function jsonSerialize(): string
    {
        return $this->googleMapsUrl;
    }
}
