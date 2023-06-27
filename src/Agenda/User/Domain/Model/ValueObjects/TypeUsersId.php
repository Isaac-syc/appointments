<?php

declare(strict_types=1);

namespace Src\Agenda\User\Domain\Model\ValueObjects;

use Src\Common\Domain\Exceptions\RequiredException;
use Src\Common\Domain\ValueObject;

final class TypeUsersId extends ValueObject
{
    private string $type_users_id;

    public function __construct(?string $type_users_id)
    {

        if (!$type_users_id) {
            throw new RequiredException('type_users_id');
        }

        $this->type_users_id = $type_users_id;
    }

    public function __toString(): string
    {
        return $this->type_users_id;
    }

    public function jsonSerialize(): string
    {
        return $this->type_users_id;
    }
}
