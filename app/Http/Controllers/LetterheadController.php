<?php
//app/Http/Controllers/LetterheadController.php
namespace App\Http\Controllers;

use App\Http\Requests\LetterheadRequest;
use App\Services\LetterheadService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LetterheadController extends Controller
{
    public function __construct(
        protected LetterheadService $letterheadService
    ) {}

    public function index(int $id = null)
    {
        $letterhead = $this->letterheadService->getLetterhead($id);
        return Inertia::render('Letterhead', compact('letterhead'));
    }

    public function save(LetterheadRequest $request)
    {
        $letterhead = $this->letterheadService->saveLetterhead($request->all());
        return redirect()->route('letterhead', ['id' => $letterhead->id]);
    }
}
