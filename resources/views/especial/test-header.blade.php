<!DOCTYPE html>
<html>
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9QDZHGQVYK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-9QDZHGQVYK');
    </script>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="gDAu7WQjUAubYuIdx2T4JkMPdQxKJjKXN8yj55o8"/>
    <title>Área do paciente | feegowclinic</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-rqn26AG5Pj86AF4SO72RK5fyefcQ/x32DNQfChxWvbXIyXFePlEktwD18fEz+kQU" crossorigin="anonymous">

    <link rel="stylesheet" href="http://host.docker.internal:8000/css/normalize.min.css">
    <link rel="stylesheet" href="http://host.docker.internal:8000/css/bootstrap.min.css">
    <style> @page {size: initial} </style>
    <link rel="stylesheet"
          href="http://host.docker.internal:8000/modules/patientinterface/css/patient-interface.css?v=1695855534">

    {{--    <link rel="stylesheet" href="https://unpkg.com/driver.js/dist/driver.min.css">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script type="text/javascript" src="http://host.docker.internal:8000/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://host.docker.internal:8000/js/jquery.gridster-0-5-6.js"></script>
    {{--    <script src="https://unpkg.com/driver.js/dist/driver.min.js"></script>--}}
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
    <script type="text/javascript"> (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "fuly0ts2lc"); </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9QDZHGQVYK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-9QDZHGQVYK');
    </script>
    <link rel="stylesheet" href="http://host.docker.internal:8000/modules/patientinterface/css/medical-report-1.css">
    <style>
        @media print {
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

        .linha {
            float: left;
            width: 100%
        }

        .header-info img {
            height: auto !important;
            max-width: 100% !important;
        }

        .termica {
            display: block !important;
        }

        .termica .box {
            width: 100%;
        }

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
            color: #000000;
        }
    </style>
    <script>
        function subst() {
            var vars = {};
            var query_strings_from_url = document.location.search.substring(1).split('&');
            for (var query_string in query_strings_from_url) {
                if (query_strings_from_url.hasOwnProperty(query_string)) {
                    var temp_var = query_strings_from_url[query_string].split('=', 2);
                    vars[temp_var[0]] = decodeURI(temp_var[1]);
                }
            }
            var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
            for (var css_class in css_selector_classes) {
                if (css_selector_classes.hasOwnProperty(css_class)) {
                    var element = document.getElementsByClassName(css_selector_classes[css_class]);
                    for (var j = 0; j < element.length; ++j) {
                        element[j].textContent = vars[css_selector_classes[css_class]];
                    }
                }
            }
        }
    </script>
</head>
<body style="border:0; margin: 0;" onload="subst()">
<table style="width: 100%; margin-bottom: 15px;">
    <tr style="border-bottom: 1px solid black;">
        <td style="text-align: center;">
            <div class="header-info">
                <div><img alt=""
                          src="https://functions.feegow.com/load-image?licenseId=20102&folder=Arquivos&file=9191e975b3ed3889b74a5ceed4fc67f1.png&renderMode=redirect&cache-prevent=1689699406"
                          style="height:200px; width:800px"/></div>
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
                        , <br>

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
        <td>
            <div class="header-info">
                <p><span style="font-family:arial,helvetica,sans-serif"><strong>Paciente:</strong> Airton Baptista Borgueti<br/>
                <strong>Idade: </strong>12<br/>
                <strong>Nascimento:&nbsp;</strong>20/12/2010<br/>
                <strong>Data:</strong> quarta-feira, 27 de setembro de 2023</span></p>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
