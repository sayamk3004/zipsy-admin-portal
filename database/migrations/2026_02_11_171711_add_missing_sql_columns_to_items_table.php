<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $columns = [
                'supplier_id'               => ['type' => 'integer', 'after' => 'image'],
                'module_type'               => ['type' => 'string', 'default' => 'zipsy_plus', 'after' => 'supplier_id'],
                'category_ids'              => ['type' => 'string', 'length' => 255, 'nullable' => true, 'after' => 'category_id'],
                'filter_id'                => ['type' => 'integer', 'nullable' => true, 'after' => 'category_ids'],
                'sub_filter_ids'           => ['type' => 'string', 'length' => 1200, 'nullable' => true, 'after' => 'filter_id'],
                'variations'               => ['type' => 'text', 'nullable' => true, 'after' => 'sub_filter_ids'],
                'add_ons'                 => ['type' => 'string', 'length' => 255, 'nullable' => true, 'after' => 'variations'],
                'attributes'              => ['type' => 'string', 'length' => 255, 'nullable' => true, 'after' => 'add_ons'],
                'item_sell_type'          => ['type' => 'string', 'length' => 1200, 'default' => 'single', 'after' => 'attributes'],
                'deal_type'              => ['type' => 'string', 'length' => 255, 'nullable' => true, 'after' => 'item_sell_type'],
                'cost_price'             => ['type' => 'decimal', 'precision' => 24, 'scale' => 2, 'default' => 0.00, 'after' => 'deal_type'],
                'normal_selling_price_deal' => ['type' => 'integer', 'default' => 0, 'after' => 'cost_price'],
                'normal_selling_discount_deal' => ['type' => 'integer', 'default' => 0, 'after' => 'normal_selling_price_deal'],
                'ingredient_nutrition'   => ['type' => 'text', 'nullable' => true, 'after' => 'normal_selling_discount_deal'],
                'other_info'            => ['type' => 'text', 'nullable' => true, 'after' => 'ingredient_nutrition'],
                'max_deal_quantity'     => ['type' => 'integer', 'nullable' => true, 'after' => 'other_info'],
                'buy'                   => ['type' => 'integer', 'nullable' => true, 'after' => 'max_deal_quantity'],
                'get_item'              => ['type' => 'integer', 'nullable' => true, 'after' => 'buy'],
                'mix_match_choice_1'    => ['type' => 'longtext', 'collation' => 'utf8mb4_bin', 'nullable' => true, 'after' => 'get_item'],
                'mix_match_choice_2'    => ['type' => 'longtext', 'collation' => 'utf8mb4_bin', 'nullable' => true, 'after' => 'mix_match_choice_1'],
                'mix_match_choice_3'    => ['type' => 'longtext', 'collation' => 'utf8mb4_bin', 'nullable' => true, 'after' => 'mix_match_choice_2'],
                'choice_options'        => ['type' => 'text', 'default' => '[]', 'after' => 'mix_match_choice_3'],
                'vat'                   => ['type' => 'decimal', 'precision' => 24, 'scale' => 2, 'nullable' => true, 'after' => 'price'],
                'tax_type'              => ['type' => 'string', 'length' => 20, 'default' => 'percent', 'after' => 'tax'],
                'discount_type'         => ['type' => 'string', 'length' => 20, 'default' => 'percent', 'after' => 'discount'],
                'available_time_starts' => ['type' => 'time', 'nullable' => true, 'after' => 'discount_type'],
                'available_time_ends'   => ['type' => 'time', 'nullable' => true, 'after' => 'available_time_starts'],
                'age_restricted'        => ['type' => 'boolean', 'default' => 0, 'after' => 'store_id'],
                'promotional'           => ['type' => 'boolean', 'default' => 0, 'after' => 'age_restricted'],
                'promotion_ends_at'     => ['type' => 'date', 'nullable' => true, 'after' => 'promotional'],
                'a_pound_or_less'       => ['type' => 'boolean', 'default' => 0, 'after' => 'promotion_ends_at'],
                'offer_item'            => ['type' => 'boolean', 'default' => 0, 'after' => 'a_pound_or_less'],
                'bulk_buys'             => ['type' => 'boolean', 'default' => 0, 'after' => 'offer_item'],
                'sku'                   => ['type' => 'string', 'length' => 255, 'nullable' => true, 'after' => 'bulk_buys'],
                'stock_item'            => ['type' => 'boolean', 'default' => 0, 'after' => 'sku'],
                'offer_qty'             => ['type' => 'integer', 'default' => 1, 'after' => 'stock_item'],
                'offer_price'           => ['type' => 'decimal', 'precision' => 24, 'scale' => 2, 'nullable' => true, 'after' => 'offer_qty'],
                'cost_price'           => ['type' => 'decimal', 'precision' => 24, 'scale' => 2, 'nullable' => true],
                'producer_id'           => ['type' => 'integer', 'nullable' => true, 'after' => 'offer_price'],
                'unit_qty'              => ['type' => 'integer', 'nullable' => true, 'after' => 'unit_id'],
                'food_variations'       => ['type' => 'text', 'nullable' => true, 'after' => 'images'],
                'slug'                  => ['type' => 'string', 'length' => 255, 'nullable' => true, 'after' => 'food_variations'],
                'rating'                => ['type' => 'string', 'length' => 255, 'nullable' => true, 'after' => 'rating_count'],
            ];

            foreach ($columns as $column => $attrs) {
                if (!Schema::hasColumn('items', $column)) {
                    $col = $table->{$attrs['type']}($column, $attrs['length'] ?? null, $attrs['precision'] ?? null, $attrs['scale'] ?? null);
                    if (isset($attrs['default'])) {
                        $col->default($attrs['default']);
                    }
                    if (!empty($attrs['nullable'])) {
                        $col->nullable();
                    }
                    if (isset($attrs['after'])) {
                        $col->after($attrs['after']);
                    }
                    if (isset($attrs['collation'])) {
                        $col->collation($attrs['collation']);
                    }
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $columns = [
                'supplier_id', 'module_type', 'category_ids', 'filter_id', 'sub_filter_ids',
                'variations', 'add_ons', 'attributes', 'item_sell_type', 'deal_type',
                'cost_price', 'normal_selling_price_deal', 'normal_selling_discount_deal',
                'ingredient_nutrition', 'other_info', 'max_deal_quantity', 'buy', 'get_item',
                'mix_match_choice_1', 'mix_match_choice_2', 'mix_match_choice_3',
                'choice_options', 'vat', 'tax_type', 'discount_type', 'available_time_starts',
                'available_time_ends', 'age_restricted', 'promotional', 'promotion_ends_at',
                'a_pound_or_less', 'offer_item', 'bulk_buys', 'sku', 'stock_item',
                'offer_qty', 'offer_price', 'producer_id', 'unit_qty', 'food_variations',
                'slug', 'rating'
            ];
            $table->dropColumn($columns);
        });
    }
};