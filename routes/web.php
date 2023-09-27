<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('welcome');
});

Route::get('pdf-test', TestController::class);

//Route::get('pdf-test', function() {
//    try {
//        $snappy = app()->make('snappy.pdf');
//        $html   = '<h1>Bill</h1><p>You owe me money, dude.</p>';
//        return response(
//            $snappy->getOutputFromHtml($html),
//            200,
//            array(
//                'Content-Type'        => 'application/pdf',
//                'Content-Disposition' => 'inline; filename="file.pdf"'
//            )
//        );
//    } catch(Exception $e) {
//        dd($e->getMessage(), $e);
//    }
//});


Route::get('/wkhtmltopdf', function() {
//    $html = '<h1>Bill</h1><p>You owe me money, dude.</p>';
    $html = <<<HTML
<!DOCTYPE html>
<html lang="pt-br">
<head >
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9QDZHGQVYK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());  gtag('config', 'G-9QDZHGQVYK');
    </script>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="smsxmiThLzz0HuRnelpgG9OkpKRBZDifSpMvCP9i" />
    <title>Área do paciente | feegowclinic</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-rqn26AG5Pj86AF4SO72RK5fyefcQ/x32DNQfChxWvbXIyXFePlEktwD18fEz+kQU" crossorigin="anonymous">

    <link rel="stylesheet" href="http://host.docker.internal:8000/css/normalize.min.css">
    <link rel="stylesheet" href="http://host.docker.internal:8000/css/bootstrap.min.css">
    <style> @page{size:initial} </style>
            <link rel="stylesheet" href="http://host.docker.internal:8000/modules/patientinterface/css/patient-interface.css?v=1695848268">

<!--    <link rel="stylesheet" href="https://unpkg.com/driver.js/dist/driver.min.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script type="text/javascript" src="http://host.docker.internal:8000/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://host.docker.internal:8000/js/jquery.gridster-0-5-6.js"></script>
<!--    <script src="https://unpkg.com/driver.js/dist/driver.min.js"></script>-->
    <link rel="stylesheet" href="http://host.docker.internal:8000/css/jquery.gridster-0-5-6.css">

    <!-- PNotify -->
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/font-awesome5@5.2.0/dist/PNotifyFontAwesome5.min.js"></script>
    <script type="text/javascript">
        PNotify.defaultModules.set(PNotifyBootstrap4, {});
        PNotify.defaultModules.set(PNotifyFontAwesome5, {});
        PNotify.defaults.icon = false;
        PNotify.defaults.closerHover = false;
        PNotify.defaults.sticker = false;
        PNotify.defaultStack.close(true);
        PNotify.defaultStack.maxOpen = 3;
        PNotify.defaultStack.maxStrategy = 'close';
        PNotify.defaultStack.modal = false;
    </script>
    <!-- Clarity -->
    <script type="text/javascript"> (function(c,l,a,r,i,t,y){ c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)}; t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i; y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y); })(window, document, "clarity", "script", "fuly0ts2lc"); </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9QDZHGQVYK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());  gtag('config', 'G-9QDZHGQVYK');
    </script>
</head>
<body>
    <style>

    </style>
    <link rel="stylesheet" href="http://host.docker.internal:8000/modules/patientinterface/css/medical-report-1.css">
    <style>
        @media  print {
            img, tr {
                page-break-inside: auto;
            }

            .no-print, .no-print * {
                display: none !important;
            }

            body {
                min-width: auto !important;
            }
            .footer-info{
                padding-top: 30px!important;
            }
            .divFooter .rodape{
                text-align: left;
                padding-top: 20px!important;
            }
        }

        .hidden {
            display: none;
        }
    </style>

    <div class="report-container">

        <page size='A4'>

            <table class="width100" style="page-break-before: avoid;">

                                    <thead class="report-header">
                    <tr style="page-break-before: avoid;">
                        <th class="report-header-cell">
                            <div><img alt="" src="https://functions.feegow.com/load-image?licenseId=20102&amp;folder=Arquivos&amp;file=9191e975b3ed3889b74a5ceed4fc67f1.png&amp;renderMode=redirect&amp;cache-prevent=1689699406" style="height:200px; width:800px" /></div>


                        </th>
                    </tr>
                    </thead>
                                <tbody class="report-content">
                <tr style="page-break-after: avoid;">
                    <td class="report-content-cell">
                        <p><span style="font-family:arial,helvetica,sans-serif"><strong>Paciente:</strong> Airton Baptista Borgueti<br />
