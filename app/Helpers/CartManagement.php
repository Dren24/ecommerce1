<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    // Add item to cart or increase quantity
    public static function addItemsToCart($product_id, $qty = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $found = false;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity'] += $qty;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $product = Product::find($product_id, ['id', 'name', 'image', 'price']);

            if ($product) {
                $cart_items[] = [
                    'product_id'   => $product_id,
                    'name'         => $product->name,
                    'image'        => $product->image[0] ?? null,
                    'quantity'     => $qty,
                    'unit_amount'  => $product->price,
                    'total_amount' => $product->price * $qty,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);

        // Return total quantity (NOT item count)
        return self::getTotalQuantity($cart_items);
    }

    // Remove Cart Item
    public static function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        $cart_items = array_values($cart_items);
        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    // Increment quantity
    public static function incrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Decrement quantity
    public static function decrementQuantityToCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id && $cart_items[$key]['quantity'] > 1) {
                $cart_items[$key]['quantity']--;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    // Get cart items safely
    public static function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);

        return is_array($cart_items) ? $cart_items : [];
    }

    // Save to cookie
    public static function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // Clear Cart
    public static function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // Grand Total
    public static function calculateGrandTotal($cart_items)
    {
        return array_sum(array_column($cart_items, 'total_amount'));
    }

    // Get TOTAL quantity of all items
    public static function getTotalQuantity($cart_items = null)
    {
        if ($cart_items === null) {
            $cart_items = self::getCartItemsFromCookie();
        }

        return array_sum(array_column($cart_items, 'quantity'));
    }
}
