<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        $especial = request()->get('especial');

        if($especial) {
            $header = view('especial.test-header')->render();
            $footer = view('especial.test-footer')->render();
            $body   = view('especial.test-body')->render();
            $snappy = app()->make('snappy.pdf');
            $snappy->setOption('header-html', $header);
            $snappy->setOption('footer-html', $footer);
            $snappy->setOption('margin-top', 200);
            $snappy->setOption('margin-bottom', 100);
            $snappy->setOption('margin-left', 10);
            $snappy->setOption('margin-right', 10);
        } else {
            $header = view('test-header')->render();
            $footer = view('test-footer')->render();
            $body   = view('test-body')->render();
            $snappy = app()->make('snappy.pdf');
            $snappy->setOption('header-html', $header);
            $snappy->setOption('footer-html', $footer);
            $snappy->setOption('margin-top', 50);
            $snappy->setOption('margin-bottom', 50);
            $snappy->setOption('margin-left', 10);
            $snappy->setOption('margin-right', 10);
        }

        $snappy->setOption('page-size', 'A4');
        $snappy->setOption('orientation', 'portrait');
        $snappy->setOption('encoding', 'UTF-8');

        return response($snappy->getOutputFromHtml($body), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . now() . '.pdf?"' . now(),
        ]);
    }
}
