<?php

use App\Models\ZipCode;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        try {
            (new FastExcel)->import(storage_path('xlsx/') . 'iranyitoszamok.xlsx', function ($line) {
                return ZipCode::create([
                    'city' => $line['Település név'],
                    'county' => $line['Megye név'] === 'Csongrád' ? 'Csongrád-Csanád' : $line['Megye név'],
                    'zip_code' => $line['Irányítószám'],
                ]);
            });
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
