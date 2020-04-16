<?php

namespace Yosmy\Phone\Verification;

/**
 * @di\service({
 *     private: true
 * })
 */
class GatherCode
{
    /**
     * @var ManageCodeCollection
     */
    private $manageCollection;

    /**
     * @param ManageCodeCollection $manageCollection
     */
    public function __construct(ManageCodeCollection $manageCollection)
    {
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string $country
     * @param string $prefix
     * @param string $number
     *
     * @return Code
     */
    public function gather(
        string $country,
        string $prefix,
        string $number
    ): ?Code {
        /** @var Code $code */
        $code = $this->manageCollection->findOne(
            [
                'country' => $country,
                'prefix' => $prefix,
                'number' => $number,
            ]
        );

        return $code;
    }
}