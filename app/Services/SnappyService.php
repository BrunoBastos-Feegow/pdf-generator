<?php

namespace App\Services;

use App\Models\Letterhead;
use Illuminate\Contracts\Container\BindingResolutionException;

class SnappyService
{
    private mixed $snappy;
    private HtmlService $htmlService;
    private bool $useHeader = false;
    private bool $useFooter = false;

    /** @throws BindingResolutionException */
    public function __construct()
    {
        define('PIXELS_PER_MM', (96 / 25.4));
        $this->htmlService = app()->make(HtmlService::class);
        $this->snappy = app()->make('snappy.pdf');
        $this->snappy->setOption('encoding', 'UTF-8');
        $this->setDefaultConfig();
    }

    public function basicHtmlToPdf($html)
    {
        $html = $this->htmlService->cleanUp($html);
        return $this->snappy->getOutputFromHtml($html);
    }

    public function advancedHtmlToPdf(array $letterhead, string $body, string $default, array $specialControl, bool $isSpecialControl)
    {
        if($this->useHeader) {
            $header = view($isSpecialControl ? 'specialcontrol.header' : 'default.header', compact('letterhead'))
                ->render();
            $this->snappy->setOption('header-html', $header);
        }

        if($this->useFooter) {
            $footer = view($isSpecialControl ? 'specialcontrol.footer' : 'default.footer', compact('letterhead'))
                ->render();
            $this->snappy->setOption('footer-html', $footer);
        }

        $content = view($isSpecialControl ? 'specialcontrol.body' : 'default.body', compact('letterhead', 'body', 'default', 'specialControl'))
            ->render();

        return $this->snappy->getOutputFromHtml($content);
    }

    public function setDefaultConfig()
    {
        $this->snappy->setOption('dpi', 300);
        $this->snappy->setOption('header-spacing', 3);
        $this->snappy->setOption('footer-spacing', 3);

//        $letterhead   = null;//Letterhead::where('sysActive', 1)->first();
//        $topMargin    = isset($letterhead) && $letterhead->mTop ? ($letterhead->mTop / PIXELS_PER_MM) : 0;
//        $bottomMargin = isset($letterhead) && $letterhead->mBottom ? ($letterhead->mBottom / PIXELS_PER_MM) : 0;
//        $leftMargin   = isset($letterhead) && $letterhead->mLeft ? ($letterhead->mLeft / PIXELS_PER_MM) : 0;
//        $rightMargin  = isset($letterhead) && $letterhead->mRight ? ($letterhead->mRight / PIXELS_PER_MM) : 0;
//        $headerHeight = isset($letterhead) && $letterhead->headerHeight ? ($letterhead->headerHeight / PIXELS_PER_MM) : 0;
//        $footerHeight = isset($letterhead) && $letterhead->footerHeight ? ($letterhead->footerHeight / PIXELS_PER_MM) : 0;
//        $useHeader    = isset($letterhead) && $letterhead->useHeader ?? false;
//        $useFooter    = isset($letterhead) && $letterhead->useFooter ?? false;
//        $paperSize    = isset($letterhead) && $letterhead->paperSize ?? 'A4';
//        $orientation  = isset($letterhead) && $letterhead->orientation ?? 'portrait';
//        $customWidth  = isset($letterhead) && $letterhead->customWidth ? ($letterhead->customWidth / PIXELS_PER_MM) : 210;
//        $customHeight = isset($letterhead) && $letterhead->customHeight ? ($letterhead->customHeight / PIXELS_PER_MM) : 297;
//
//        $this->useHeader = $useHeader;
//        $this->useFooter = $useFooter;
//        $this->snappy->setOption('margin-top', $topMargin + $headerHeight);
//        $this->snappy->setOption('margin-bottom', $bottomMargin + $footerHeight);
//        $this->snappy->setOption('margin-left', $leftMargin);
//        $this->snappy->setOption('margin-right', $rightMargin);
//        if($paperSize == 'custom') {
//            $this->snappy->setOption('page-width', $customWidth);
//            $this->snappy->setOption('page-height', $customHeight);
//        } else {
//            $this->snappy->setOption('page-size', $paperSize);
//        }
//        $this->snappy->setOption('orientation', $orientation);
        return $this;
    }

}
