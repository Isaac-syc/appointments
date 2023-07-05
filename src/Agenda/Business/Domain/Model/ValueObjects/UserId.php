<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class UserId extends ValueObject
{
    private int $userId;

    public function __construct(?int $userId)
    {

        if (!$userId) {
            throw new RequiredException('userId');
        }

        $this->userId = $userId;
    }

    public function __toInteger(): int
    {
        return $this->userId;
    }

    public function jsonSerialize(): int
    {
        return $this->userId;
    }
}
