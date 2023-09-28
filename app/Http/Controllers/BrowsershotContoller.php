<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

class BrowsershotContoller extends Controller
{
    public function __invoke()
    {
        try {
            $header = view('test-header')->render();
            $footer = view('test-footer')->render();
            $body   = view('test-body')->render();

            $pdf = Browsershot::html($body)
                ->setChromePath('/usr/bin/chromium')
                ->showBrowserHeaderAndFooter()
                ->headerHtml($header)
                ->footerHtml($footer)
                ->margins(8, 5, 5, 5)
                ->paperSize(210, 297, 'mm')
//                ->landscape()
                ->noSandbox()
                ->waitUntilNetworkIdle()
                ->pdf();

            return response($pdf, 200, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . now() . '.pdf"',
                'Cache-Control'       => 'no-cache, no-store, max-age=0, must-revalidate',
            ]);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
}
