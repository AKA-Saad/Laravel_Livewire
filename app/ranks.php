<?php

use Illuminate\Support\Collection;

require_once __DIR__ . '/../vendor/autoload.php';

$scores = collect([
    ['score' => 76, 'team' => 'A'],
    ['score' => 62, 'team' => 'B'],
    ['score' => 82, 'team' => 'C'],
    ['score' => 86, 'team' => 'D'],
    ['score' => 91, 'team' => 'E'],
    ['score' => 67, 'team' => 'F'],
    ['score' => 67, 'team' => 'G'],
    ['score' => 82, 'team' => 'H'],
]);
$ranks = $scores->sortByDesc('score')
    ->groupBy('score')
    ->map(function ($group) {
        return collect($group)->pluck('team')->values();
    })
    ->values()
    ->map(function ($teams, $rank) {
        return $teams->map(function ($team) use ($rank) {
            return ['team' => $team, 'rank' => $rank + 1];
        });
    })
    ->collapse();

print_r($ranks);