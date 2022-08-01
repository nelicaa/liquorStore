<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $product;
    public $i;
    public $page;
    public function __construct($product, $i, $page)
    {
        $this->product=$product;
        $this->i=$i;
        $this->page=$page;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-component');
    }
}
