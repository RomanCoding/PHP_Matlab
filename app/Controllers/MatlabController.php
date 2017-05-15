<?php

namespace App\Controllers;


use App\Models\Plot;
use Core\App;

class MatlabController
{
    public function index()
    {
        return view('matlab');
    }

    public function execute()
    {
        if (redirectIfNotAuthenticated()) {
            $matlabFile = $_POST['matlabFile'];
            $image = 'plots/' . str_rand() . '.png';;
            $command = "matlab -r $matlabFile(" . "'$image')";
            exec($command);
            (new Plot)->create([
                'user_id' => App::get('session')->get('user_id'),
                'image' => $image
            ]);
            return redirect('gallery');
        }
        App::get('session')->flash('errors', ['Доступно только авторизованным пользователям.']);
        return redirect('login');
    }
}