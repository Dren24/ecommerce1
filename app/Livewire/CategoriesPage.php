<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;

class CategoriesPage extends Component
{
    #[Title('Categories Page')]
    public function render()
    {
        return view('livewire.categories-page', [
            'categories' => Category::query()
                ->where('is_active', true)
                ->orderBy('name', 'asc')
                ->get(),
        ]);
    }
}
