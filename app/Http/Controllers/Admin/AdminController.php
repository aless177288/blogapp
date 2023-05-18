<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Asegúrate de importar la clase base de controladores
use Illuminate\Http\Request;

class AdminController extends Controller {
 


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
