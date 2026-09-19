<?php

namespace App\Models;

class RentalRecord
{
    private string $renterName;
    private Vehicle $vehicle;
    private int $days;

    public function __construct(string $renterName, Vehicle $vehicle, int $days)
    {
        $this->renterName = $renterName;
        $this->vehicle     = $vehicle;
        $this->days        = $days;
    }

    /**
     * Core business logic: builds a readable receipt string,
     * pulling the cost calculation from the related Vehicle object.
     */
    public function generateReceipt(): string
    {
        $cost = $this->vehicle->computeRentalCost($this->days);

        return sprintf(
            "Renter: %s | Vehicle: %s (%s) | Days: %d | Total Cost: PHP %.2f",
            $this->renterName,
            $this->vehicle->getModel(),
            $this->vehicle->getPlateNumber(),
            $this->days,
            $cost
        );
    }

    public function getRenterName(): string
    {
        return $this->renterName;
    }

    public function getDays(): int
    {
        return $this->days;
    }
}
