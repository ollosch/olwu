<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignUlid('permission_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignUlid('role_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->primary(['permission_id', 'role_id']);
        });
    }
};
