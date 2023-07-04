<?php

declare(strict_types=1);

namespace Src\Agenda\Business\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class StateId extends ValueObject
{
    private int $stateId;

    public function __construct(?int $stateId)
    {

        if (!$stateId) {
            throw new RequiredException('stateId');
        }

        $this->stateId = $stateId;
    }

    public function __toInteger(): int
    {
        return $this->stateId;
    }

    public function jsonSerialize(): int
    {
        return $this->stateId;
    }
}
