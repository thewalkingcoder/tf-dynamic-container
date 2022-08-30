<?php

namespace App\Controller;

use App\Application\Command\CreatePost;
use App\Form\PostType;
use App\Services\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_app")
     */
    public function index(PostService $postService): Response
    {
        $post = $postService->doTheStuff(1);

        return $this->render('app/index.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/form", name="app_form")
     */
    public function form(Request $request, PostService $postService): Response
    {

        $form = $this->createForm(PostType::class);

        $postView = '';
        if($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $post = $postService->doTheStuff($form->getData()['id']);
            $postView = $post->getId(). ' '.$post->getName();
        }

        return $this->renderForm('app/form.html.twig', [
            'form' => $form,
            'postView' => $postView,
        ]);
    }

    /**
     * @Route("/message", name="app_message")
     */
    public function message(MessageBusInterface $bus): Response
    {
        $command = new CreatePost();
        $command->id = 1;
        $bus->dispatch($command);

        return new Response('Data Send');
    }
}
