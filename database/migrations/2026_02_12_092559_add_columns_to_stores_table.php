<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('proofs', 1200)->nullable();
            $table->string('link', 255)->nullable();
            $table->string('store_type', 1200)->nullable();
            $table->string('category_id', 1200)->nullable();

            $table->string('street', 255)->nullable();
            $table->string('town', 255)->nullable();
            $table->string('post_code', 255)->nullable();

            $table->tinyInteger('open_all_time')->nullable();
            $table->decimal('delivery_earning', 11, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn([
                'proofs',
                'link',
                'store_type',
                'category_id',
                'street',
                'town',
                'post_code',
                'open_all_time',
                'delivery_earning',
            ]);
        });
    }
};
