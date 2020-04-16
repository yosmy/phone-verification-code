<?php

namespace Yosmy\Phone\Verification\Code;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

/**
 * @di\service({
 *     private: true
 * })
 */
class GenerateValue
{
    /**
     * @param int $length
     *
     * @return string
     */
    public function generate(int $length): string
    {
        $generator = new ComputerPasswordGenerator();

        $generator
            ->setLowercase(false)
            ->setUppercase(false)
            ->setSymbols(false)
            ->setLength($length);

        return $generator->generatePassword();
    }
}