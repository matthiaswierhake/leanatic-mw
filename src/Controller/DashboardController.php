<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController  extends AbstractController
{

    #[Route('/base')]
    public function base(): Response
    {
        // the template path is the relative file path from `templates/`
        return $this->render('base.html.twig');
    }


    #[Route('/dashboardApi')]
    public function dashboardApi(): Response
    {
        $data = $this->getData();

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return($response);
    }


    public function getData(){

        // max 10 Einträge
        $services = ["Collerys", "Duftz", "Belegbote","Greetix","Alpha","Beta","Gamma","Delta","Epsilon","Zeta"];
        $colors = ["text-bg-primary","text-bg-secondary","text-bg-success","text-bg-danger","text-bg-warning","text-bg-primary","text-bg-secondary","text-bg-success","text-bg-danger","text-bg-warning"];


        $randarr1 = array_map(function () {
            return rand(50, 5000);
        }, array_fill(0, 10, null));

        $randarr2 = array_map(function () {
            return rand(50, 5000);
        }, array_fill(0, 10, null));

        $data = [];
        for ($i = 0; $i < count($services);$i++){
            $arr = [];
            $arr["url"] = $services[$i];
            $arr["register"] = $randarr1[$i];
            $arr["login"] = $randarr2[$i];
            $arr["color"] = $colors[$i];
            $data[$i]= $arr;
        }

        return($data);
    }


}
