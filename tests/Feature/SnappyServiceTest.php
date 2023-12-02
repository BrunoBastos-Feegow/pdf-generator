<?php

use App\Exceptions\SnappyServiceException;
use App\Services\HtmlService;
use App\Services\SnappyService;
use Barryvdh\Snappy\PdfWrapper;
use Illuminate\Http\Request;

it('can instantiate the SnappyService', function() {
    $pdfWrapper = app(PdfWrapper::class);
    $htmlService = app(HtmlService::class);
    $snappyService = new SnappyService($pdfWrapper, $htmlService);
    expect($snappyService)->toBeInstanceOf(SnappyService::class);
});

it('can set configs from letterhead', function() {
    $pdfWrapper = app(PdfWrapper::class);
    $htmlService = app(HtmlService::class);
    $snappyService = new SnappyService($pdfWrapper, $htmlService);

    $mTop         = 10;
    $mBottom      = 10;
    $mLeft        = 10;
    $mRight       = 10;
    $headerHeight = 50;
    $footerHeight = 50;

    $letterhead = [
        'mTop'         => $mTop,
        'mBottom'      => $mBottom,
        'mLeft'        => $mLeft,
        'mRight'       => $mRight,
        'headerHeight' => $headerHeight,
        'footerHeight' => $footerHeight,
        'useHeader'    => true,
        'useFooter'    => true,
        'paperSize'    => 'A4',
        'orientation'  => 'portrait',
        'customWidth'  => 210,
        'customHeight' => 297,
    ];
    $snappyService->setConfigsFromLetterhead($letterhead);
    $pxPerMm = $snappyService->getPixesPerMm();
    $options = $snappyService->snappy->getOptions();
    expect($snappyService->useHeader)->toBeTrue()
        ->and($snappyService->useFooter)->toBeTrue()
        ->and($options['margin-top'])->toBe(($mTop / $pxPerMm) + ($headerHeight / $pxPerMm))
        ->and($options['margin-bottom'])->toBe(($mBottom / $pxPerMm) + ($footerHeight / $pxPerMm));
});

it('can get the pixels per mm', function() {
    $pdfWrapper = app(PdfWrapper::class);
    $htmlService = app(HtmlService::class);
    $snappyService = new SnappyService($pdfWrapper, $htmlService);

    $pxPerMm       = $snappyService->getPixesPerMm();
    expect($pxPerMm)
        ->not()->toBeEmpty()
        ->and($pxPerMm)->not()->toBeNull()
        ->and($pxPerMm)->not()->toBeString()
        ->and($pxPerMm)->not()->toBe(0);;
});

it('can get the dynamic report pdf', function() {

    $fakePdfFile = \Illuminate\Http\UploadedFile::fake()->create('test.pdf')->store('pdfs');

    $mockedPdfWrapper = Mockery::mock(PdfWrapper::class)->makePartial();
    $mockedPdfWrapper->shouldReceive('setOptions','setOption')->andReturnSelf();
    $mockedPdfWrapper->shouldReceive('getOutputFromHtml')->andReturn($fakePdfFile);

//    $mockedHtmlService = Mockery::mock(HtmlService::class);
    // Configure o mock de HtmlService conforme necessário

    $snappyService = new SnappyService($mockedPdfWrapper, new HtmlService());

    // Substitua a instância de SnappyService no container do Laravel
    $this->app->instance(SnappyService::class, $snappyService);

    $body = [
        'report'     => 'patientinterface::render-medical-report',
        'letterhead' => [
            'mTop'         => 10,
            'mBottom'      => 10,
            'mLeft'        => 10,
            'mRight'       => 10,
            'headerHeight' => 50,
            'footerHeight' => 50,
            'useHeader'    => true,
            'useFooter'    => true,
            'paperSize'    => 'A4',
            'orientation'  => 'portrait',
            'customWidth'  => 210,
            'customHeight' => 297,
        ],
        'body'       => '<h1>Teste</h1>',
        'default'    => 'Teste'
    ];

    $response = $this->post(route('snappy.dynamic-report'), $body);

    expect($response->getStatusCode())->toBe(200)
        ->and($response->getContent())->toBe($fakePdfFile);
});

it('can get the basic pdf', function() {

    $fakePdfFile = \Illuminate\Http\UploadedFile::fake()->create('test.pdf')->store('pdfs');

    $this->mock(App\Services\SnappyService::class, function($mock) use ($fakePdfFile) {
        $mock->shouldAllowMockingProtectedMethods()
            ->shouldReceive('basicHtmlToPdf')
            ->once()
            ->andReturn($fakePdfFile);
    });

    $body = [
        'html' => '<h1>Teste</h1>',
    ];

    $response = $this->post(route('snappy.basic'), $body);

    expect($response->getStatusCode())->toBe(200)
        ->and($response->getContent())->toBe($fakePdfFile);
});


it('throws SnappyServiceException when report generation fails', function() {
    // Criar uma Request de teste com dados específicos
    $request = new Illuminate\Http\Request([
        'letterhead' => [],
        'report' => 'invalid_report'
    ]);

//    // Instanciar o SnappyService
    $pdfWrapper = app(PdfWrapper::class);
    $htmlService = app(HtmlService::class);

    $this->partialMock(App\Services\SnappyService::class, function($mock) use ($pdfWrapper, $htmlService) {
        $mock->shouldAllowMockingProtectedMethods()
            ->shouldReceive('getViewName')
            ->andThrow(new \Exception('Erro na obtenção do nome da view'));
    });

    $snappyService = new SnappyService($pdfWrapper, $htmlService);

    $this->app->instance(SnappyService::class, $snappyService);

    expect(fn() => $snappyService->getReportPdf($request))
        ->toThrow(SnappyServiceException::class);
});


//basic html
it('can get the basic html', function() {

    $fakePdfFile = \Illuminate\Http\UploadedFile::fake()->create('test.pdf')->store('pdfs');

    $mockedPdfWrapper = Mockery::mock(PdfWrapper::class)->makePartial();
    $mockedPdfWrapper->shouldReceive('setOptions','setOption')->andReturnSelf();
    $mockedPdfWrapper->shouldReceive('getOutputFromHtml')->andReturn($fakePdfFile);

    $snappyService = new SnappyService($mockedPdfWrapper, new HtmlService());

    $this->app->instance(SnappyService::class, $snappyService);

    $body = [
        'html' => '<h1>Teste</h1>',
    ];

    $response = $this->post(route('snappy.basic'), $body);

    expect($response->getStatusCode())->toBe(200)
        ->and($response->getContent())->toBe($fakePdfFile);
});
