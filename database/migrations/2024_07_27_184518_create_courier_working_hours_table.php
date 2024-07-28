<?php

use App\Models\Courier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courier_working_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Courier::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('working_hours');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courier_working_hours');
    }
};
