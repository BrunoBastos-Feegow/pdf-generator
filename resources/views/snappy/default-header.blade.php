@php
$topMargin = ($configs['topMargin'] ?? 5);
$bottomMargin = ($configs['bottomMargin'] ?? 5);
$leftMargin = ($configs['leftMargin'] ?? 5);
$rightMargin = ($configs['rightMargin'] ?? 5);
$headerHeight = ($configs['headerHeight'] ?? 0);
$footerHeight = ($configs['footerHeight'] ?? 0);
$useHeader = $configs['useHeader'] ?? false;
$useFooter = $configs['useFooter'] ?? false;
$paperSize = $configs['paperSize'] ?? 'A4';
$orientation = $configs['orientation'] ?? 'portrait';
$customWidth = ($configs['customWidth'] ?? 210);
$customHeight = ($configs['customHeight'] ?? 297);
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="smsxmiThLzz0HuRnelpgG9OkpKRBZDifSpMvCP9i"/>
    <title>Área do paciente | feegowclinic</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-rqn26AG5Pj86AF4SO72RK5fyefcQ/x32DNQfChxWvbXIyXFePlEktwD18fEz+kQU" crossorigin="anonymous">

    <link rel="stylesheet" href="http://host.docker.internal:8000/css/normalize.min.css">
    <link rel="stylesheet" href="http://host.docker.internal:8000/css/bootstrap.min.css">
{{--    <style> @page {size: initial} </style>--}}
    <link rel="stylesheet"
          href="http://host.docker.internal:8000/modules/patientinterface/css/patient-interface.css?v=1695848268">

    <!--    <link rel="stylesheet" href="https://unpkg.com/driver.js/dist/driver.min.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script type="text/javascript" src="http://host.docker.internal:8000/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://host.docker.internal:8000/js/jquery.gridster-0-5-6.js"></script>
    <!--    <script src="https://unpkg.com/driver.js/dist/driver.min.js"></script>-->
    <link rel="stylesheet" href="http://host.docker.internal:8000/css/jquery.gridster-0-5-6.css">

    <!-- PNotify -->
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/font-awesome5@5.2.0/dist/PNotifyFontAwesome5.min.js"></script>
    <link rel="stylesheet" href="http://host.docker.internal:8000/modules/patientinterface/css/medical-report-1.css">
    <style>
        .hidden {
            display: none;
        }

        /*.main, .report-content-cell {*/
        /*    padding-left: 0px;*/
        /*    padding-right: 0px;*/
        /*}*/

        /*.report-header-cell {*/
        /*    padding-top: 0px;*/
        /*    padding-left: 0px;*/
        /*    padding-right: 0px;*/
        /*}*/

        /*.divFooter {*/
        /*    padding-left: 0px;*/
        /*    padding-right: 0px;*/
        /*    padding-bottom: 0px;*/
        /*}*/
        /*.divFooter .rodape{*/
        /*    text-align: left;*/
        /*    padding-top: 20px!important;*/
        /*}*/
        /*.footer-info{*/
        /*    padding-top: 30px!important;*/
        /*}*/

        /*thead.report-header th {*/
        /*    font-weight: normal;*/
        /*    padding-bottom: 10px;*/
        /*}*/

        /*@media  screen and (max-width: 500px){*/
        /*    .report-header-cell {*/
        /*        padding-left: 8px;*/
        /*        padding-right: 50px;*/
        /*        font-size: 11px;*/
        /*    }*/
        /*    report-content{*/
        /*        padding-left: 64px;*/
        /*        padding-right: 50px;*/
        /*    }*/
        /*    .report-content-cell {*/
        /*        padding-left: 1px;*/
        /*        padding-right: 50px;*/
        /*    }*/
        /*    .divFooter {*/
        /*        padding-left: 59px;*/
        /*        padding-right: 50px;*/
        /*    }*/
        /*    .divFooter .rodape {*/
        /*        text-align: center;*/

        /*    }*/
        /*    page[size="A4"]{*/
        /*        width: 10cm;*/
        /*    }*/
        /*}*/

        /*.report-container page * {*/
        /*    font-size: 20px !important;*/
        /*}*/
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
<body style="margin: {{ $topMargin }}px {{ $rightMargin }}px {{ $bottomMargin }}px {{ $leftMargin }}px;" onload="subst()">
<div style="height: {{$headerHeight}}px !important; width: 100% !important; overflow: hidden;">
            <img alt=""
                 src="https://functions.feegow.com/load-image?licenseId=20102&folder=Arquivos&file=9191e975b3ed3889b74a5ceed4fc67f1.png&renderMode=download&cache-prevent=1689699406"
                 style="height:200px; width:800px"/>
</div>
</body>
</html>
