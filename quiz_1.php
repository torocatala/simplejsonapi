<?php
function permute(array $nums, int $start, array &$results) {
    if ($start === count($nums) - 1) {
        $results[] = $nums;
        return;
    }

    $seen = [];
    for ($i = $start; $i < count($nums); $i++) {
        if (in_array($nums[$i], $seen)) continue; // Skip duplicates
        $seen[] = $nums[$i];

        // Swap elements at indices $start and $i
        list($nums[$start], $nums[$i]) = array($nums[$i], $nums[$start]);

        // Generate all permutations for the next elements
        permute($nums, $start + 1, $results);

        // Swap back
        list($nums[$start], $nums[$i]) = array($nums[$i], $nums[$start]);
    }
}

function generatePermutations(array $array) {
    $results = [];
    permute($array, 0, $results);
    return $results;
}

// Example usage
$perms = generatePermutations([1, 1, 2]);
print_r($perms);
