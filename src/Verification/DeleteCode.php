<?php

namespace Yosmy\Phone\Verification;

/**
 * @di\service({
 *     private: true
 * })
 */
class DeleteCode
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
     */
    public function delete(
        string $country,
        string $prefix,
        string $number
    ) {
        $this->manageCollection->deleteOne(
            [
                'country' => $country,
                'prefix' => $prefix,
                'number' => $number,
            ]
        );
    }
}