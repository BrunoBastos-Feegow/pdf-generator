<?php

namespace App\Http\Controllers;

use App\Services\SnappyService;
use Illuminate\Http\Request;

/**
 * Class SnappyController
 * @package App\Http\Controllers
 *
 * @group PDF generation
 */
class SnappyController extends Controller
{
    public function __construct(
        private SnappyService $snappyService
    ) {}

    /**
     * Basic PDF generation
     *
     * Generate PDFs from HTML
     *
     * @bodyParam html string required The HTML to be converted to PDF. Example: <html><body><h1>Teste</h1></body></html>
     *
     * @response 200 scenario="Success" {
     * "Content-Type": "application/pdf",
     * "Content-Disposition": "inline; filename="2021-09-28 14:09:00.pdf"",
     * "Cache-Control": "no-cache, no-store, max-age=0, must-revalidate"
     * }
     *
     * @response 422 scenario="Validation error"
     *  {
     *      "message": "The given data was invalid.",
     *      "errors": {
     *          "html": [
     *              "O campo html é obrigatório."
     *          ]
     *      }
     *  }
     *
     * @response 500 scenario="Internal server error"
     *  {
     *      "message": "Internal server error"
     *  }
     */
    public function basic(Request $request)
    {
        $request->validate([
            'html' => 'required',
        ], [
            'html.required' => 'O campo html é obrigatório.',
        ]);

        $snappy = app()->make('snappy.pdf');
        $html = $request->html;
        $body   = view('snappy.raw-html', compact('html'))->render();
        return response($snappy->getOutputFromHtml($body), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename = "' . now() . '.pdf"',
            'Cache-Control'       => 'no-cache, no-store, max-age = 0, must-revalidate',
        ]);

//        $pdf = $this->snappyService->basicHtmlToPdf($request->html);
//        return response($pdf, 200, [
//            'Content-Type'        => 'application/pdf',
//            'Content-Disposition' => 'inline; filename="' . now() . '.pdf"',
//            'Cache-Control'       => 'no-cache, no-store, max-age=0, must-revalidate',
//        ]);
    }

    /**
     * Advanced PDF generation
     *
     * Generate PDFs from HTML with header and footer repeating them in every page
     *
     * @bodyParam settings object required The settings for the PDF generation. Example: {"useHeader": true, "useFooter": true, "paperSize": "A4", "orientation": "portrait"}
     * @bodyParam settings.useHeader boolean  Whether to use header or not. Example: true
     * @bodyParam settings.useFooter boolean  Whether to use footer or not. Example: true
     * @bodyParam settings.paperSize string  The paper size. Example: A4
     * @bodyParam settings.orientation string  The orientation. Example: portrait
     *
     * @bodyParam header string required The HTML for the header. Example: <html><body><h1>Header</h1></body></html>
     * @bodyParam body string required The HTML for the body. Example: <html><body><h1>Body</h1></body></html>
     * @bodyParam footer string required The HTML for the footer. Example: <html><body><h1>Footer</h1></body></html>
     *
     * @response 200 scenario="Success" {
     * "Content-Type": "application/pdf",
     * "Content-Disposition": "inline; filename="2021-09-28 14:09:00.pdf"",
     * "Cache-Control": "no-cache, no-store, max-age=0, must-revalidate"
     * }
     *
     * @response 422 scenario="Validation error"
     *  {
     *      "message": "The given data was invalid.",
     *      "errors": {
     *          "settings": [
     *              "O campo settings é obrigatório."
     *          ],
     *          "header": [
     *              "O campo header é obrigatório."
     *          ],
     *          "body": [
     *              "O campo body é obrigatório."
     *          ],
     *          "footer": [
     *              "O campo footer é obrigatório."
     *          ]
     *     }
     * }
     *
     * @response 500 scenario="Internal server error"
     * {
     *     "message": "Internal server error"
     * }
     *
     */
    public function advanced(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'header'   => 'required',
            'body'     => 'required',
            'footer'   => 'required',
        ], [
            'settings.required' => 'O campo settings é obrigatório.',
            'settings.array'    => 'O campo settings deve ser um array.',
            'header.required'   => 'O campo header é obrigatório.',
            'body.required'     => 'O campo body é obrigatório.',
            'footer.required'   => 'O campo footer é obrigatório.',
        ]);

        $pdf = $this->snappyService->advancedHtmlToPdf(
            $request->letterhead,
            $request->body,
            $request->default,
            $request->specialControl,
            $request->isSpecialControl ?? false
        );

        return response($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . now() . '.pdf"',
            'Cache-Control'       => 'no-cache, no-store, max-age=0, must-revalidate',
        ]);
    }

    public function testFixedContent()
    {
        //define a conversion rate from mm to pixels
//        define('PIXELS_PER_MM', (96 / 25.4));
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
        } else {
            $header = view('snappy.default-header', compact('configs'))->render();
            $footer = view('snappy.default-footer', compact('configs'))->render();
            $body   = view('snappy.default-body', compact('configs'))->render();
        }
        $snappy = app()->make('snappy.pdf');
        if($useHeader)
            $snappy->setOption('header-html', $header);
        if($useFooter)
            $snappy->setOption('footer-html', $footer);
        $snappy->setOption('margin-top', $topMargin + $headerHeight);
        $snappy->setOption('margin-bottom', $bottomMargin + $footerHeight);
        $snappy->setOption('margin-left', $leftMargin);
        $snappy->setOption('margin-right', $rightMargin);

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
            'Content-Disposition' => 'inline; filename = "' . now() . '.pdf"',
            'Cache-Control'       => 'no-cache, no-store, max-age = 0, must-revalidate',
        ]);
    }
}