<strong>Idade: </strong>12<br />
<strong>Nascimento:&nbsp;</strong>20/12/2010<br />
<strong>Data:</strong> quarta-feira, 27 de setembro de 2023</span></p>

                    </td>
                </tr>
                <tr>
                    <td class="report-content-cell">
                        <p><span style="font-family:courier new,courier,monospace"><strong>Uso Oral</strong><br />
<strong>1.</strong> Bupropriona .......................................1 comprimido</span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Bupropriona</strong></span></p>

<p><span style="font-family:courier new,courier,monospace">Bupropriona</span></p>
<span style="font-family:courier new,courier,monospace">aqui para montar descrever o que eu quero passar para o paciente de forma Clara t&ocirc; tentando ver o que que ele vai trazer aqui</span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso </strong><br />
<strong>2.</strong> Bupropriona .................................................. </span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Ashwagandha</strong>............................................<strong>250MG</strong><br />
<strong>Turkesterone</strong>...........................................<strong>200MG</strong><br />
<strong>Aviar em c&aacute;psulas</strong>..................................<strong>120 DOSES</strong></span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 01 c&aacute;psula 8:00 e &agrave;s 17:00 inicialmente por 2 meses.</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>3.</strong> DIOVAN AMLO FIX 320/10 MG .................................... </span></p>

<p><span style="font-family:courier new,courier,monospace">1 COMPRIMIDO DE MANH&Atilde;</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>4.</strong> Dipirona ..................................................... </span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso Oral</strong><br />
<strong><strong>2.</strong> Dipirona </strong>.............................................<strong>10 gotas </strong></span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 3x ao dia&nbsp;</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso 1x</strong></span></p>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ..................................................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ........................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ........................................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ......................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>
                    </td>
                </tr>


                                </tbody>


                    <tfoot class="report-footer">
                    <tr>
                        <td class="report-footer-cell pt-4">
                            <div class="footer-info">
                                                                    <div class="divFooter-signature">
 <img class="signature" src="https://functions.feegow.com/load-image?licenseId=20102&folder=Imagens&file=b556374df26f3d3b5c4dd035e1ca9184.jpg&renderMode=redirect"/>
<div>
        ___________________________________<br>
                Dra. Teste Feegow <br>
                CRO 5551234 SP
</div>
</div>

                                    <br><br>
                                                                <div style="text-align:center"><strong>Nosso site:</strong> <u>www.lablinus.com.br</u>&nbsp; &nbsp; &nbsp; &nbsp; <strong>Instagram:</strong> @clinicalinuspauling</div>

                            </div>
                        </td>
                    </tr>
                    </tfoot>
                            </table>

                <div class="divFooter">
                                            <div class="divFooter-signature">
 <img class="signature" src="https://functions.feegow.com/load-image?licenseId=20102&folder=Imagens&file=b556374df26f3d3b5c4dd035e1ca9184.jpg&renderMode=redirect"/>
<div>
        ___________________________________<br>
                Dra. Teste Feegow <br>
                CRO 5551234 SP
</div>
</div>

                        <br><br>
                                        <div class="rodape">
                        <div style="text-align:center"><strong>Nosso site:</strong> <u>www.lablinus.com.br</u>&nbsp; &nbsp; &nbsp; &nbsp; <strong>Instagram:</strong> @clinicalinuspauling</div>

                    </div>
                </div>
                    </page>

        <button class="btn btn-primary btn-print-form" id="btn-print-form">
            <i class="far fa-print"></i>
            Imprimir
        </button>
    </div>


                    <style>
                .main, .report-content-cell {
                    padding-left: 0px;
                    padding-right: 0px;
                }

                .report-header-cell {
                    padding-top: 0px;
                    padding-left: 0px;
                    padding-right: 0px;
                }

                .divFooter {
                    padding-left: 0px;
                    padding-right: 0px;
                    padding-bottom: 0px;
                }
                .divFooter .rodape{
                    text-align: left;
                    padding-top: 20px!important;
                }
                .footer-info{
                    padding-top: 30px!important;
                }

                thead.report-header th {
                    font-weight: normal;
                    padding-bottom: 10px;
                }

                @media  screen and (max-width: 500px){
                    .report-header-cell {
                        padding-left: 8px;
                        padding-right: 50px;
                        font-size: 11px;
                    }
                    report-content{
                        padding-left: 64px;
                        padding-right: 50px;
                    }
                    .report-content-cell {
                        padding-left: 1px;
                        padding-right: 50px;
                    }
                    .divFooter {
                        padding-left: 59px;
                        padding-right: 50px;
                    }
                    .divFooter .rodape {
                        text-align: center;

                    }
                    page[size="A4"]{
                        width: 10cm;
                    }
                }

                                    .report-container page * {
                    font-size: 20px !important;
                }





                            </style>

                </body>


