<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Job;
use App\Entity\Image;

class JobController extends AbstractController
{
    /**
     * @Route("/job", name="job")
     */
    public function index()
    {
        return $this->render('job/index.html.twig', [
            'controller_name' => 'JobController',
        ]);
    }

    /**
    *@Route("/accueil",name="accueil")
    */

    public function accueil(Request $request){
    	$nom=$request->query->get('nom');
    	return $this->render('job/accueil.html.twig',['nom' => $nom,
    ]);
    }

    /**
    *@Route("/voir/{id}",name="voir",
    requirements={"id"="\d+"})
    */
    public function voir($id)
    {
        $repository =$this->getDoctrine()->getManager()->getRepository(job::class);

        $job=$repository->find($id);
       /* if(null==job){


        throw new NotFoundHttpException ("Le job ayant l'id ".$id." n'existe pas ");
         }*/
    	//return $this->redirectToRoute("job");
    	return $this->render('job/voir.html.twig',array('job'=>$job));
    
    	
    }
    /**
    *@Route("/ajouter",name="ajouter")
    */
    public function ajouter()
    {
        /*$job = new job();
    	$date="2020-01-01";
        $em=$this->getDoctrine()->getManager();
        $post=$em->getRepository(job::class)->find(1);
        $post->setExpiresAt(new\Datetime($date));
        $em->persist($post);
        $em->flush();*/
        
        $job = new job();
        $job->setTitel('Dev Android');
        $job->setCompany('sumsung');
        $job->setDescription("Nous cherchons un dev android");
        $job->setIsActivated(1);
        $job->setExpiresAt(new\Datetime());
        $job->setEmail("farouk_rabhi@msn.com");

        $image =new image();
        $image->setUrl("https://www.google.tn/url?sa=i&source=images&cd=&ved=2ahUKEwiJ5IKAo-DeAhUDaVAKHdm9CCkQjRx6BAgBEAU&url=https%3A%2F%2Fwww.pexels.com%2Fsearch%2Fhd%2520background%2F&psig=AOvVaw02zWqS_03X_4AEz08pV30C&ust=1542710607981228");
        $image->setAlt('Dev android');
        $job->setImage($image);
        $em=$this->getDoctrine()->getManager();
        $em->persist($job);
        $em->flush();
        return $this->render("job/ajouter.html.twig",array('id'=>$job->getId()));
    }

     /**
    *@Route("/modifier/{id}",name="modifier")
    */
    public function modifier($id)
    {

    	return $this->render("job/modifier.html.twig",['id' => $id,
    ]);
    }

     /**
    *@Route("/supprimer/{id}",name="supprimer")
    */
    public function supprimer($id)
    {
    	return $this->render("job/supprimer.html.twig",['id' => $id,
    ]);
    }


    /**
    *@Route("/base",name="base")
    */
    public function base()
    {
    	return $this->render("base.html.twig");
    }
}
