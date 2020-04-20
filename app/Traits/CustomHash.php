<?php

namespace App\Traits;

trait CustomHash
{
    /**
     * Hash a value using SHA-256
     */
    public function hash($data)
    {
        return hash('sha256', $data);
    }
}
