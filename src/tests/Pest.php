<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

$testDirs = [
    'Feature',
    'Unit'
];

foreach ($testDirs as $testDir) {
    uses(Tests\TestCase::class, RefreshDatabase::class)->in($testDir);
}

