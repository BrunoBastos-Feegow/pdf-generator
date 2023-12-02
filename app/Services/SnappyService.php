<?php

namespace App\Services;

use App\Exceptions\SnappyServiceException;
use Barryvdh\Snappy\PdfWrapper;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;

class SnappyService
{
    /** @var PdfWrapper */
    private mixed $snappy;

    private HtmlService $htmlService;

    /** @throws BindingResolutionException */
    public function __construct()
    {
        define('PIXELS_PER_MM', (96 / 25.4));
        $this->htmlService = app()->make(HtmlService::class);
        $this->snappy      = app()->make('snappy.pdf');
        $this->snappy->setOptions([
            'encoding'                 => 'UTF-8',
            'enable-local-file-access' => true,
            'images'                   => true,
            'enable-javascript'        => true,
            'javascript-delay'         => 1000,
            'no-stop-slow-scripts'     => true,
            'enable-smart-shrinking'   => true,
            'no-background'            => false,
            'lowquality'               => false,
            'dpi'                      => 300,
            'header-spacing'           => 3,
            'footer-spacing'           => 3,
        ]);
    }

    public function setConfigsFromLetterhead(array $letterhead): SnappyService
    {
        if(empty($letterhead))
            return $this;

        $letterhead   = collect($letterhead);
        $topMargin    = $letterhead->get('mTop') ? ($letterhead->get('mTop') / PIXELS_PER_MM) : 0;
        $bottomMargin = $letterhead->get('mBottom') ? ($letterhead->get('mBottom') / PIXELS_PER_MM) : 0;
        $leftMargin   = $letterhead->get('mLeft') ? ($letterhead->get('mLeft') / PIXELS_PER_MM) : 0;
        $rightMargin  = $letterhead->get('mRight') ? ($letterhead->get('mRight') / PIXELS_PER_MM) : 0;

        /**
         * @TODO: implement missing configs within the letterhead configs
         * headerHeight, footerHeight, useHeader, useFooter, paperSize, orientation, customWidth, customHeight
         */
        $headerHeight = $letterhead->get('headerHeight') ? ($letterhead->get('headerHeight') / PIXELS_PER_MM) : 45;
        $footerHeight = $letterhead->get('footerHeight') ? ($letterhead->get('footerHeight') / PIXELS_PER_MM) : 90;

        $useHeader = $letterhead->get('useHeader') ?? false;
        $useFooter = $letterhead->get('useFooter') ?? false;

        $paperSize    = $letterhead->get('paperSize') ?? 'A4';
        $orientation  = $letterhead->get('orientation') ?? 'portrait';
        $customWidth  = $letterhead->get('customWidth') ?? 210;
        $customHeight = $letterhead->get('customHeight') ?? 297;

        $this->useHeader = $useHeader;
        $this->useFooter = $useFooter;

        $this->snappy->setOption('margin-top', $topMargin + $headerHeight);
        $this->snappy->setOption('margin-bottom', $bottomMargin + $footerHeight);
        $this->snappy->setOption('margin-left', $leftMargin);
        $this->snappy->setOption('margin-right', $rightMargin);
        if($paperSize == 'custom') {
            $this->snappy->setOption('page-width', $customWidth);
            $this->snappy->setOption('page-height', $customHeight);
        } else {
            $this->snappy->setOption('page-size', $paperSize);
        }
        $this->snappy->setOption('orientation', $orientation);
        return $this;
    }

    public function basicHtmlToPdf($html)
    {
        $this->snappy->setOption('margin-top', 0);
        $this->snappy->setOption('margin-bottom', 0);
        $this->snappy->setOption('margin-left', 0);
        $this->snappy->setOption('margin-right', 0);
        return $this->snappy->getOutputFromHtml($html);
    }

    public function getReportPdf(Request $request)
    {
        try {
            $this->setConfigsFromLetterhead($request->letterhead);

            $viewName = $this->getViewName($request->report);
            $header   = view("{$viewName}-header", $request->all())->render();
            $body     = view("{$viewName}-body", $request->all())->render();
            $footer   = view("{$viewName}-footer", $request->all())->render();

            $header = $this->htmlService->setHtml($header)
                ->cleanUp()
                ->getHtml();

            $body = $this->htmlService->setHtml($body)
                ->cleanUp()
                ->getHtml();

            $footer = $this->htmlService->setHtml($footer)
                ->cleanUp()
                ->getHtml();

            $this->snappy->setOption('header-html', $header);
            $this->snappy->setOption('footer-html', $footer);
            return $this->snappy->getOutputFromHtml($body);
        } catch(\Exception $e) {
            throw new SnappyServiceException($e->getMessage());
        }
    }


    private function getViewName(string $reportName): string
    {
        return match ($reportName) {
            'patientinterface::render-medical-report' => 'snappy.report',
            'patientinterface::render-medical-report-controle-especial' => 'snappy.especial',
            'patientinterface::render-medical-report-protocol' => 'snappy.protocolo',
            'patientinterface::render-atendimento-report' => 'snappy.atendimento',
            default => '',
        };
    }

}
