<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.12.2017
 * Time: 9:34
 */

namespace App\Controller;


use App\Entity\Feedback;
use App\Entity\Product;
use App\Form\FeedbackType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AboutController extends Controller
{


    /**
     * @Route("/about" , name="about_show" )
     *
     * @return Response
     */

    public function show(SessionInterface $session)
    {
        $url = $this->generateUrl('category_show',
            ['slug'=> 'notebooks',
                'param'=>'getparam'], UrlGeneratorInterface::ABSOLUTE_URL
    );


        $about = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur consequuntur deserunt dolorem dolorum, eius est iste iure iusto maiores modi neque nesciunt perspiciatis quae recusandae rerum sed totam voluptas.';
        return $this->render('about/about.html.twig',
            ['about' => $about,
                'notebookUrl' => $url,
                'lastCategory' => $session->get('lastCategory')
                ]);
    }

    /**
     * @Route("/to-about")
     */
    public function redirectToShow()
    {
        return $this->redirectToRoute('about_show');
    }

    /**
     * @Route("/feedback", name="feedback")
     *
     * @param Request $request
     * @return Response
     */
    public function feedback(Request $request, EntityManagerInterface $em, \Swift_Mailer $mailer)
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($feedback);
            $em->flush();
            $this->addFlash('info', 'Спасибо за обращение!');

            $message = (new \Swift_Message('Обращение с сайта'))
                ->setFrom( [getenv('MAILER_FROM')=>getenv('MAILER_FROM_NAME')])
                ->setTo(getenv('ADMIN_EMAIL'))
                ->setBody(
                    $this->renderView(
                        'about/message.html.twig',
                        array('feedback' => $feedback)
                    ),
                    'text/html'
                );

            $mailer->send($message);

            return $this->redirectToRoute('feedback');
        }

        return $this->render('about/feedback.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}