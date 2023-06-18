<?php

use Illuminate\Support\Collection;

require_once __DIR__.'/../vendor/autoload.php';

$employees = collect([
    [
        'name' => 'John',
        'email' => 'john3@example.com',
        'sales' => [
            ['customer' => 'The Blue Rabbit Company', 'order_total' => 7444],
            ['customer' => 'Black Melon', 'order_total' => 1445],
            ['customer' => 'Foggy Toaster', 'order_total' => 700],
        ],
    ],
    [
        'name' => 'Jane',
        'email' => 'jane8@example.com',
        'sales' => [
            ['customer' => 'The Grey Apple Company', 'order_total' => 203],
            ['customer' => 'Yellow Cake', 'order_total' => 8730],
            ['customer' => 'The Piping Bull Company', 'order_total' => 3337],
            ['customer' => 'The Cloudy Dog Company', 'order_total' => 5310],
        ],
    ],
    [
        'name' => 'Dave',
        'email' => 'dave1@example.com',
        'sales' => [
            ['customer' => 'The Acute Toaster Company', 'order_total' => 1091],
            ['customer' => 'Green Mobile', 'order_total' => 2370],
        ],
    ],
]);


// Just single sale is greater 
$employeeWithMaxSale = $employees->map(function ($employee) {
    $employee['maxSale'] = collect($employee['sales'])->max('order_total');
    return $employee;
})->sortByDesc('maxSale')->first();

$employeeWithMaxSaleValue = $employeeWithMaxSale['name'];

echo "The employee with the highest single sale is: $employeeWithMaxSaleValue  \n";


// collective max sales
$employeeWithMostValuableSale = $employees->map(function ($employee) {
    $totalSales = collect($employee['sales'])->sum('order_total');
    $employee['totalSales'] = $totalSales;
    return $employee;
})->sortByDesc('totalSales')->first();

$employeeNameWithMostValuableSale = $employeeWithMostValuableSale['name'];

echo "The employee with the highest total sales is: $employeeNameWithMostValuableSale";