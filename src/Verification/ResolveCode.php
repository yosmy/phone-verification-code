<?php

namespace Yosmy\Phone\Verification;

/**
 * @di\service()
 */
class ResolveCode
{
    /**
     * @var GatherCode
     */
    private $gatherCode;

    /**
     * @var AddCode
     */
    private $addCode;

    /**
     * @var DeleteCode
     */
    private $deleteCode;

    /**
     * @var IsCodeExpired
     */
    private $isCodeExpired;

    /**
     * @param GatherCode    $gatherCode
     * @param AddCode       $addCode
     * @param DeleteCode    $deleteCode
     * @param IsCodeExpired $isCodeExpired
     */
    public function __construct(
        GatherCode $gatherCode,
        AddCode $addCode,
        DeleteCode $deleteCode,
        IsCodeExpired $isCodeExpired
    ) {
        $this->gatherCode = $gatherCode;
        $this->addCode = $addCode;
        $this->deleteCode = $deleteCode;
        $this->isCodeExpired = $isCodeExpired;
    }

    /**
     * @param string $country
     * @param string $prefix
     * @param string $number
     *
     * @return Code
     */
    public function resolve(
        string $country,
        string $prefix,
        string $number
    ): Code {
        $code = $this->gatherCode->gather(
            $country,
            $prefix,
            $number
        );

        if (!$code) {
            return $this->addCode->add(
                $country,
                $prefix,
                $number
            );
        }

        if ($this->isCodeExpired->is($code)) {
            $this->deleteCode->delete(
                $country,
                $prefix,
                $number
            );

            return $this->resolve(
                $country,
                $prefix,
                $number
            );
        }

        return $code;
    }
}