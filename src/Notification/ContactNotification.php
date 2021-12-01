<?php
 namespace App\Notification;

 use App\Entity\Contact;
 use Monolog\Handler\SwiftMailerHandler;
 use Twig\Environment;

 class ContactNotification
 {


     public function notify(Contact $contact)
     {

     }
 }