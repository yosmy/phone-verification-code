<?php

namespace Yosmy\Phone\Verification\Code;

use Exception;
use JsonSerializable;

class ExpiredValueException extends Exception implements JsonSerializable
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;

        parent::__construct();
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'value' => $this->value
        ];
    }
}