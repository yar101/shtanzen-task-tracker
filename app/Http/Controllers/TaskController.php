<?php

namespace App\Http\Controllers;

class TaskController
{
    public function index()
    {
        return view('tasks.index');
    }
}
