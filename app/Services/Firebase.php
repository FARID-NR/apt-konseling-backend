<?php

namespace App\Services;
use Kreait\Firebase\Factory;

class Firebase 
{
    public $firebase;
    public $auth;
    public $firestoreDb;
    public function __construct()
    {
        $this -> firebase = (new Factory) -> withServiceAccount(base_path('firebase.json'));

        $this->auth = $this->firebase->createAuth();

        $firestore = $this->firebase->createFirestore();
        $this->firestoreDb = $firestore->database();
    }
}
