<?php

namespace App\Models; // Declares the model namespace.

class RentalRecord // Represents one rental record for a renter and vehicle.
{
    private string $renterName; // Stores the renter's name.
    private Vehicle $vehicle; // Stores the rented vehicle object.
    private int $days; // Stores the number of rental days.

    public function __construct(string $renterName, Vehicle $vehicle, int $days) // Initializes the rental details.
    {
        $this->renterName = $renterName; // Assigns the renter name.
        $this->vehicle     = $vehicle; // Assigns the vehicle object.
        $this->days        = $days; // Assigns the rental duration in days.
    }

    /**
     * Core business logic: builds a readable receipt string,
     * pulling the cost calculation from the related Vehicle object.
     */
    public function generateReceipt(): string // Builds the receipt text for this rental.
    {
        $cost = $this->vehicle->computeRentalCost($this->days); // Calculates the total rental cost.

        return sprintf( // Formats the receipt string.
            "Renter: %s | Vehicle: %s (%s) | Days: %d | Total Cost: PHP %.2f", // Receipt format template.
            $this->renterName, // Inserts the renter's name.
            $this->vehicle->getModel(), // Inserts the vehicle model.
            $this->vehicle->getPlateNumber(), // Inserts the vehicle plate number.
            $this->days, // Inserts the number of rental days.
            $cost // Inserts the total cost.
        );
    }

    public function getRenterName(): string // Returns the renter's name.
    {
        return $this->renterName; // Returns the stored renter name.
    }

    public function getDays(): int // Returns the number of rental days.
    {
        return $this->days; // Returns the stored number of days.
    }
}
