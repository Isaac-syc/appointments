<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class Photo extends ValueObject
{
    private string $photo;

    public function __construct(?string $photo)
    {

        if (!$photo) {
            throw new RequiredException('photo');
        }

        $this->photo = $photo;
    }

    public function __toString(): string
    {
        return $this->photo;
    }

    public function jsonSerialize(): string
    {
        return $this->photo;
    }
}
