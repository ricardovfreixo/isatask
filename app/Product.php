<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    public $products = [];
    public $category = [];
    private $colorCriteria = null;
    private $brandcriteria = null;
    private $sortCriteria = null;

    public function __construct()
    {
        $rawdata = json_decode(file_get_contents('./data/products.json'));
        $this->products = $rawdata->products;
        $this->category = $rawdata->category;
    }

    public function getAll()
    {
        $products = [];

        if($this->colorCriteria !== null)
        {
            foreach($this->products as $product)
            {
                if($product->color == $this->colorCriteria)
                    $products[] = $product;
            }
            return $products;
        }

        if(count($products) === 0) $products = $this->products;

        if($this->sortCriteria !== null)
        {
            usort($products, function($a, $b)
             {
                 if ($a->price == $b->price)
                     return (0);

                if($this->sortCriteria == 'asc')
                 return (($a->price < $b->price) ? -1 : 1);

                if($this->sortCriteria == 'desc')
                 return (($a->price > $b->price) ? -1 : 1);
             });
        }

        return $products;
    }

    public function setSorting($direction)
    {
        $this->sortCriteria = $direction;
    }

    public function setColorFilter($color)
    {
        $this->colorCriteria = $color;
    }

    public function getCategory()
    {
        return $this->category;
    }

    function getColors()
    {
        $colors = [];

        foreach($this->products as $p)
        {
            if(isset($colors[$p->color]))
            {
                $colors[$p->color]++;
            } else {
                $colors[$p->color] = 1;
            }
        }
        return $colors;
    }

    function getBrands()
    {
        $brands = [];

        foreach($this->products as $p)
        {
            if(isset($brands[$p->brand]))
            {
                $brands[$p->brand]++;
            } else {
                $brands[$p->brand] = 1;
            }
        }
        return $brands;
    }

}
