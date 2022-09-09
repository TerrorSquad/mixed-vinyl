<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class VinylController
{
    #[Route('/')]
    public function homepage(): Response {
        return new Response('Wohoo!');
    }
}
