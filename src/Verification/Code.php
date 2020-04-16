<?php

namespace Yosmy\Phone\Verification;

interface Code
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getCountry(): string;

    /**
     * @return string
     */
    public function getPrefix(): string;

    /**
     * @return string
     */
    public function getNumber(): string;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @return int
     */
    public function getDate(): int;
}