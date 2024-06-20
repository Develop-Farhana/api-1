<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $csvFile = database_path('seeders/users.csv'); // Path to your CSV file

        $csv = array_map('str_getcsv', file($csvFile));

        $headers = array_shift($csv);

        foreach ($csv as $row) {
            $data = array_combine($headers, $row);

            // Insert data into users table
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'address' => $data['address'],
                'role' => $data['role'],
                // Add other columns as needed
            ]);
        }
    }
}