</html>










































<!DOCTYPE html>
<html lang="pt-br">

<head >
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9QDZHGQVYK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());  gtag('config', 'G-9QDZHGQVYK');
    </script>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="gDAu7WQjUAubYuIdx2T4JkMPdQxKJjKXN8yj55o8" />
    <title>Área do paciente | feegowclinic</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-rqn26AG5Pj86AF4SO72RK5fyefcQ/x32DNQfChxWvbXIyXFePlEktwD18fEz+kQU" crossorigin="anonymous">

    <link rel="stylesheet" href="http://localhost:8000/css/normalize.min.css">
    <link rel="stylesheet" href="http://localhost:8000/css/bootstrap.min.css">
    <style> @page{size:initial} </style>
            <link rel="stylesheet" href="//localhost:8000/modules/patientinterface/css/patient-interface.css?v=1695855534">

    <link rel="stylesheet" href="https://unpkg.com/driver.js/dist/driver.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script type="text/javascript" src="http://localhost:8000/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://localhost:8000/js/jquery.gridster-0-5-6.js"></script>
    <script src="https://unpkg.com/driver.js/dist/driver.min.js"></script>
    <link rel="stylesheet" href="http://localhost:8000/css/jquery.gridster-0-5-6.css">

    <!-- PNotify -->
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/font-awesome5@5.2.0/dist/PNotifyFontAwesome5.min.js"></script>
    <script type="text/javascript">
        PNotify.defaultModules.set(PNotifyBootstrap4, {});
        PNotify.defaultModules.set(PNotifyFontAwesome5, {});
        PNotify.defaults.icon = false;
        PNotify.defaults.closerHover = false;
        PNotify.defaults.sticker = false;
        PNotify.defaultStack.close(true);
        PNotify.defaultStack.maxOpen = 3;
        PNotify.defaultStack.maxStrategy = 'close';
        PNotify.defaultStack.modal = false;
    </script>
    <!-- Clarity -->
    <script type="text/javascript"> (function(c,l,a,r,i,t,y){ c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)}; t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i; y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y); })(window, document, "clarity", "script", "fuly0ts2lc"); </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9QDZHGQVYK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());  gtag('config', 'G-9QDZHGQVYK');
    </script>
