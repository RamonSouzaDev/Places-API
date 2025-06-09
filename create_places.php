<?php

use App\Models\Place;
use Illuminate\Support\Str;

// Create example places
$places = [
    [
        'name' => 'Copacabana Beach',
        'city' => 'Rio de Janeiro',
        'state' => 'RJ',
    ],
    [
        'name' => 'Cristo Redentor',
        'city' => 'Rio de Janeiro',
        'state' => 'RJ',
    ],
    [
        'name' => 'Parque Ibirapuera',
        'city' => 'São Paulo',
        'state' => 'SP',
    ],
    [
        'name' => 'Pelourinho',
        'city' => 'Salvador',
        'state' => 'BA',
    ],
    [
        'name' => 'Mercado Público',
        'city' => 'Porto Alegre',
        'state' => 'RS',
    ],
];

foreach ($places as $place) {
    Place::create([
        'name' => $place['name'],
        'slug' => Str::slug($place['name']),
        'city' => $place['city'],
        'state' => $place['state'],
    ]);
}

echo "Test places created successfully!\n";
