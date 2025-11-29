<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    #[Title('Home Page')]
    public function render()
    {

        $brands = Brand::where('is_active', true)->get();

        $category = Category::where('is_active', true)->get();

        return view('livewire.homepage', [
            'brands' => $brands,
            'category' => $category
        ]);
    }
}
