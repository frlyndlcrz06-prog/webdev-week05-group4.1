<?php

namespace App\Interfaces;

// contract
/**
 * Any class that can be rented out must implement this contract.
 */
interface Rentable
{
    // check
    /**
     * Check whether the item is currently available for rent.
     *
     * @return bool
     */
    public function isAvailable(): bool;
}
