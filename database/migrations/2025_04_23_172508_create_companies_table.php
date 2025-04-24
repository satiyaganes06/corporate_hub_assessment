<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * @return void
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('website_link')->unique();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
