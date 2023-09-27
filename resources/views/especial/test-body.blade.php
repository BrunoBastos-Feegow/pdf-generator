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
    <style> @page {
            size: initial
        } </style>
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
        <td class="report-content-cell">
            <div class="main" style="overflow-wrap: anywhere;">
                <br>
                <p><span style="font-family:courier new,courier,monospace"><strong>Uso Oral</strong><br/>
<strong>1.</strong> Bupropriona .......................................1 comprimido</span></p>

                <p><span style="font-family:courier new,courier,monospace"><strong>Bupropriona</strong></span></p>

                <p><span style="font-family:courier new,courier,monospace">Bupropriona</span></p>
                <span style="font-family:courier new,courier,monospace">aqui para montar descrever o que eu quero passar para o paciente de forma Clara t&ocirc; tentando ver o que que ele vai trazer aqui</span>

                <p>&nbsp;</p>

                <p><span style="font-family:courier new,courier,monospace"><strong>Uso </strong><br/>
<strong>2.</strong> Bupropriona .................................................. </span></p>

                <p><span style="font-family:courier new,courier,monospace"><strong>Ashwagandha</strong>............................................<strong>250MG</strong><br/>
<strong>Turkesterone</strong>...........................................<strong>200MG</strong><br/>
<strong>Aviar em c&aacute;psulas</strong>..................................<strong>120 DOSES</strong></span></p>
                <span style="font-family:courier new,courier,monospace"> </span>

                <p><span style="font-family:courier new,courier,monospace">Tomar 01 c&aacute;psula 8:00 e &agrave;s 17:00 inicialmente por 2 meses.</span>
                </p>
                <span style="font-family:courier new,courier,monospace"> </span>

                <p>&nbsp;</p>

                <p><span style="font-family:courier new,courier,monospace"><strong>3.</strong> DIOVAN AMLO FIX 320/10 MG .................................... </span>
                </p>

                <p><span style="font-family:courier new,courier,monospace">1 COMPRIMIDO DE MANH&Atilde;</span></p>
                <span style="font-family:courier new,courier,monospace"> </span>

                <p>&nbsp;</p>

                <p><span style="font-family:courier new,courier,monospace"><strong>4.</strong> Dipirona ..................................................... </span>
                </p>

                <p><span style="font-family:courier new,courier,monospace"><strong>Uso Oral</strong><br/>
<strong><strong>2.</strong> Dipirona </strong>.............................................<strong>10 gotas </strong></span>
                </p>
                <span style="font-family:courier new,courier,monospace"> </span>

                <p><span style="font-family:courier new,courier,monospace">Tomar 3x ao dia&nbsp;</span></p>
                <span style="font-family:courier new,courier,monospace"> </span>

                <p>&nbsp;</p>

                <p><span style="font-family:courier new,courier,monospace"><strong>Uso 1x</strong></span></p>

                <p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ..................................................... 2 comprimidos</span>
                </p>
                <span style="font-family:courier new,courier,monospace"> </span>

                <p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ........................... 2 comprimidos</span>
                </p>
                <span style="font-family:courier new,courier,monospace"> </span>

                <p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ........................................... 2 comprimidos</span>
                </p>
                <span style="font-family:courier new,courier,monospace"> </span>

                <p><span style="font-family:courier new,courier,monospace">Tomar 1x ao dia ......................... 2 comprimidos</span>
                </p>
                <span style="font-family:courier new,courier,monospace"> </span>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
