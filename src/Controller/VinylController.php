<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController
{
    #[Route('/')]
    public function homepage(): Response
    {
        return new Response('Wohoo!');
    }

    #[Route('/browse/{slug}')]
    public function browse(string $slug = null): Response
    {
        $title = 'All Genres';
        if ($slug) {
            $title = 'Genre ' . u(str_replace('-', ' ', $slug))->title(true);
        }
        return new Response($title);
    }
}
