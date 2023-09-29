<!DOCTYPE html>
<html>
<head>
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
            margin: 0;
            border: 2px solid #000;
            border-collapse: collapse;
            height: 100%;
        }

        .boxSign {
            width: 50%;
            margin: 2px;
            text-align: center;
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
<table style="width: 100%; margin-bottom: 15px; border-collapse: collapse;">
    <tr>
        <td style="width: 50%;"></td>
        <td style="width: 50%; text-align: center;">
            <span id="dataV"
                  style="display: block;">_______________, ____ de _________ de _______.</span>

            <div style="text-justify: distribute-all-lines;">
                <img class="signature"
                     src="https://functions.feegow.com/load-image?licenseId=20102&folder=Imagens&file=b556374df26f3d3b5c4dd035e1ca9184.jpg&renderMode=redirect"/>
                <div>
                    ___________________________________<br>
                    Dra. Teste Feegow <br>
                    CRO 5551234 SP
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; border: 1px solid;">Indicação do comprador</td>
        <td style="text-align: center; border: 1px solid;">Identificação do fornecedor</td>
    </tr>
    <tr>
        <td style="width: 50%; border: 1px solid;">
            Nome:...........................................................
            RG:..................................Emissor:...................
            Endereço:.......................................................
            Cidade:...................................... UF:...............
            <br>Telefone: ..................................................
        </td>
        <td style="width: 50%; border: 1px solid;">
                <p>&nbsp;</p>
                <table style="border:0; width:100%;" class="data">
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
        </td>
    </tr>
    <tr>
        <td colspan="2" style="width: 100%;">
            <div style="display: block; text-align:center;"><strong>Nosso site:</strong> <u>www.lablinus.com.br</u>&nbsp;
                &nbsp;
                &nbsp; &nbsp; <strong>Instagram:</strong> @clinicalinuspauling
            </div>
        </td>
    </tr>
</table>
</body>
</html>
