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
        Schema::table('sale_details', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_item_id')->nullable()->after('id');

            $table->foreign('sale_item_id')
                ->references('id')
                ->on('sale_items')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('sale_details', function (Blueprint $table) {
            $table->dropForeign(['sale_item_id']);
            $table->dropColumn('sale_item_id');
        });
    }

};
