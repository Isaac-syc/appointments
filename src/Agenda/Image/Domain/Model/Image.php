<?php

namespace Src\Agenda\Image\Domain\Model;

use Src\Common\Domain\AggregateRoot;

class Image extends AggregateRoot implements \JsonSerializable
{
    public function __construct(
        // TODO Add properties
    )
    {}

    public function toArray(): array
    {
        return [
            // TODO Add properties
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}