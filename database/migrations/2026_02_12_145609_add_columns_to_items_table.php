<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->decimal('cost_price', 24, 2)->default(0.00);

            $table->integer('normal_selling_price_deal')->default(0);
            $table->integer('normal_selling_discount_deal')->default(0);

            $table->text('ingredient_nutrition')->nullable();
            $table->text('other_info')->nullable();

            $table->integer('max_deal_quantity')->nullable();
            $table->integer('buy')->nullable();
            $table->integer('get_item')->nullable();

            $table->longText('mix_match_choice_1')->nullable();
            $table->longText('mix_match_choice_2')->nullable();
            $table->longText('mix_match_choice_3')->nullable();

            $table->decimal('vat', 24, 2)->nullable();

            $table->boolean('age_restricted')->default(0);
            $table->boolean('promotional')->default(0);
            $table->date('promotion_ends_at')->nullable();

            $table->boolean('a_pound_or_less')->default(0);
            $table->boolean('offer_item')->default(0);
            $table->boolean('bulk_buys')->default(0);

            $table->string('sku', 255)->nullable();
            $table->boolean('stock_item')->default(0);

            $table->integer('offer_qty')->default(1);
            $table->decimal('offer_price', 24, 2)->nullable();

            $table->integer('producer_id')->nullable();
            $table->integer('unit_qty')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn([
                'cost_price',
                'normal_selling_price_deal',
                'normal_selling_discount_deal',
                'ingredient_nutrition',
                'other_info',
                'max_deal_quantity',
                'buy',
                'get_item',
                'mix_match_choice_1',
                'mix_match_choice_2',
                'mix_match_choice_3',
                'vat',
                'age_restricted',
                'promotional',
                'promotion_ends_at',
                'a_pound_or_less',
                'offer_item',
                'bulk_buys',
                'sku',
                'stock_item',
                'offer_qty',
                'offer_price',
                'producer_id',
                'unit_qty',
            ]);
        });
    }
};
