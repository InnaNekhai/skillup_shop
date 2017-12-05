<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.12.2017
 * Time: 9:23
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class LuckyController
{
    public function number(){
        $number = mt_rand(1, 100);
        $response = new Response('<html><body>Lucky number: '.$number.'</body></html>');
        return $response;
    }

}