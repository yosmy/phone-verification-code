<?php

namespace Yosmy\Phone\Verification;

/**
 * @di\service({
 *     private: true
 * })
 */
class IsCodeExpired
{
    /**
     * @param Code $code
     *
     * @return bool
     */
    public function is(
        Code $code
    ): bool {
        // More than 1 hour ago?
        return $code->getDate() + 3600 < time();
    }
}