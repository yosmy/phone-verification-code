<?php

namespace Yosmy\Phone\Verification;

use Yosmy\GenerateId;
use Yosmy\Mongo;
use Yosmy\ResolveTime;

/**
 * @di\service({
 *     private: true
 * })
 */
class AddCode
{
    /**
     * @var GenerateId
     */
    private $generateId;

    /**
     * @var ResolveTime
     */
    private $resolveTime;

    /**
     * @var Code\GenerateValue
     */
    private $generateCode;

    /**
     * @var ManageCodeCollection
     */
    private $manageCollection;

    /**
     * @param GenerateId           $generateId
     * @param ResolveTime          $resolveTime
     * @param Code\GenerateValue   $generateCode
     * @param ManageCodeCollection $manageCollection
     */
    public function __construct(
        GenerateId $generateId,
        ResolveTime $resolveTime,
        Code\GenerateValue $generateCode,
        ManageCodeCollection $manageCollection
    ) {
        $this->generateId = $generateId;
        $this->resolveTime = $resolveTime;
        $this->generateCode = $generateCode;
        $this->manageCollection = $manageCollection;
    }

    /**
     * @param string $country
     * @param string $prefix
     * @param string $number
     *
     * @return Code
     */
    public function add(
        string $country,
        string $prefix,
        string $number
    ) {
        $value = $this->generateCode->generate(6);

        $id = $this->generateId->generate();

        $this->manageCollection->insertOne([
            '_id' => uniqid(),
            'country' => $country,
            'prefix' => $prefix,
            'number' => $number,
            'value' => $value,
            'date' => new Mongo\DateTime($this->resolveTime->resolve() * 1000)
        ]);

        return new BaseCode([
            'id' => $id,
            'country' => $country,
            'prefix' => $prefix,
            'number' => $number,
            'value' => $value,
        ]);
    }
}