<?php

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
                'user_id' => Session::get('user_id'),
                'image' => $image
            ]);
        }
        return redirect('gallery');
    }
}