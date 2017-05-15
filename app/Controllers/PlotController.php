<?php

class PlotController
{
    public function __construct()
    {
        $this->db = new QueryBuilder(Connection::make());
    }

    public function store()
    {
        if (redirectIfNotAuthenticated()) {
            $image = $_POST['image'];
            $this->db->insert('plots', [
                'user_id' => App::get('session')->get('user_id'),
                'image' => $image
            ]);
        }
        return redirect('gallery');
    }

    public function index()
    {
        $plots = Plot::all();

        return view('gallery', compact('plots'));
    }
}