<?php

namespace Yosmy\Phone\Verification;

use Yosmy\Mongo;

class BaseCode extends Mongo\Document implements Code
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->offsetGet('_id');
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->offsetGet('country');
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->offsetGet('prefix');
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->offsetGet('number');
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->offsetGet('value');
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->offsetGet('date');
    }

    /**
     * {@inheritdoc}
     */
    public function bsonUnserialize(array $data)
    {
        /** @var Mongo\DateTime $date */
        $date = $data['date'];
        $data['date'] = $date->toDateTime()->getTimestamp();

        parent::bsonUnserialize($data);
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): object
    {
        $data = parent::jsonSerialize();

        $data->id = $data->_id;

        unset($data->_id);

        return $data;
    }
}