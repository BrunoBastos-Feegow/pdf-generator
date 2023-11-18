<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SnappyController extends Controller
{
    public function __invoke()
    {
        //define a conversion rate from mm to pixels
        define('PIXELS_PER_MM', (96 / 25.4));
        $configs      = session()->get('configs');
        $topMargin    = ($configs['topMargin'] ?? 20) / PIXELS_PER_MM;
        $bottomMargin = ($configs['bottomMargin'] ?? 20) / PIXELS_PER_MM;
        $leftMargin   = ($configs['leftMargin'] ?? 20) / PIXELS_PER_MM;
        $rightMargin  = ($configs['rightMargin'] ?? 20) / PIXELS_PER_MM;
        $headerHeight = ($configs['headerHeight'] ?? 50) / PIXELS_PER_MM;
        $footerHeight = ($configs['footerHeight'] ?? 50) / PIXELS_PER_MM;
        $useHeader    = $configs['useHeader'] ?? false;
        $useFooter    = $configs['useFooter'] ?? false;
        $paperSize    = $configs['paperSize'] ?? 'A4';
        $orientation  = $configs['orientation'] ?? 'portrait';
        $customWidth  = ($configs['customWidth'] ?? 210) / PIXELS_PER_MM;
        $customHeight = ($configs['customHeight'] ?? 297) / PIXELS_PER_MM;

//        dd($configs);

        $especial = request()->get('special');

        if($especial) {
            $header = view('snappy.special-header', compact('configs'))->render();
            $footer = view('snappy.special-footer', compact('configs'))->render();
            $body   = view('snappy.special-body', compact('configs'))->render();
            $snappy = app()->make('snappy.pdf');
            if($useHeader)
                $snappy->setOption('header-html', $header);
            if($useFooter)
                $snappy->setOption('footer-html', $footer);
            $snappy->setOption('margin-top', $topMargin + $headerHeight);
            $snappy->setOption('margin-bottom', $bottomMargin + $footerHeight);
            $snappy->setOption('margin-left', $leftMargin);
            $snappy->setOption('margin-right', $rightMargin);
        } else {
            $header = view('snappy.default-header', compact('configs'))->render();
            $footer = view('snappy.default-footer', compact('configs'))->render();
            $body   = view('snappy.default-body', compact('configs'))->render();
            $snappy = app()->make('snappy.pdf');
            if($useHeader)
                $snappy->setOption('header-html', $header);
            if($useFooter)
                $snappy->setOption('footer-html', $footer);
            $snappy->setOption('margin-top', $topMargin + $headerHeight);
            $snappy->setOption('margin-bottom', $bottomMargin + $footerHeight);
            $snappy->setOption('margin-left', $leftMargin);
            $snappy->setOption('margin-right', $rightMargin);
        }

        $snappy->setOption('header-spacing', 3);
        $snappy->setOption('footer-spacing', 3);

        if($paperSize == 'custom') {
            $snappy->setOption('page-width', $customWidth);
            $snappy->setOption('page-height', $customHeight);
        } else {
            $snappy->setOption('page-size', $paperSize);
        }

        $snappy->setOption('orientation', $orientation);
        $snappy->setOption('encoding', 'UTF-8');
        $snappy->setOption('dpi', 300);

        return response($snappy->getOutputFromHtml($body), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . now() . '.pdf"',
            'Cache-Control'       => 'no-cache, no-store, max-age=0, must-revalidate',
        ]);
    }
}
