<?php

require __DIR__ . '/vendor/autoload.php';

use App\Models\Vehicle;
use App\Models\RentalRecord;

// Create Vehicle objects
$vehicle1 = new Vehicle('ABC-1234', 'Toyota Vios', 1500.00);
$vehicle2 = new Vehicle('XYZ-5678', 'Honda Click 125i', 500.00);

echo "================================================\n";
echo "           VEHICLE RENTAL TRACKER              \n";
echo "================================================\n\n";

// Check availability via the Rentable interface
echo ">>>          AVAILABILITY CHECK              <<<\n";
echo "------------------------------------------------\n";
echo str_pad($vehicle1->getModel(), 20) . " | Available: " . ($vehicle1->isAvailable() ? "Yes" : "No") . "\n";
echo str_pad($vehicle2->getModel(), 20) . " | Available: " . ($vehicle2->isAvailable() ? "Yes" : "No") . "\n";
echo "------------------------------------------------\n\n";

// Create RentalRecord objects and generate receipts
$rental1 = new RentalRecord('Froilyn Alvarado', $vehicle1, 3);
$rental2 = new RentalRecord('Alaiza Caranto', $vehicle2, 10); // 10 days triggers the discount

$vehicle1->markAsRented();
$vehicle2->markAsRented();

echo ">>>               RECEIPTS                   <<<\n";
echo "------------------------------------------------\n";
echo $rental1->generateReceipt() . "\n";
echo "- - - - - - - - - - - - - - - - - - - - - - - -\n";
echo $rental2->generateReceipt() . "\n";
echo "------------------------------------------------\n\n";

// Show availability again after renting out
echo ">>>         UPDATED AVAILABILITY             <<<\n";
echo "------------------------------------------------\n";
echo str_pad($vehicle1->getModel(), 20) . " | Available: " . ($vehicle1->isAvailable() ? "Yes" : "No") . "\n";
echo str_pad($vehicle2->getModel(), 20) . " | Available: " . ($vehicle2->isAvailable() ? "Yes" : "No") . "\n";
echo "================================================\n";