</head>
<body>
    <style>

    </style>
    <link rel="stylesheet" href="//localhost:8000/modules/patientinterface/css/medical-report-1.css">


    <style>
        @media  print {
            page[size='A4'] {
                margin: 0;
                width: 100%;
            }
            img, tr {
                page-break-inside: auto;
            }

            .no-print, .no-print * {
                display: none !important;
            }

            .footer-info {
                padding-top: 30px !important;
            }

            .divFooter .rodape {
                text-align: left;
                padding-top: 20px !important;
            }
        }

        .contentControleEspecial {
            display: flex;
            flex-flow: row;
        }

        .box {
            padding: 10px;
            width: 50%;
            margin: 5px;
            border: 2px solid #000;
        }

        .boxSign {
            width: 50%;
            margin: 10px;
            text-align: center
        }

        .centerVertical {
            padding-top: 40px;
        }
        .linha{
            float: left;
            width: 100%
        }
        .header-info img{
            height: auto!important;
            max-width: 100%!important;
        }
        .termica{
            display: block!important;
        }
        .termica .box{
            width: 100%;
        }
    </style>


    <div class="report-container">
        <page size='A4'>

                            <div  class="page-content">
                    <table>


                            <thead class="report-header">
                            <tr>
                                <td class="report-header-cell">
                                    <div class="header-info">
                                        <div><img alt="" src="https://functions.feegow.com/load-image?licenseId=20102&amp;folder=Arquivos&amp;file=9191e975b3ed3889b74a5ceed4fc67f1.png&amp;renderMode=redirect&amp;cache-prevent=1689699406" style="height:200px; width:800px" /></div>

                                    </div>
                                    <div class="linha">
                                        <div style="text-align: center">
                                            <h3 style="font-weight: 600">Receituário de controle especial - 1ª via</h3>
                                        </div>

                                        <div class="contentControleEspecial ">
                                            <div class="box">
                                                Indicação do emitente<br>
                                                TESTE FEEGOW<br>
                                                CRO:5551234-SP<br>
                                                ,  <br>

                                                &nbsp;
                                                <br>
                                                Telefone: &nbsp;
                                            </div>
                                            <div class="box ">
                                                <p class="centerVertical">1a. via para retenção da farmácia ou drogaria<br>
                                                    2a. via para orientação ao paciente</p>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                                <tr>
                                    <td colspan="2" class="report-header-cell">
                                        <div class="header-info">
                                            <p><span style="font-family:arial,helvetica,sans-serif"><strong>Paciente:</strong> Airton Baptista Borgueti<br />
<strong>Idade: </strong>12<br />
<strong>Nascimento:&nbsp;</strong>20/12/2010<br />
<strong>Data:</strong> quarta-feira, 27 de setembro de 2023</span></p>

                                        </div>
                                    </td>
                                </tr>
                                                        </thead>


                            <tfoot class="report-footer">
                            <tr>
                                <td class="report-footer-cell">
                                    <div class="footer-info">

                                                                                <br><br><br><br><br><br><br>
                                        <div style="text-align:center"><strong>Nosso site:</strong> <u>www.lablinus.com.br</u>&nbsp; &nbsp; &nbsp; &nbsp; <strong>Instagram:</strong> @clinicalinuspauling</div>

                                    </div>
                                </td>
                            </tr>
                            </tfoot>

                        <tbody class="report-content">

                        <tr>
                            <td class="report-content-cell">
                                <div class="main" style="overflow-wrap: anywhere;">
                                    <br>
                                    <p><span style="font-family:courier new,courier,monospace"><strong>Uso Oral</strong><br />
<strong>1.</strong> Bupropriona .......................................1 comprimido</span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Bupropriona</strong></span></p>

<p><span style="font-family:courier new,courier,monospace">Bupropriona</span></p>
<span style="font-family:courier new,courier,monospace">aqui para montar descrever o que eu quero passar para o paciente de forma Clara t&ocirc; tentando ver o que que ele vai trazer aqui</span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso </strong><br />
<strong>2.</strong> Bupropriona .................................................. </span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Ashwagandha</strong>............................................<strong>250MG</strong><br />
<strong>Turkesterone</strong>...........................................<strong>200MG</strong><br />
<strong>Aviar em c&aacute;psulas</strong>..................................<strong>120 DOSES</strong></span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 01 c&aacute;psula 8:00 e &agrave;s 17:00 inicialmente por 2 meses.</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>3.</strong> DIOVAN AMLO FIX 320/10 MG .................................... </span></p>

<p><span style="font-family:courier new,courier,monospace">1 COMPRIMIDO DE MANH&Atilde;</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>4.</strong> Dipirona ..................................................... </span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso Oral</strong><br />
<strong><strong>2.</strong> Dipirona </strong>.............................................<strong>10 gotas </strong></span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 3x ao dia&nbsp;</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso 1x</strong></span></p>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ..................................................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ........................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ........................................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ......................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                        <div class="divFooter">
                                                            <div class="divFooter-signature">
                                    <div class="contentControleEspecial ">
                                        <div class="boxSign">

                                        </div>
                                        <div class="boxSign">
                                                                                                                                                <span id="dataV" style="display: block;">_______________, ____ de ________________ de _______.</span>

                                                                                            <div class="divFooter-signature">
 <img class="signature" src="https://functions.feegow.com/load-image?licenseId=20102&folder=Imagens&file=b556374df26f3d3b5c4dd035e1ca9184.jpg&renderMode=redirect"/>
