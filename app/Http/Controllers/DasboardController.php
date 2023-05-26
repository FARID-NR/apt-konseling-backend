<?php

namespace App\Http\Controllers;

use App\Services\Firebase;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    protected $firestore;
    public $auth;

    public function __construct()
    {
        $this->firestore = (new Firebase)->firestoreDb;
        $this->auth = (new Firebase)->auth;
        $this->middleware('auth');
    }

    public function dashboard(Request $request)
    {
        $collectionUsers = $this->firestore->collection('users');
        $documentUsers = $collectionUsers->documents();

        $dataUsers = [];
        $patientCount = 0;
        $doctorCount = 0;
        $statusFalse = 0;
        $statusTrue = 0;

        foreach ($documentUsers as $document) {
            $userData = $document->data();

            // Retrieve the values of email, fullname, and photo fields
            $email = $userData['email'] ?? null;
            $lastTime = $userData['lastTime'] ?? null;
            $fullName = $userData['fullName'] ?? null;
            $photo = $userData['photo'] ?? null;
            $userType = $userData['type'] ?? null;
            $status = $userData['status'] ?? null;
            $createAt = $userData['createAt'] ?? null;

            $dataUsers[] = [
                'email' => $email,
                'lastTime' => $lastTime,
                'fullName' => $fullName,
                'photo' => $photo,
                'type' => $userType,
                'status' => $status,
                'createAt' => $createAt,
            ];

            if ($userType === 'patient') {
                $patientCount++;
            } elseif ($userType === 'doctor') {
                $doctorCount++;
            }

            if ($status === true) {
                $statusTrue++;
            } else {
                $statusFalse++;
            }
        }

        return view('pages.dashboard.index', compact('dataUsers', 'patientCount', 'doctorCount', 'statusFalse', 'statusTrue'));
    }
}
