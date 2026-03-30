<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class LearningController extends AbstractController
{
    #[Route('/learning/{file}', name: 'learning', requirements: ['file' => 'tasks|questionnaire'])]
    public function show(string $file): Response
    {
        $path = $this->getParameter('kernel.project_dir') . '/learning/' . $file . '.md';

        if (!file_exists($path)) {
            throw new NotFoundHttpException();
        }

        return $this->render('learning/show.html.twig', [
            'content' => file_get_contents($path),
            'title' => $file === 'tasks' ? 'Tâches de coding' : 'Questionnaire',
            'file' => $file,
        ]);
    }
}
