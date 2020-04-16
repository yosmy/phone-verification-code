<?php

namespace Yosmy\Phone\Verification;

use Yosmy\Phone\Verification\Code\ExpiredValueException;

/**
 * @di\service()
 */
class AssertCode
{
    /**
     * @var GatherCode
     */
    private $pickCode;

    /**
     * @var IsCodeExpired
     */
    private $isCodeExpired;

    /**
     * @param GatherCode    $pickCode
     * @param IsCodeExpired $isCodeExpired
     */
    public function __construct(
        GatherCode $pickCode,
        IsCodeExpired $isCodeExpired
    ) {
        $this->pickCode = $pickCode;
        $this->isCodeExpired = $isCodeExpired;
    }

    /**
     * @param string $country
     * @param string $prefix
     * @param string $number
     * @param string $value
     *
     * @return bool
     *
     * @throws ExpiredValueException
     */
    public function assert(
        string $country,
        string $prefix,
        string $number,
        string $value
    ): bool {
        $code = $this->pickCode->gather(
            $country,
            $prefix,
            $number
        );

        if ($this->isCodeExpired->is($code)) {
            throw new ExpiredValueException($value);
        }

        return $code->getValue() == $value;
    }
}