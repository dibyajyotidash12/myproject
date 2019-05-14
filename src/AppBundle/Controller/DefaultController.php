<?php

namespace AppBundle\Controller;

use AppBundle\Document\activity;
use AppBundle\Document\customer;
use AppBundle\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;



class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        return $this->render('default/index.html.twig',  array('AddNotoficaltion' => ""));
    }
    /**
     * @Route("/createuser", name="createuser")
     */
    public function showAction(Request $request)
    {
        if($request->get('username')&&$request->get('name')&&$request->get('contact')&&$request->get('Password')){
            $user = new User();
            $user->setUsername($request->get('username'));
            $user->setPassword($request->get('Password'));
            $user->setName($request->get('name'));
            $user->setContact($request->get('contact'));

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($user);
            $dm->flush();
            return $this->render('default/index.html.twig',  array('AddNotoficaltion' => "Registration Done"));
        }

        else{
            return $this->render('default/createuser.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            ]);
        }

    }
    /**
     * @Route("/recievelogindata", name="recievelogindata")
     */
    public function recievelogindata(Request $request)
    {   $session = $request->getSession();
        $givenusername=$request->get('Username');
        $givenPassword=$request->get('Password');


        $userobject = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:User')
            ->findOneby([
                'username' => $givenusername
            ]);
        if($userobject!=null&&$userobject->getPassword() == $givenPassword){

            $session->set('current_user', $givenusername);

            $UserObject = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:User')
                ->findOneby(array('username' => $session->get("current_user")));


            $ActivityObject = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:activity')
                ->createQueryBuilder()
                ->field('userId')->equals($UserObject->getId())
                ->field('NextActivityTime')->gte(new \MongoDate())
                ->getQuery()
                ->execute();



            return $this->render('default/dashboard.html.twig', array('ActivityData' => $ActivityObject));
        }
        elseif($session->get("current_user")!=null){
            $UserObject = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:User')
                ->findOneby(array('username' => $session->get("current_user")));

            $ActivityObject = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:activity')
                ->findby(array('userId' => $UserObject->getId()));

            return $this->render('default/dashboard.html.twig', array('ActivityData' => $ActivityObject));
        }
        else{
            return $this->render('default/index.html.twig',  array('AddNotoficaltion' => "Invalid Credential"));
        }


    }
    /**
     * @Route("/AddNewCustomer", name="AddNewCustomer")
     */
    public function AddNewCustomer(Request $request)
    {
        $AddNotoficaltion ="";
        if($request->get('customer_name')&&$request->get('customer_mail')&&$request->get('customer_contact')&&$request->get('customer_address')&&$request->get('customer_status')){
            $CustomerName=$request->get('customer_name');
            $CustomerMail=$request->get('customer_mail');
            $CustomerContact=$request->get('customer_contact');
            $CustomerAddress=$request->get('customer_address');
            $CustomerStatus=$request->get('customer_status');
            $customer = new customer();
            $customer->setName($CustomerName);
            $customer->setMail($CustomerMail);
            $customer->setContact($CustomerContact);
            $customer->setAddress($CustomerAddress);
            $customer->setStatus($CustomerStatus);

            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($customer);
            $dm->flush();
            $AddNotoficaltion="Customer Added";
        }


            return $this->render('default/cutomerform.html.twig', array('AddNotoficaltion' => $AddNotoficaltion));



    }
    /**
     * @Route("/SearchCustomer", name="SearchCustomer")
     */
    public function SearchCustomer(Request $request)
    {

        if($request->get('customer_name')&&$request->get('customer_mail')){
            $CustomerName=$request->get('customer_name');
            $CustomerMail=$request->get('customer_mail');
            $CutomerObject = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:customer')
                ->findOneby(array('Name' => $CustomerName, 'Mail' => $CustomerMail));
            $ExtractionType=1;

        }
        else{
            $CutomerObject = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:customer')
                ->findall();
            $ExtractionType=2;
        }



        return $this->render('default/SearchCustomer.html.twig',array('CutomerData' => $CutomerObject,'ExtractionType'=>$ExtractionType));



    }
    /**
     * @Route("/AddNewActivity", name="AddNewActivity")
     */
    public function AddNewActivity(Request $request)
    {

        $AddNotoficaltion ="";
        $session = $request->getSession();

        if($request->get('customer')&&$request->get('activity_type')&&$request->get('activity_time')&&$request->get('activity_description')){



            $UserObject = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:User')
                ->findOneby(array('username' => $session->get("current_user")));

            $CustomerObject = $this->get('doctrine_mongodb')
                ->getRepository('AppBundle:customer')
                ->findOneby(array('id' => $request->get('customer')));

            $Activity = new activity();
            $Activity->setUserId($UserObject->getId());
            $Activity->setUserName($UserObject->getName());
            $Activity->setCustomerId($request->get('customer'));
            $Activity->setCustomerName($CustomerObject->getName());
            $Activity->setActivityType($request->get('activity_type'));
            $Activity->setTime($request->get('activity_time'));
            $Activity->setDescription($request->get('activity_description'));
            if($request->get('next_activity_description')&&$request->get('next_activity_time')){
                $Activity->setNextActivityDescription($request->get('next_activity_description'));
                $Activity->setNextActivityTime($request->get('next_activity_time'));
            }
            //var_dump($Activity);
            //die();
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($Activity);
            $dm->flush();
            $AddNotoficaltion="New Activity Added";
        }
        $CutomerObject = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:customer')
            ->findall();

        return $this->render('default/activityform.html.twig', array('AddNotoficaltion' => $AddNotoficaltion,'CutomerData'=>$CutomerObject));



    }
    /**
     * @Route("/customerprofile", name="customerprofile")
     */
    public function customerprofile(Request $request)
    {
        $session = $request->getSession();
        $UserObject = $this->get('doctrine_mongodb')
            ->getRepository('AppBundle:User')
            ->findOneby(array('username' => $session->get("current_user")));

        if($request->get('activity_type')){
            $ActivityType=$request->get('activity_type');
            if($ActivityType==1){
                $ActivityObject = $this->get('doctrine_mongodb')
                    ->getRepository('AppBundle:activity')
                    ->createQueryBuilder()
                    ->field('userId')->equals($UserObject->getId())
                    ->field('Time')->lte(new \MongoDate())
                    ->getQuery()
                    ->execute();
            }
            elseif($ActivityType==2){
                $ActivityObject = $this->get('doctrine_mongodb')
                    ->getRepository('AppBundle:activity')
                    ->createQueryBuilder()
                    ->field('userId')->equals($UserObject->getId())
                    ->field('NextActivityTime')->gte(new \MongoDate())
                    ->getQuery()
                    ->execute();


            }

        }
        else{
            $ActivityObject =null;
            $ActivityType=null;
        }



        return $this->render('default/customerprofile.html.twig',array('ActivityData' => $ActivityObject,'ActivityType'=> $ActivityType));



    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        return $this->render('default/index.html.twig',  array('AddNotoficaltion' => ""));
    }
}


