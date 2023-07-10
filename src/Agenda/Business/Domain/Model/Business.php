<?php

namespace Src\Agenda\Business\Domain\Model;

use Src\Agenda\Business\Domain\Model\ValueObjects\Address;
use Src\Agenda\Business\Domain\Model\ValueObjects\City;
use Src\Agenda\Business\Domain\Model\ValueObjects\Email;
use Src\Agenda\Business\Domain\Model\ValueObjects\GoogleMapsUrl;
use Src\Agenda\Business\Domain\Model\ValueObjects\Name;
use Src\Agenda\Business\Domain\Model\ValueObjects\Neighborhood;
use Src\Agenda\Business\Domain\Model\ValueObjects\PhoneNumber;
use Src\Agenda\Business\Domain\Model\ValueObjects\Photo;
use Src\Agenda\Business\Domain\Model\ValueObjects\StateId;
use Src\Agenda\Business\Domain\Model\ValueObjects\Street1;
use Src\Agenda\Business\Domain\Model\ValueObjects\Street2;
use Src\Common\Domain\AggregateRoot;

class Business extends AggregateRoot implements \JsonSerializable
{
    public function __construct(
        public readonly ?int $id,
        public readonly Name $name,
        public readonly PhoneNumber $phoneNumber,
        public readonly Address $address,
        public readonly Email $email,
        public readonly GoogleMapsUrl $googleMapsUrl,
        public readonly City $city,
        public readonly ?int $stateId,
        public readonly Neighborhood $neighborhood,
        public readonly Street1 $street1,
        public readonly Street2 $street2,
        public readonly Photo $photo,
        public readonly bool $isActive,
        public readonly ?int $userId
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'email' => $this->email,
            'googleMapsUrl' => $this->googleMapsUrl,
            'city' => $this->city,
            'stateId' => $this->stateId,
            'neighborhood' => $this->neighborhood,
            'street1' => $this->street1,
            'street2' => $this->street2,
            'photo' => $this->photo,
            'isActive' => $this->isActive,

        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
