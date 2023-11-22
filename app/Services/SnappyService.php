<?php

namespace App\Services;

use Illuminate\Contracts\Container\BindingResolutionException;

class SnappyService
{
    private mixed $snappy;

    /** @throws BindingResolutionException */
    public function __construct()
    {
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

    public function setDefaultConfig()
    {
        $this->snappy->setOption('encoding', 'UTF-8');
        $this->snappy->setOption('dpi', 300);
        $this->snappy->setOption('header-spacing', 3);
        $this->snappy->setOption('footer-spacing', 3);
        return $this;
    }

    public function setHeader($header)
    {
        $this->snappy->setOption('header-html', $header);
        return $this;
    }

    public function setFooter($footer)
    {
        $this->snappy->setOption('footer-html', $footer);
        return $this;
    }

    public function setMargins($top, $bottom, $left, $right)
    {
        $this->snappy->setOption('margin-top', $top);
        $this->snappy->setOption('margin-bottom', $bottom);
        $this->snappy->setOption('margin-left', $left);
        $this->snappy->setOption('margin-right', $right);
        return $this;
    }

    public function setPageSize($size)
    {
        $this->snappy->setOption('page-size', $size);
        return $this;
    }

    public function setOrientation($orientation)
    {
        $this->snappy->setOption('orientation', $orientation);
        return $this;
    }

    public function setCustomPageSize($width, $height)
    {
        $this->snappy->setOption('page-width', $width);
        $this->snappy->setOption('page-height', $height);
        return $this;
    }

    public function setHeaderSpacing($spacing)
    {
        $this->snappy->setOption('header-spacing', $spacing);
        return $this;
    }

    public function setFooterSpacing($spacing)
    {
        $this->snappy->setOption('footer-spacing', $spacing);
        return $this;
    }

    public function setEncoding($encoding)
    {
        $this->snappy->setOption('encoding', $encoding);
        return $this;
    }

    public function setDpi($dpi)
    {
        $this->snappy->setOption('dpi', $dpi);
        return $this;
    }

    public function setZoom($zoom)
    {
        $this->snappy->setOption('zoom', $zoom);
        return $this;
    }


}
