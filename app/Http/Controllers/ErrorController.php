<?php
// In app/Http/Controllers/ErrorController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function adminError()
    {
        return view('errors.admin');
    }
}
