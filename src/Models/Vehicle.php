<?php

namespace App\Models; // Declares the vehicle model namespace.

use App\Interfaces\Rentable; // Imports the rental interface.

class Vehicle implements Rentable // Represents a vehicle that can be rented.
{
    private string $plateNumber; // Stores the vehicle plate number.
    private string $model; // Stores the vehicle model name.
    private float $dailyRate; // Stores the daily rental rate.
    private bool $rentedOut; // Tracks whether the vehicle is currently rented.

    public function __construct(string $plateNumber, string $model, float $dailyRate) // Initializes the vehicle data.
    {
        $this->plateNumber = $plateNumber; // Assigns the plate number.
        $this->model       = $model; // Assigns the model name.
        $this->dailyRate   = $dailyRate; // Assigns the daily rental rate.
        $this->rentedOut   = false; // Starts the vehicle as available.
    }

    /**
     * Required by the Rentable interface.
     */
    public function isAvailable(): bool // Checks whether the vehicle can be rented.
    {
        return !$this->rentedOut; // Returns true if the vehicle is not rented.
    }

    /**
     * Marks this vehicle as currently rented out.
     */
    public function markAsRented(): void // Marks the vehicle as unavailable.
    {
        $this->rentedOut = true; // Sets the rented status to true.
    }

    /**
     * Frees up the vehicle again once returned.
     */
    public function markAsReturned(): void // Marks the vehicle as available again.
    {
        $this->rentedOut = false; // Sets the rented status to false.
    }

    /**
     * Core business logic: computes total rental cost for a number of days,
     * applying a 10% discount for long-term rentals (7+ days).
     */
    public function computeRentalCost(int $days): float // Calculates total cost for the rental period.
    {
        $total = $this->dailyRate * $days; // Multiplies the daily rate by the number of days.

        if ($days >= 7) { // Applies a discount for rentals of 7 days or more.
            $total *= 0.90; // Reduces the total by 10%.
        }

        return round($total, 2); // Rounds the total to two decimal places.
    }

    public function getPlateNumber(): string // Returns the vehicle plate number.
    {
        return $this->plateNumber; // Returns the stored plate number.
    }

    public function getModel(): string // Returns the vehicle model.
    {
        return $this->model; // Returns the stored model name.
    }

    public function getDailyRate(): float // Returns the daily rental rate.
    {
        return $this->dailyRate; // Returns the stored daily rate.
    }
}
