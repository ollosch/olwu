<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignUlid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('role_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignUlid('system_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUlid('module_id')->nullable()->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }
};
