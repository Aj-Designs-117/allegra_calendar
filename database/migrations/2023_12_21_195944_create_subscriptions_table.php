<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('limit_class');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('package_id')->constrained('packages');
            $table->timestamps();
            $table->unique(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('subscriptions');
        Schema::enableForeignKeyConstraints();
    }
};
