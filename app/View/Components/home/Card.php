<?php

namespace App\View\Components\Home;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $gender;
    public $namaBarang;
    public $hargaBarang;
    public $color;
    public $photo;
    public $id;
    public $inWishlist;

    public function __construct($gender, $namaBarang, $hargaBarang, $photo, $id, $inWishlist)
    {
        $this->gender = $gender;
        $this->namaBarang = $namaBarang;
        $this->hargaBarang = $hargaBarang;
        $this->photo = $photo;
        $this->id = $id;
        $this->inWishlist = $inWishlist;
        if($gender == "men") $this->color = "bg-blue-500";
        else if($gender == "women") $this->color = "bg-red-400";
        else if($gender == "unisex") $this->color = "bg-yellow-500";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.card');
    }
}
