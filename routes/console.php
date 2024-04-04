<?php

use App\Models\Contracts;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('read_csv', function () {

// Assuming the CSV file is uploaded and stored in the 'storage/app' directory
    $path = storage_path('app/' . 'csv_file.csv');
    $file = fopen($path, 'r');

// Skip the header row if the CSV has one
    fgetcsv($file);

// Process each row
    while (($row = fgetcsv($file)) !== FALSE) {
// Compare with existing data
        $existingRecord = Contracts::where('column1', $row[0])
            ->where('column2', $row[1])
// Add more conditions as needed
            ->first();

// If the record does not exist, save it
        if (!$existingRecord) {
            $newRecord = new \App\Models\Contracts([
                'column1' => $row[0],
                'column2' => $row[1],
// Map more columns as needed
            ]);
            $newRecord->save();
        }
    }

    fclose($file);

    return "CSV import and comparison completed successfully.";
})->purpose('Read CSV file for contract')->hourly();

Schedule::command('inspire')->hourly();
// Schedule->command('import:csvdata')->everyMinute();

