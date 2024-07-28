<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
//                ->constrained('orders')->onDelete('cascade');
            $table->integer('courier_id');
//            ->constrained('couriers')->onDelete('cascade');
            $table->timestamp('assign_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_assignments');
    }
};
