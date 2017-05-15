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
            if (method_exists($this, $matlabFile)) {
                return $this->$matlabFile($_POST);
            }
        }
        App::get('session')->flash('errors', ['Доступно только авторизованным пользователям.']);
        return redirect('login');
    }

    private function graf1($data)
    {
        extract($data);
        $image = 'plots/' . str_rand() . '.png';
        if (($radius > 0) && ($period > 0) && ($index > 0) && ($radius < 8) && ($period < 8) && ($period > 2 * $radius)) {
            $command = "matlab -r graf1(" . "'$image'," . "$radius,$period,$index)";
            exec($command);
            (new Plot)->create([
                'user_id' => App::get('session')->get('user_id'),
                'image' => $image,
                'radius' => $radius,
                'period' => $period,
                'refrIndex' => $index
            ]);
            return redirect('gallery');
        }
        App::get('session')->flash('errors',['Все параметры должны быть положительными, радиус и период < 8, период больше двух радиусов']);
        return redirect('work');
    }
}