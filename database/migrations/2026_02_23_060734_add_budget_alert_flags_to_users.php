<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('alert_50_sent')->default(false);
        $table->boolean('alert_90_sent')->default(false);
        $table->boolean('alert_100_sent')->default(false);
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['alert_50_sent', 'alert_90_sent','alert_100_sent']);
    });
}
};
