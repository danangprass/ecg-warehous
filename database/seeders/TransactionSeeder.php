<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $intitalDate = Carbon::parse('2024-01-01 00:00:00');
        // Initial Stock Transaction
        Transaction::factory(30)->hasDetails(
            rand(1, 5),
            function () {
                return ['amount' => rand(11, 25)];
            }
        )->create(['date' => $intitalDate]);

        for ($i = 0; $i < 10; $i++) {
            $intitalDate = $intitalDate->addDay();
            // Form Repair 1
            Transaction::factory()->hasDetails(
                rand(1, 5),
                function () {
                    return ['amount' => rand(-5, -1)];
                }
            )->create(['date' => $intitalDate->addDay()]);

            $intitalDate = $intitalDate->addDay();
            // Form Modif 2
            Transaction::factory()->hasDetails(
                rand(1, 5),
                function () {
                    return ['amount' => rand(1, 5)];
                }
            )->create(['date' => $intitalDate->addDay()]);
        }
    }
}
