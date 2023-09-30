<?php
//app/Http/Controllers/LetterheadController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LetterheadController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Letterhead');
    }
}
