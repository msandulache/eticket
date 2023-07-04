<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    private array $messages = [
        ['message' => 'one', 'created' => '2023/06/12'],
        ['message' => 'two', 'created' => '2023/05/12'],
        ['message' => 'three', 'created' => '2022/04/12']
    ];

    #[Route('/{limit<\d+>?3}', name: 'app_index')]
    public function index(int $limit): Response
    {
        return $this->render('hello/index.html.twig',[
            'messages' => $this->messages,
            'limit' => $limit
        ]);
    }

    #[Route('/messages/{id}', 'app_show_one')]
    public function showOne($id): Response
    {
        return $this->render('hello/show_one.html.twig',[
            'message' => $this->messages[$id]
        ]);
    }
}