<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('subscriber_providers_tokens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('provider_id')
                ->constrained('subscriber_providers')
                ->cascadeOnDelete();

            $table->string('access_token');
            $table->string('refresh_token')->nullable();
            $table->string('expires_in')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('subscriber_providers_tokens');
    }
};
