<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    // ADD ITEM TO CART
    public static function addItemsToCart($product_id, $qty = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $found = false;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity'] += $qty;
                $cart_items[$key]['total_amount'] =
                    $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $product = Product::find($product_id, [
                'id',
                'name',
                'image',
                'selling_price'
            ]);

            if ($product) {
                $cart_items[] = [
                    'product_id'   => $product->id,
                    'name'         => $product->name,
                    'image'        => $product->image, // STRING (correct)
                    'quantity'     => $qty,
                    'unit_amount'  => (float) $product->selling_price,
                    'total_amount' => (float) $product->selling_price * $qty,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);

        return self::getTotalQuantity($cart_items);
    }

    // REMOVE ITEM
    public static function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        $cart_items = array_values(array_filter($cart_items, function ($item) use ($product_id) {
            return $item['product_id'] != $product_id;
        }));

        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    // INCREASE QTY
    public static function incrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity']++;
                $item['total_amount'] = $item['quantity'] * $item['unit_amount'];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // DECREASE QTY
    public static function decrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as &$item) {
            if ($item['product_id'] == $product_id && $item['quantity'] > 1) {
                $item['quantity']--;
                $item['total_amount'] = $item['quantity'] * $item['unit_amount'];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // GET CART FROM COOKIE
    public static function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        return is_array($cart_items) ? $cart_items : [];
    }

    // SAVE CART
    public static function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // CLEAR CART
    public static function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // GRAND TOTAL
    public static function calculateGrandTotal($cart_items)
    {
        return array_sum(array_column($cart_items, 'total_amount'));
    }

    // TOTAL QUANTITY (for navbar)
    public static function getTotalQuantity($cart_items = null)
    {
        if ($cart_items === null) {
            $cart_items = self::getCartItemsFromCookie();
        }

        return array_sum(array_column($cart_items, 'quantity'));
    }
}