<div>
        ___________________________________<br>
                Dra. Teste Feegow <br>
                CRO 5551234 SP
</div>
</div>

                                                                                    </div>
                                    </div>
                                    <div class="contentControleEspecial ">
                                        <div class="box" style="text-align: left">
                                            Indicação do comprador<br>
                                            Nome:.......................................................................<br>
                                            ............................................................................
                                            RG:.......................................................
                                            Emissor:..........................................
                                            Endereço:...................................................................
                                            Cidade:................................................ UF:.................
                                            <br>Telefone: .............................

                                        </div>
                                        <div class="box">
                                            <p>Identificação do fornecedor</p>
                                            <p>&nbsp;</p>
                                            <table border="0" width="100%" class="data">
                                                <tr>
                                                    <td align="center" width="50%">
                                                        _______________________<br>
                                                        Assinatura farmacêutico
                                                    </td>
                                                    <td align="center" width="50%">
                                                        Data: ..../..../.......
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            <div style="text-align:center"><strong>Nosso site:</strong> <u>www.lablinus.com.br</u>&nbsp; &nbsp; &nbsp; &nbsp; <strong>Instagram:</strong> @clinicalinuspauling</div>

                        </div>

                                    </div>
                            <div  class="page-content">
                    <table>


                            <thead class="report-header">
                            <tr>
                                <td class="report-header-cell">
                                    <div class="header-info">
                                        <div><img alt="" src="https://functions.feegow.com/load-image?licenseId=20102&amp;folder=Arquivos&amp;file=9191e975b3ed3889b74a5ceed4fc67f1.png&amp;renderMode=redirect&amp;cache-prevent=1689699406" style="height:200px; width:800px" /></div>

                                    </div>
                                    <div class="linha">
                                        <div style="text-align: center">
                                            <h3 style="font-weight: 600">Receituário de controle especial - 2ª via</h3>
                                        </div>

                                        <div class="contentControleEspecial ">
                                            <div class="box">
                                                Indicação do emitente<br>
                                                TESTE FEEGOW<br>
                                                CRO:5551234-SP<br>
                                                ,  <br>

                                                &nbsp;
                                                <br>
                                                Telefone: &nbsp;
                                            </div>
                                            <div class="box ">
                                                <p class="centerVertical">1a. via para retenção da farmácia ou drogaria<br>
                                                    2a. via para orientação ao paciente</p>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                                <tr>
                                    <td colspan="2" class="report-header-cell">
                                        <div class="header-info">
                                            <p><span style="font-family:arial,helvetica,sans-serif"><strong>Paciente:</strong> Airton Baptista Borgueti<br />
<strong>Idade: </strong>12<br />
<strong>Nascimento:&nbsp;</strong>20/12/2010<br />
<strong>Data:</strong> quarta-feira, 27 de setembro de 2023</span></p>

                                        </div>
                                    </td>
                                </tr>
                                                        </thead>


                            <tfoot class="report-footer">
                            <tr>
                                <td class="report-footer-cell">
                                    <div class="footer-info">

                                                                                <br><br><br><br><br><br><br>
                                        <div style="text-align:center"><strong>Nosso site:</strong> <u>www.lablinus.com.br</u>&nbsp; &nbsp; &nbsp; &nbsp; <strong>Instagram:</strong> @clinicalinuspauling</div>

                                    </div>
                                </td>
                            </tr>
                            </tfoot>

                        <tbody class="report-content">

                        <tr>
                            <td class="report-content-cell">
                                <div class="main" style="overflow-wrap: anywhere;">
                                    <br>
                                    <p><span style="font-family:courier new,courier,monospace"><strong>Uso Oral</strong><br />
<strong>1.</strong> Bupropriona .......................................1 comprimido</span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Bupropriona</strong></span></p>

