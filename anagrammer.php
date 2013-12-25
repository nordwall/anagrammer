<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ethan
 * Date: 12/22/13
 * Time: 11:57 AM
 * To change this template use File | Settings | File Templates.
 */
// Track the start time in order ot measure the total time the script takes to run.
$startTime = microtime(true);

$states = array(
    'Alabama',
    'Alaska',
    'Arizona',
    'Arkansas',
    'California',
    'Colorado',
    'Connecticut',
    'Delaware',
    'District of Columbia',
    'Florida',
    'Georgia',
    'Hawaii',
    'Idaho',
    'Illinois',
    'Indiana',
    'Iowa',
    'Kansas',
    'Kentucky',
    'Louisiana',
    'Maine',
    'Maryland',
    'Massachusetts',
    'Michigan',
    'Minnesota',
    'Mississippi',
    'Missouri',
    'Montana',
    'Nebraska',
    'Nevada',
    'New Hampshire',
    'New Jersey',
    'New Mexico',
    'New York',
    'North Carolina',
    'North Dakota',
    'Ohio',
    'Oklahoma',
    'Oregon',
    'Pennsylvania',
    'Rhode Island',
    'South Carolina',
    'South Dakota',
    'Tennessee',
    'Texas',
    'Utah',
    'Vermont',
    'Virginia',
    'Washington',
    'West Virginia',
    'Wisconsin',
    'Wyoming',
);

$stateCombos = array();

$t = 0;

for ($n = 0; $n < count($states); $n++) {

    for ($k = $n+1; $k < count($states); $k++) {

        $stateCombos[$t]['firstState'] = $states[$n];
        $stateCombos[$t]['secondState'] = $states[$k];
        $stateCombos[$t]['combined'] = $stateCombos[$t]['firstState'].$stateCombos[$t]['secondState'];

        // Strip whitespace from the combined state list.
        // Total Time: 0.0026028156280518
        $stateCombos[$t]['combined'] = str_replace(' ', '', $stateCombos[$t]['combined']);

        // Convert to lowercase.
        // Total Time: 0.002979040145874
        $stateCombos[$t]['combined'] = strtolower($stateCombos[$t]['combined']);

        // Sort string alphabetically. 1.) split into array.  2.) sort array.  3.) implode back into array.
        // Total Time: 0.0092809200286865
        $stringArray = str_split($stateCombos[$t]['combined']);
        sort($stringArray);
        $stateCombos[$t]['combined'] = implode('', $stringArray);

        $t++;
    }

}

// Works but not efficient.  Look at total time and iterations.
// Total Time: 0.35741496086121
// Total Comparison Iterations: 812175

$iterations = 0;

for ($n = 0; $n < count($stateCombos); $n++) {

    for ($k = $n+1; $k < count($stateCombos); $k++) {

        if (strcmp($stateCombos[$n]['combined'], $stateCombos[$k]['combined']) == 0) {
            print $stateCombos[$n]['firstState']." and ".$stateCombos[$n]['secondState']." are anagrams of: ".
                $stateCombos[$k]['firstState']." and ".$stateCombos[$k]['secondState'];
        }

        $iterations++;
    }
}

$endTime = microtime(true);

$elapsedTime = $endTime-$startTime;

print "\n\nTotal Time: {$elapsedTime}\nTotal Comparison Iterations: {$iterations}\n";
