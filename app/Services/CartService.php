<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    protected $sessionKey;

    public function __construct()
    {
        $this->sessionKey = 'cart_default';
    }

    public function session($key)
    {
        $this->sessionKey = 'cart_' . $key;
        return $this;
    }

    public function add($data)
    {
        $cart = $this->getContent();
        $id = $data['id'];

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $data['quantity'];
        } else {
            $cart[$id] = [
                'id' => $data['id'],
                'name' => $data['name'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'attributes' => $data['attributes'] ?? [],
                'associatedModel' => $data['associatedModel'] ?? null,
            ];
        }

        $this->save($cart);
        return $this;
    }

    public function update($id, $data)
    {
        $cart = $this->getContent();

        if (isset($cart[$id])) {
            if (isset($data['quantity'])) {
                // Check if relative or absolute
                if (is_array($data['quantity']) && isset($data['quantity']['relative']) && $data['quantity']['relative'] === false) {
                     $cart[$id]['quantity'] = $data['quantity']['value'];
                } else {
                     // Default behavior or simple assignment if not complex
                     $val = is_array($data['quantity']) ? $data['quantity']['value'] : $data['quantity'];
                     $cart[$id]['quantity'] = $val; 
                }
            }
            $this->save($cart);
        }
        return $this;
    }

    public function remove($id)
    {
        $cart = $this->getContent();
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->save($cart);
        }
        return $this;
    }

    public function clear()
    {
        Session::forget($this->sessionKey);
        return $this;
    }

    public function getContent()
    {
        return Session::get($this->sessionKey, collect([]));
    }

    public function getTotalQuantity()
    {
        return $this->getContent()->sum('quantity');
    }

    public function getTotal()
    {
        return $this->getContent()->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function isEmpty()
    {
        return $this->getContent()->isEmpty();
    }

    protected function save($cart)
    {
        Session::put($this->sessionKey, collect($cart));
    }
}
