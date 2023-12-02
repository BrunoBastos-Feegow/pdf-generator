<?php

use App\Services\HtmlService;

it('can instantiate HtmlService', function() {
    $htmlService = new HtmlService();
    expect($htmlService)->toBeInstanceOf(HtmlService::class);
});

it('can set html', function() {
    $htmlService = new HtmlService();
    $htmlService->setHtml('<html><body><h1>Teste</h1></body></html>');
    expect($htmlService->getHtml())->toBe('<html><body><h1>Teste</h1></body></html>');
});

it('can get html', function() {
    $htmlService = new HtmlService();
    $htmlService->setHtml('<html><body><h1>Teste</h1></body></html>');
    expect($htmlService->getHtml())->toBe('<html><body><h1>Teste</h1></body></html>');
});

it('can clean up html', function() {
    $htmlService = new HtmlService();
    $htmlService->setHtml('<html><body><h1>Teste</h1></body></html>')->cleanUp();
    expect($htmlService->getHtml())->toBe('<html><body><h1>Teste</h1></body></html>');
});

it('should not replace localhost with host.docker.internal when env is production', function() {
    config(['app.env' => 'production']);
    $html        = '<html><body><a href="http://localhost">localhost</a></body></html>';
    $htmlService = new HtmlService();
    $htmlService->setHtml($html)->cleanUp();
    expect($htmlService->getHtml())->toBe('<html><body><a href="http://localhost">localhost</a></body></html>');
});

it('should replace localhost with host.docker.internal when env is not production', function() {
    $html        = '<html><body><a href="http://localhost">localhost</a></body></html>';
    $htmlService = new HtmlService();
    $htmlService->setHtml($html)->cleanUp();
    expect($htmlService->getHtml())->toBe('<html><body><a href="http://host.docker.internal">localhost</a></body></html>');
});

