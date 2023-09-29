<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class PhpwordController extends Controller
{
    public function __invoke()
    {
        $special = request()->get('special');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        if ($special) {
            $header = view('phpword.special-header')->render();
            $footer = view('phpword.special-footer')->render();
            $body = view('phpword.special-body')->render();
        } else {
            $header = view('phpword.default-header')->render();
            $footer = view('phpword.default-footer')->render();
            $body = view('phpword.default-body')->render();
        }

        // Combine header, body, and footer
        $htmlContent = $header . $body . $footer;

        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $htmlContent);

        // Save to a temporary file
        $file = tempnam(sys_get_temp_dir(), 'phpword_') . '.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($file);

        return response()->download($file)->deleteFileAfterSend(true);
    }
}
