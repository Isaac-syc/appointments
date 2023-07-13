<?php

declare(strict_types=1);

namespace Src\Agenda\User\Domain\Model;

use Src\Agenda\User\Domain\Exceptions\CompanyRequiredException;
use Src\Agenda\User\Domain\Model\ValueObjects\Avatar;
use Src\Agenda\User\Domain\Model\ValueObjects\Email;
use Src\Agenda\User\Domain\Model\ValueObjects\TypeUsersId;
use Src\Agenda\User\Domain\Model\ValueObjects\LastName;
use Src\Agenda\User\Domain\Model\ValueObjects\Name;
use Src\Common\Domain\AggregateRoot;

class User extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly Name $name,
        public readonly Email $email,
        public readonly LastName $last_name,
        public readonly ?int $type_users_id,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'last_name' => $this->last_name,
            'type_users_id' => $this->type_users_id
        ];
    }
}
