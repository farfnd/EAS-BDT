<?php

namespace App\View\Components\wishlist;

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
    public $star;

    public function __construct($gender, $namaBarang, $hargaBarang, $photo, $id, $star)
    {
        $this->gender = $gender;
        $this->namaBarang = $namaBarang;
        $this->hargaBarang = $hargaBarang;
        $this->photo = $photo;
        $this->id = $id;
        $this->star = $star;
        if($gender == "men") $this->color = "bg-blue-500";
        else if($gender == "women") $this->color = "bg-red-400";
        else if($gender == "unisex") $this->color = "bg-yellow-500";
    }

    public function render()
    {
        return view('components.wishlist.card');
    }
}
