<?php
// Function to generate a unique random number
function generateUniqueRandomNumber($min, $max) {
    $numbers = range($min, $max);
    shuffle($numbers);
    shuffle($numbers);
    shuffle($numbers);
    return reset($numbers); // Get the first element from the shuffled array
}

// Set the range
$minNumber = 1;
$maxNumber = 999999;

// Generate a unique random number
$uniqueRandomNumber = generateUniqueRandomNumber($minNumber, $maxNumber);

// Output the unique random number
echo $uniqueRandomNumber;
?>
