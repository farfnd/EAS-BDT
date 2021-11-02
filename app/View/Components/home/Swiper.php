<?php

namespace App\View\Components\Home;

use Illuminate\View\Component;

class Swiper extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $image;
    public $text;
    public function __construct($image, $text)
    {
        $this->image = $image;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.swiper');
    }
}
