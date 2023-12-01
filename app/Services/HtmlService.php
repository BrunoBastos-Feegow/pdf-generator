<?php

namespace App\Services;

class HtmlService
{
    /**
     * @var string
     */
    private string $env;
    /**
     * @var string
     */
    private string $html;

    /**
     * HtmlService constructor.
     * @param string $html
     */
    public function __construct(
    ) {
        $this->env = config('app.env');
    }

    /**
     * @param string $html
     * @return HtmlService
     */
    public function setHtml(string $html): HtmlService
    {
        $this->html = $html;
        return $this;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param $html
     * @return HtmlService
     */
    public function cleanUp(): HtmlService
    {
        $this->replaceLocalhost($this->html);
        return $this;
    }

    /**
     * @param $html
     * @return array|string|string[]
     */
    public function replaceLocalhost($html): HtmlService
    {
        if ($this->env === 'production')
            return $this;
        $this->html = preg_replace('/http:\/\/localhost/', 'http://host.docker.internal', $html);
        $this->html = preg_replace('/href="\/\/localhost/', 'href="http://host.docker.internal', $this->html);
        $this->html = preg_replace('/src="\/\/localhost/', 'src="http://host.docker.internal', $this->html);
        return $this;
    }
}
