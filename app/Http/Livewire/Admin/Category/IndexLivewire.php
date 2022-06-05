<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class IndexLivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $categoryId;

    public function deleteCategory($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function destroyCategory()
    {
        $category = Category::findOrFail($this->categoryId);
        $category->delete();
        $this->emit('categoryDeleted');
    }


    public function render()
    {
        $categories = Category::orderBy("id", "asc")->paginate(3);
        return view('livewire.admin.category.index-livewire', [
            'categories' => $categories
        ]);
    }
}