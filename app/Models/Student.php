<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public static function getStudents()
    {
        $cacheKey = 'students.all'; // Unique key to identify the cached result
        $minutes = 5;

        return Cache::remember($cacheKey, $minutes, function () {
            return self::all();
        });
    }


    public static function createStudent($data)
    {
        // Create the student record

        Cache::forget('students.all'); // Clear the cache
    }
}