<p><span style="font-family:courier new,courier,monospace">Bupropriona</span></p>
<span style="font-family:courier new,courier,monospace">aqui para montar descrever o que eu quero passar para o paciente de forma Clara t&ocirc; tentando ver o que que ele vai trazer aqui</span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso </strong><br />
<strong>2.</strong> Bupropriona .................................................. </span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Ashwagandha</strong>............................................<strong>250MG</strong><br />
<strong>Turkesterone</strong>...........................................<strong>200MG</strong><br />
<strong>Aviar em c&aacute;psulas</strong>..................................<strong>120 DOSES</strong></span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 01 c&aacute;psula 8:00 e &agrave;s 17:00 inicialmente por 2 meses.</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>3.</strong> DIOVAN AMLO FIX 320/10 MG .................................... </span></p>

<p><span style="font-family:courier new,courier,monospace">1 COMPRIMIDO DE MANH&Atilde;</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>4.</strong> Dipirona ..................................................... </span></p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso Oral</strong><br />
<strong><strong>2.</strong> Dipirona </strong>.............................................<strong>10 gotas </strong></span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 3x ao dia&nbsp;</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p>&nbsp;</p>

<p><span style="font-family:courier new,courier,monospace"><strong>Uso 1x</strong></span></p>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ..................................................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ........................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ........................................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>

<p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ......................... 2 comprimidos</span></p>
<span style="font-family:courier new,courier,monospace"> </span>
                                </div>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                        <div class="divFooter">
                                                            <div class="divFooter-signature">
                                    <div class="contentControleEspecial ">
                                        <div class="boxSign">

                                        </div>
                                        <div class="boxSign">
                                                                                                                                                <span id="dataV" style="display: block;">_______________, ____ de ________________ de _______.</span>

                                                                                            <div class="divFooter-signature">
 <img class="signature" src="https://functions.feegow.com/load-image?licenseId=20102&folder=Imagens&file=b556374df26f3d3b5c4dd035e1ca9184.jpg&renderMode=redirect"/>
<div>
        ___________________________________<br>
                Dra. Teste Feegow <br>
                CRO 5551234 SP
</div>
</div>

                                                                                    </div>
                                    </div>
                                    <div class="contentControleEspecial ">
                                        <div class="box" style="text-align: left">
                                            Indicação do comprador<br>
                                            Nome:.......................................................................<br>
                                            ............................................................................
                                            RG:.......................................................
                                            Emissor:..........................................
                                            Endereço:...................................................................
                                            Cidade:................................................ UF:.................
                                            <br>Telefone: .............................

                                        </div>
                                        <div class="box">
                                            <p>Identificação do fornecedor</p>
                                            <p>&nbsp;</p>
                                            <table border="0" width="100%" class="data">
                                                <tr>
                                                    <td align="center" width="50%">
                                                        _______________________<br>
                                                        Assinatura farmacêutico
                                                    </td>
                                                    <td align="center" width="50%">
                                                        Data: ..../..../.......
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            <div style="text-align:center"><strong>Nosso site:</strong> <u>www.lablinus.com.br</u>&nbsp; &nbsp; &nbsp; &nbsp; <strong>Instagram:</strong> @clinicalinuspauling</div>

                        </div>

                                    </div>
                    </page>
        <button class="btn btn-primary btn-print-form" id="btn-print-form">
            <i class="fa fa-print"></i>
            Imprimir
        </button>
    </div>


        <style>
            table {
                width: 100%;
            }

            .divFooter-signature {
                /*padding-bottom: 100px;*/
                /*padding-top: 50px;*/
                /*text-align:left;*/

            }


                .main {
                margin-left: 0px;
                margin-right: 0px;
            }

            .report-header-cell {
                padding-top: 0px;
                padding-left: 0px;
                padding-right: 0px;
            }

            .divFooter {
                padding-bottom: 0px;
                padding-left: 0px;
                padding-right: 0px;
            }

                                * {
                font-size: 20px;
            }


                                        * {
                color: ;
            }




        </style>


    <script>
        var $print = document.getElementById("btn-print-form");
        $print.onclick = function () {
            print();
        };
        // print();
        // window.close();
    </script>


</html>









HTML;
    $tmpFile = tempnam(sys_get_temp_dir(), 'pdf');
    file_put_contents($tmpFile . '.html', $html);

    $command = "wkhtmltopdf {$tmpFile}.html {$tmpFile}.pdf";
    exec($command, $output, $returnVar);

    if ($returnVar !== 0) {
        return 'Erro ao gerar PDF com wkhtmltopdf.';
    }

    return response()->file($tmpFile . '.pdf');
});
