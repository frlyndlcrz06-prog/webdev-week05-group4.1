<?php

namespace App\Models;

use App\Interfaces\Rentable;

class Vehicle implements Rentable
{
    private string $plateNumber;
    private string $model;
    private float $dailyRate;
    private bool $rentedOut;

    public function __construct(string $plateNumber, string $model, float $dailyRate)
    {
        $this->plateNumber = $plateNumber;
        $this->model       = $model;
        $this->dailyRate   = $dailyRate;
        $this->rentedOut   = false;
    }

    /**
     * Required by the Rentable interface.
     */
    public function isAvailable(): bool
    {
        return !$this->rentedOut;
    }

    /**
     * Marks this vehicle as currently rented out.
     */
    public function markAsRented(): void
    {
        $this->rentedOut = true;
    }

    /**
     * Frees up the vehicle again once returned.
     */
    public function markAsReturned(): void
    {
        $this->rentedOut = false;
    }

    /**
     * Core business logic: computes total rental cost for a number of days,
     * applying a 10% discount for long-term rentals (7+ days).
     */
    public function computeRentalCost(int $days): float
    {
        $total = $this->dailyRate * $days;

        if ($days >= 7) {
            $total *= 0.90; // 10% discount for week-long+ rentals
        }

        return round($total, 2);
    }

    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getDailyRate(): float
    {
        return $this->dailyRate;
    }
}
