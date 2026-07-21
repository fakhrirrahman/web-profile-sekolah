<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ppdb_registration_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppdb_registration_id')->constrained('ppdb_registrations')->cascadeOnDelete();
            $table->string('status');
            $table->timestamp('changed_at');
            $table->timestamps();
        });

        DB::table('ppdb_registrations')
            ->select(['id', 'status', 'created_at'])
            ->orderBy('id')
            ->chunkById(100, function ($registrations) {
                $now = now();

                DB::table('ppdb_registration_status_histories')->insert(
                    $registrations->map(fn ($registration) => [
                        'ppdb_registration_id' => $registration->id,
                        'status' => $registration->status,
                        'changed_at' => $registration->created_at ?? $now,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ])->all()
                );
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppdb_registration_status_histories');
    }
};
