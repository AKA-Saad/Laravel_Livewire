<?php

use Illuminate\Support\Collection;

require_once __DIR__ . '/../vendor/autoload.php';

$scores = collect ([
    ['score' => 91, 'team' => 'A'],
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
    ->map(function ($group, $score) {
        static $currentRank = 0;
        $teamsCount = $group->count();
        $rank = ++$currentRank;
        $currentRank += $teamsCount - 1;
        return $group->map(function ($team) use ($rank) {
            return ['team' => $team['team'], 'rank' => $rank];
        });
    })
    ->collapse();

print_r($ranks);

