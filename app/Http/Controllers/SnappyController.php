<?php

namespace App\Http\Controllers;

use App\Services\HtmlService;
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
        private SnappyService $snappyService,
        private HtmlService   $htmlService
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
        $submitted_html = $request->html;
        $parsed_html    = $this->htmlService->setHtml($submitted_html)
            ->cleanUp()
            ->getHtml();
        $pdf            = $this->snappyService->basicHtmlToPdf($parsed_html);
        return response($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . now() . '.pdf"',
            'Cache-Control'       => 'no-cache, no-store, max-age=0, must-revalidate',
        ]);
    }

    /**
     * Dynamic PDF generation
     *
     * Generate PDFs from HTML
     *
     * @bodyParam report string required The report (name of the view used within feegow-api) to be generated. Example: patientinterface::render-medical-report
     * @bodyParam letterhead object required The letterhead configs. Example: {"mTop": 20, "mBottom": 20, "mLeft": 20, "mRight": 20, "headerHeight": 50, "footerHeight": 50, "useHeader": true, "useFooter": true, "paperSize": "A4", "orientation": "portrait", "customWidth": 210, "customHeight": 297}
     * @bodyParam letterhead.mTop integer required The top margin of the letterhead. Example: 20
     * @bodyParam letterhead.mBottom integer required The bottom margin of the letterhead. Example: 20
     * @bodyParam letterhead.mLeft integer required The left margin of the letterhead. Example: 20
     * @bodyParam letterhead.mRight integer required The right margin of the letterhead. Example: 20
     * @bodyParam letterhead.headerHeight integer required The header height of the letterhead. Example: 50
     * @bodyParam letterhead.footerHeight integer required The footer height of the letterhead. Example: 50
     * @bodyParam letterhead.useHeader boolean required The use header of the letterhead. Example: true
     * @bodyParam letterhead.useFooter boolean required The use footer of the letterhead. Example: true
     * @bodyParam letterhead.paperSize string required The paper size of the letterhead. Example: A4
     * @bodyParam letterhead.orientation string required The orientation of the letterhead. Example: portrait
     * @bodyParam letterhead.customWidth integer required The custom width of the letterhead. Example: 210
     * @bodyParam letterhead.customHeight integer required The custom height of the letterhead. Example: 297
     *
     * @bodyParam body string required The body of the report. Example: <html><body><h1>Teste</h1></body></html>
     * @bodyParam default string required The default configs of the report. Example: <html><body><div>Teste de conteúdo default</div></body></html>
     * @bodyParam pedidos object[] required The pedidos of the report. Example: [{"NomeProcedimento": "Procedimento 1", "Observacoes": "Observação 1"}, {"NomeProcedimento": "Procedimento 2", "Observacoes": "Observação 2"}]
     * @bodyParam pedidos.NomeProcedimento string required The NomeProcedimento of the pedido. Example: Procedimento 1
     * @bodyParam pedidos.Observacoes string required The Observacoes of the pedido. Example: Observação 1
     * @bodyParam configOpcoes object required The configOpcoes of the report. Example: {"AssociarPorGrupos": 1}
     * @bodyParam configOpcoes.AssociarPorGrupos integer required The AssociarPorGrupos of the configOpcoes. Example: 1
     *
     * @bodyParam specialControl object required The specialControl of the report. Example: {"termico": 1, "NomeProfissional": "Teste", "DocumentoProfissional": "Teste", "EnderecoClinica": "Teste", "CidadeClinica": "Teste", "EstadoClinica": "Teste", "Tel1Clinica": "Teste", "dataV": "2021-09-28 14:09:00"}
     * @bodyParam specialControl.termico integer required Tells whether the report is thermal or not. Example: 1
     * @bodyParam specialControl.NomeProfissional string required The NomeProfissional of the specialControl. Example: Teste
     * @bodyParam specialControl.DocumentoProfissional string required The DocumentoProfissional of the specialControl. Example: Teste
     * @bodyParam specialControl.EnderecoClinica string required The EnderecoClinica of the specialControl. Example: Teste
     * @bodyParam specialControl.CidadeClinica string required The CidadeClinica of the specialControl. Example: Teste
     * @bodyParam specialControl.EstadoClinica string required The EstadoClinica of the specialControl. Example: Teste
     * @bodyParam specialControl.Tel1Clinica string required The Tel1Clinica of the specialControl. Example: Teste
     * @bodyParam specialControl.dataV string required The dataV of the specialControl. Example: 2021-09-28 14:09:00
     *
     * @bodyParam protocols object[] required The protocols of the report. Example: [{"NomeProtocolo": "Protocolo 1", "NomeProfissional": "Profissional 1", "ciclo": "Ciclo 1", "Periodicidade": "Periodicidade 1"}, {"NomeProtocolo": "Protocolo 2", "NomeProfissional": "Profissional 2", "ciclo": "Ciclo 2", "Periodicidade": "Periodicidade 2"}]
     * @bodyParam protocols.NomeProtocolo string required The NomeProtocolo of the protocol. Example: Protocolo 1
     * @bodyParam protocols.NomeProfissional string required The NomeProfissional of the protocol. Example: Profissional 1
     * @bodyParam protocols.ciclo string required The ciclo of the protocol. Example: Ciclo 1
     *
     * @bodyParam dadosPaciente object required The dadosPaciente of the report. Example: {"NomePaciente": "Teste", "NomeSexo": "Masculino", "sysDate": "2021-09-28 14:09:00", "id": 1, "Nascimento": "2021-09-28 14:09:00", "Altura": 1.8, "Peso": 80, "IMC": 24.69, "Endereco": "Rua Teste", "Bairro": "Bairro Teste", "Cidade": "Cidade Teste", "Estado": "Estado Teste", "NomePais": "País Teste", "Cep": "00000-000", "Tel1": "0000-0000", "Tel2": "0000-0000", "Cel1": "00000-0000", "Cel2": "00000-0000", "Email1": "exemple@mail.com", "Email2": "example2@mail.com", "Documento": "00000000000", "CPF": "000.000.000-00", "NomeEstadoCivil": "Estado Civil Teste", "Naturalidade": "Naturalidade Teste", "NomeGrauInstrucao": "Grau de Instrução Teste", "Profissao": "Profissão Teste", "NomeOrigem": "Origem Teste", "convenio1": "Convênio Teste", "plano1": "Plano Teste", "Matricula1": "Matrícula Teste", "Validade1": "2021-09-28 14:09:00", "Titular1": "Titular Teste"}
     * @bodyParam dadosPaciente.NomePaciente string required The NomePaciente of the dadosPaciente. Example: Teste
     * @bodyParam dadosPaciente.NomeSexo string required The NomeSexo of the dadosPaciente. Example: Masculino
     * @bodyParam dadosPaciente.sysDate string required The sysDate of the dadosPaciente. Example: 2021-09-28 14:09:00
     * @bodyParam dadosPaciente.id integer required The id of the dadosPaciente. Example: 1
     * @bodyParam dadosPaciente.Nascimento string required The Nascimento of the dadosPaciente. Example: 2021-09-28 14:09:00
     * @bodyParam dadosPaciente.Altura float required The Altura of the dadosPaciente. Example: 1.8
     * @bodyParam dadosPaciente.Peso float required The Peso of the dadosPaciente. Example: 80
     * @bodyParam dadosPaciente.IMC float required The IMC of the dadosPaciente. Example: 24.69
     * @bodyParam dadosPaciente.Endereco string required The Endereco of the dadosPaciente. Example: Rua Teste
     * @bodyParam dadosPaciente.Bairro string required The Bairro of the dadosPaciente. Example: Bairro Teste
     * @bodyParam dadosPaciente.Cidade string required The Cidade of the dadosPaciente. Example: Cidade Teste
     * @bodyParam dadosPaciente.Estado string required The Estado of the dadosPaciente. Example: Estado Teste
     * @bodyParam dadosPaciente.NomePais string required The NomePais of the dadosPaciente. Example: País Teste
     * @bodyParam dadosPaciente.Cep string required The Cep of the dadosPaciente. Example: 00000-000
     * @bodyParam dadosPaciente.Tel1 string required The Tel1 of the dadosPaciente. Example: 0000-0000
     * @bodyParam dadosPaciente.Tel2 string required The Tel2 of the dadosPaciente. Example: 0000-0000
     * @bodyParam dadosPaciente.Cel1 string required The Cel1 of the dadosPaciente. Example: 00000-0000
     * @bodyParam dadosPaciente.Cel2 string required The Cel2 of the dadosPaciente. Example: 00000-0000
     * @bodyParam dadosPaciente.Email1 string required The Email1 of the dadosPaciente. Example:
     * @bodyParam dadosPaciente.Email2 string required The Email2 of the dadosPaciente. Example:
     * @bodyParam dadosPaciente.Documento string required The Documento of the dadosPaciente. Example: 00000000000
     * @bodyParam dadosPaciente.CPF string required The CPF of the dadosPaciente. Example: 000.000.000-00
     * @bodyParam dadosPaciente.NomeEstadoCivil string required The NomeEstadoCivil of the dadosPaciente. Example: Estado Civil Teste
     * @bodyParam dadosPaciente.Naturalidade string required The Naturalidade of the dadosPaciente. Example: Naturalidade Teste
     * @bodyParam dadosPaciente.NomeGrauInstrucao string required The NomeGrauInstrucao of the dadosPaciente. Example: Grau de Instrução Teste
     * @bodyParam dadosPaciente.Profissao string required The Profissao of the dadosPaciente. Example: Profissão Teste
     * @bodyParam dadosPaciente.NomeOrigem string required The NomeOrigem of the dadosPaciente. Example: Origem Teste
     * @bodyParam dadosPaciente.convenio1 string required The convenio1 of the dadosPaciente. Example: Convênio Teste
     * @bodyParam dadosPaciente.plano1 string required The plano1 of the dadosPaciente. Example: Plano Teste
     * @bodyParam dadosPaciente.Matricula1 string required The Matricula1 of the dadosPaciente. Example: Matrícula Teste
     * @bodyParam dadosPaciente.Validade1 string required The Validade1 of the dadosPaciente. Example: 2021-09-28 14:09:00
     * @bodyParam dadosPaciente.Titular1 string required The Titular1 of the dadosPaciente. Example: Titular Teste
     *
     * @bodyParam timeline object[] required The timeline of the report. Example: [{"title": "Teste", "nome_profissional": "Teste", "date_time": "2021-09-28 14:09:00", "content": "Teste"}]
     * @bodyParam timeline.title string required The title of the timeline. Example: Teste
     * @bodyParam timeline.nome_profissional string required The nome_profissional of the timeline. Example: Teste
     * @bodyParam timeline.date_time string required The date_time of the timeline. Example: 2021-09-28 14:09:00
     * @bodyParam timeline.content string required The content of the timeline. Example: Teste
     *
     */
    public function dynamicReport(Request $request)
    {
        $request->validate([
            'report'     => 'required|string',
            'letterhead' => 'required|array',
        ], [
            'report.required' => 'O campo report é obrigatório.',
        ]);

        $report = $request->report;

        switch($report) {
            case 'patientinterface::render-medical-report':
            case 'patientinterface::render-medical-report-controle-especial':
                $request->validate([
                    'body'           => 'required|string',
                    'default'        => 'required|string',
                    'pedidos'        => 'nullable|array',
                    'configOpcoes'   => 'nullable|array',
                    'specialControl' => 'nullable|array',
                ]);
                break;
            case 'patientinterface::render-medical-report-protocol':
                $request->validate([
                    'default'   => 'required|string',
                    'protocols' => 'required|array',
                ]);
                break;
            case 'patientinterface::render-atendimento-report':
                $request->validate([
                    'dadosPaciente' => 'required|array',
                    'timeline'      => 'required|array',
                ]);
                break;
            default:
                //$body = view('default.body', compact('letterhead', 'body', 'default', 'specialControl'))->render();
                break;
        }
        $pdf = $this->snappyService->getReportPdf($request);

        return response($pdf, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . now() . '.pdf"',
            'Cache-Control'       => 'no-cache, no-store, max-age=0, must-revalidate',
        ]);
    }


    public function testFixedContent()
    {
        define('PIXELS_PER_MM', (96 / 25.4));
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


