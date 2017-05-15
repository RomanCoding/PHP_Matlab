<?php

namespace App\Controllers;

use App\Models\Plot;
use Core\App;

class PlotController
{
    public function __construct()
    {
        $this->db = App::get('db');
    }

    public function index()
    {
        $plots = Plot::all();

        return view('gallery', compact('plots'));
    }
}