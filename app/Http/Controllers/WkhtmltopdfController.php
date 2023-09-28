<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WkhtmltopdfController extends Controller
{
    public function __invoke()
    {
        $especial = request()->get('special');

        if($especial) {
            $header = view('wkhtmltopdf.special-header')->render();
            $footer = view('wkhtmltopdf.special-footer')->render();
            $body   = view('wkhtmltopdf.special-body')->render();
            $snappy = app()->make('snappy.pdf');
            $snappy->setOption('header-html', $header);
            $snappy->setOption('footer-html', $footer);
            $snappy->setOption('margin-top', 120);
            $snappy->setOption('margin-bottom', 95);
            $snappy->setOption('margin-left', 10);
            $snappy->setOption('margin-right', 10);
        } else {
            $header = view('wkhtmltopdf.default-header')->render();
            $footer = view('wkhtmltopdf.default-footer')->render();
            $body   = view('wkhtmltopdf.default-body')->render();
            $snappy = app()->make('snappy.pdf');
            $snappy->setOption('header-html', $header);
            $snappy->setOption('footer-html', $footer);
            $snappy->setOption('margin-top', 45);
            $snappy->setOption('margin-bottom', 55);
            $snappy->setOption('margin-left', 10);
            $snappy->setOption('margin-right', 10);
        }

        $snappy->setOption('header-spacing', 3);
        $snappy->setOption('footer-spacing', 3);
        $snappy->setOption('page-size', 'A4');
        $snappy->setOption('orientation', 'portrait');
        $snappy->setOption('encoding', 'UTF-8');
        $snappy->setOption('dpi', 300);

        return response($snappy->getOutputFromHtml($body), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . now() . '.pdf"',
            'Cache-Control'       => 'no-cache, no-store, max-age=0, must-revalidate',
        ]);
    }
}
