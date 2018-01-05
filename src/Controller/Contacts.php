<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 03.01.2018
 * Time: 20:46
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class Contacts extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/contacts", name="contacts")
     */

    public function showContacts()
    {

        return $this->render('contacts/contacts.html.twig');

    }

}