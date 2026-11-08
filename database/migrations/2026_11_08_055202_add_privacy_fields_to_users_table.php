<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('privacy_accepted_at')->nullable()->after('role');
            $table->string('privacy_policy_version', 20)->nullable()->after('privacy_accepted_at');
            $table->timestamp('anonymized_at')->nullable()->after('privacy_policy_version');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['privacy_accepted_at', 'privacy_policy_version', 'anonymized_at']);
        });
    }
};
