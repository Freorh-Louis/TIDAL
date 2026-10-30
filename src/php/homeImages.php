<?php

/**
 * ========================================================================

 * DESCRIPTION :
 * Ici on "construit" un tableau de données qui sera utilisé pour la génération
 * dynamique de la page d'accueil
 * Les éléments de ce tableau incluent des images, des descriptions, et des liens vers les détails des patho
 * correspondant à chaque image
 * 
 * ========================================================================
 */

return [
    'images_path' => '../images/',
    'items' => [
        [
            'image' => 'stress.jpeg',
            'alt' => 'Gérer le stress',
            'description' => "Soulagez votre stress et retrouvez un esprit apaisé grâce à l'acupuncture.",
            'patho' => "/detailPathologie?id=57"
        ],
        [
            'image' => 'digestion.jpeg',
            'alt' => 'Problèmes digestifs',
            'description' => "Découvrez comment l'acupuncture peut améliorer votre digestion et votre bien-être intestinal.",
            'patho' => "/detailPathologie?id=16"
        ],
        [
            'image' => 'migraine.jpg',
            'alt' => 'Migraines',
            'description' => "Dites adieu aux migraines grâce aux bienfaits de l'acupuncture.",
            'patho' => "/detailPathologie?id=86"
        ],
        [
            'image' => 'energie.webp',
            'alt' => 'Fatigue chronique',
            'description' => "Boostez votre énergie et réduisez la fatigue avec des soins adaptés.",
            'patho' => "/detailPathologie?id=38"
        ]
    ]
];