<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class PriceEuroExtension extends AbstractExtension{
    // j'ajoute un nouveau filtre aux tableaux des filtres Symfony
    public function getFilters()
    {
        return [
            new TwigFilter('priceEuro', [
                $this, 'priceEuro'
            ])
        ];
    }
    // je décris le comportement du filtre priceEuro
    public function priceEuro($value)
    {
        $finalValue = $value / 100;

        $finalValue = number_format($finalValue, 2, ',', ' ');

        return $finalValue . ' €';
    }
}
  