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
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('old_price', 10, 2)->after('price')->nullable();
            $table->boolean('status')->after('old_price')->nullable()->default(false);
            $table->text('additional_info')->nullable()->after('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('old_price');
            $table->dropColumn('status');
            $table->dropColumn('additional_info');
        });
    }
};
