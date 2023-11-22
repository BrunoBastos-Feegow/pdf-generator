<?php

namespace App\Services;

use App\Models\Letterhead;
use Illuminate\Contracts\Container\BindingResolutionException;

class SnappyService
{
    private mixed $snappy;
    private bool  $useHeader = false;
    private bool  $useFooter = false;

    /** @throws BindingResolutionException */
    public function __construct()
    {
        define('PIXELS_PER_MM', (96 / 25.4));
        $this->snappy = app()->make('snappy.pdf');
        $this->setDefaultConfig();
    }

    private function cleanUpHtml($html)
    {
        $html = str_replace('http://localhost', 'http://host.docker.internal', $html);
        $html = str_replace('href="//localhost', 'href="http://host.docker.internal', $html);
        $html = str_replace('src="//localhost', 'src="http://host.docker.internal', $html);
        return $html;
    }

    public function basicHtmlToPdf($html)
    {
        $html = $this->cleanUpHtml($html);
        return $this->snappy->getOutputFromHtml($html);
    }

    public function advancedHtmlToPdf(array $letterhead, string $body, string $default, bool $specialControl)
    {
        if($this->useHeader) {
            $letterhead = view($specialControl ? 'specialcontrol.header' : 'default.header', compact('letterhead'))
                ->render();
            $this->snappy->setOption('header-html', $letterhead);
        }

        if($this->useFooter) {
            $footer = view($specialControl ? 'specialcontrol.footer' : 'default.footer', compact('letterhead'))
                ->render();
            $this->snappy->setOption('footer-html', $footer);
        }

        $body = view($specialControl ? 'specialcontrol.body' : 'default.body', compact('body'))
            ->render();
        return $this->snappy->getOutputFromHtml($body);
    }

    public function setDefaultConfig()
    {
        $this->snappy->setOption('dpi', 300);
        $this->snappy->setOption('header-spacing', 3);
        $this->snappy->setOption('footer-spacing', 3);

        $letterhead   = Letterhead::where('sysActive', 1)->first();
        $topMargin    = $letterhead->mTop ? ($letterhead->mTop / PIXELS_PER_MM) : 0;
        $bottomMargin = $letterhead->mBottom ? ($letterhead->mBottom / PIXELS_PER_MM) : 0;
        $leftMargin   = $letterhead->mLeft ? ($letterhead->mLeft / PIXELS_PER_MM) : 0;
        $rightMargin  = $letterhead->mRight ? ($letterhead->mRight / PIXELS_PER_MM) : 0;
        $headerHeight = $letterhead->headerHeight ? ($letterhead->headerHeight / PIXELS_PER_MM) : 0;
        $footerHeight = $letterhead->footerHeight ? ($letterhead->footerHeight / PIXELS_PER_MM) : 0;
        $useHeader    = $letterhead->useHeader ?? false;
        $useFooter    = $letterhead->useFooter ?? false;
        $paperSize    = $letterhead->paperSize ?? 'A4';
        $orientation  = $letterhead->orientation ?? 'portrait';
        $customWidth  = $letterhead->customWidth ? ($letterhead->customWidth / PIXELS_PER_MM) : 210;
        $customHeight = $letterhead->customHeight ? ($letterhead->customHeight / PIXELS_PER_MM) : 297;

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

}
