<?php

namespace App\Actions;

use App\Models\Basket;
use App\Models\Counteragent;
use App\Models\Order;
use App\Models\PriceType;
use App\Models\Product;
use App\Models\ProductPriceType;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductGetPriceAction
{

    static function execute(Product $product,Store $store)
    {

        if (!$store){
            $priceType = PriceType::find(1);
            $productPriceType = $product->prices()->where('price_type_id',$priceType->id)->first();

            return $productPriceType->price;
        }
        $counteragent = $store->counteragent;
        $priceType = $counteragent ? $counteragent->priceType: PriceType::find(1);

        $discount = $counteragent ? $counteragent->discount: 0;
        $discount = $discount == 0 ? $store->discount : $discount;

        $productPriceType = $product->prices()->where('price_type_id',$priceType->id)->first();
        $discount = $discount == 0 ?  $product->discount : $discount;

        if (!$productPriceType) return  0;

        $discount = $discount == 0 ?  $product->discount : $discount;

        return self::discount($productPriceType->price,$discount);
    }

    protected static function discount($price,$discount):float|int
    {
        $discountPrice = ( $price / 100) * $discount;
        return $price - $discountPrice;
    }

}
