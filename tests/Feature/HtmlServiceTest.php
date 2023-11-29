<?php

//
//
//namespace App\Services;
//
//class HtmlService
//{
//    /**
//     * @var string
//     */
//    private string $env;
//
//    /**
//     * HtmlService constructor.
//     * @param string $html
//     */
//    public function __construct(
//        public string $html
//    ) {
//        $this->env = config('app.env');
//    }
//
//    /**
//     * @param string $html
//     * @return HtmlService
//     */
//    public function setHtml(string $html): HtmlService
//    {
//        $this->html = $html;
//        return $this;
//    }
//
//    /**
//     * @return string
//     */
//    public function getHtml(): string
//    {
//        return $this->html;
//    }
//
//    /**
//     * @param $html
//     * @return HtmlService
//     */
//    public function cleanUp($html): HtmlService
//    {
//        $this->replaceLocalhost($html);
//        return $this;
//    }
//
//    /**
//     * @param $html
//     * @return array|string|string[]
//     */
//    public function replaceLocalhost($html): HtmlService
//    {
//        if ($this->env === 'production')
//            return $this;
//        $this->html = preg_replace('/http:\/\/localhost/', 'http://host.docker.internal', $html);
//        $this->html = preg_replace('/href="\/\/localhost/', 'href="http://host.docker.internal', $this->html);
//        $this->html = preg_replace('/src="\/\/localhost/', 'src="http://host.docker.internal', $this->html);
//        return $this;
//    }
//}

it('can instantiate HtmlService', function () {
    $htmlService = new \App\Services\HtmlService('');
    expect($htmlService)->toBeInstanceOf(\App\Services\HtmlService::class);
});

it('can set html', function () {
    $htmlService = new \App\Services\HtmlService('');
    $htmlService->setHtml('<html><body><h1>Teste</h1></body></html>');
    expect($htmlService->getHtml())->toBe('<html><body><h1>Teste</h1></body></html>');
});

it('can get html', function () {
    $htmlService = new \App\Services\HtmlService('');
    $htmlService->setHtml('<html><body><h1>Teste</h1></body></html>');
    expect($htmlService->getHtml())->toBe('<html><body><h1>Teste</h1></body></html>');
});

it('can clean up html', function () {
    $htmlService = new \App\Services\HtmlService('');
    $htmlService->setHtml('<html><body><h1>Teste</h1></body></html>');
    $htmlService->cleanUp($htmlService->getHtml());
    expect($htmlService->getHtml())->toBe('<html><body><h1>Teste</h1></body></html>');
});

it('should not replace localhost with host.docker.internal when env is production', function () {
    config(['app.env' => 'production']);
    $html = '<html><body><a href="http://localhost">localhost</a></body></html>';
    $htmlService = new \App\Services\HtmlService($html);
    $htmlService->cleanUp($html);
    expect($htmlService->getHtml())->toBe('<html><body><a href="http://localhost">localhost</a></body></html>');
});

it('should replace localhost with host.docker.internal when env is not production', function () {
    $html = '<html><body><a href="http://localhost">localhost</a></body></html>';
    $htmlService = new \App\Services\HtmlService($html);
    $htmlService->cleanUp($html);
    expect($htmlService->getHtml())->toBe('<html><body><a href="http://host.docker.internal">localhost</a></body></html>');
});
