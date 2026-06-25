<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Image;

class StaticController extends Controller
{

    public function index(){
        return view('index');
    }
    public function societes(Company $company, Image $image)
    {
        $companies = $company->all();
        $images = $image->all();

        return view('societes', compact('companies', 'images'));
    }

    




    public function guide_rapport(){
        return view('guide_rapport');

    }
    public function a_propos(){
        return view('a_propos');

    }

}
