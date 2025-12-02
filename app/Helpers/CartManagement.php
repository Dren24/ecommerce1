<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    // Add item to cart (increase quantity if exists)
    public static function addItemsToCart($product_id, $qty = 1)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = null;

        // Find if product already exists in cart
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            // Increase quantity if item exists
            $cart_items[$existing_item]['quantity'] += $qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            // Add new product to cart
            $product = Product::find($product_id, ['id', 'name', 'image', 'price']);
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->image[0],
                    'quantity' => $qty,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price * $qty,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);

        // FIX: Return total quantity instead of count
        return self::getTotalQuantity($cart_items);
    }

    // Remove item from cart
    public static function removeCartItem($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        $cart_items = array_values($cart_items); // Reindex array
        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    // Increase item quantity
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

    // Decrease item quantity
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

    // Get cart items from cookie (sanitized)
    public static function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);

        // FIX: ensure it's an array, prevent invalid cookie data
        if (!$cart_items || !is_array($cart_items)) {
            $cart_items = [];
        }

        return $cart_items;
    }

    // Add/update cart items in cookie
    public static function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    // Clear cart items from cookie
    public static function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    // Calculate grand total
    public static function calculateGrandTotal($cart_items)
    {
        return array_sum(array_column($cart_items, 'total_amount'));
    }

    // FIX: Get total quantity of all items in cart
    public static function getTotalQuantity($cart_items = null)
    {
        if ($cart_items === null) {
            $cart_items = self::getCartItemsFromCookie();
        }

        return array_sum(array_column($cart_items, 'quantity'));
    }
}
