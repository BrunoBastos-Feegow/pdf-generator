<!DOCTYPE html>
<html lang="pt-br">
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
    <link rel="stylesheet"
          href="http://host.docker.internal:8000/modules/patientinterface/css/patient-interface.css?v=1695848268">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script type="text/javascript" src="http://host.docker.internal:8000/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://host.docker.internal:8000/js/jquery.gridster-0-5-6.js"></script>
    <link rel="stylesheet" href="http://host.docker.internal:8000/css/jquery.gridster-0-5-6.css">
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/bootstrap4@5.2.0/dist/PNotifyBootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@pnotify/font-awesome5@5.2.0/dist/PNotifyFontAwesome5.min.js"></script>


    @php
        //    $topMargin = ($configs['topMargin'] ?? 5);
        //    $bottomMargin = ($configs['bottomMargin'] ?? 5);
        //    $leftMargin = ($configs['leftMargin'] ?? 5);
        //    $rightMargin = ($configs['rightMargin'] ?? 5);
        //    $headerHeight = ($configs['headerHeight'] ?? 0);
        //    $footerHeight = ($configs['footerHeight'] ?? 0);
        //    $useHeader = $configs['useHeader'] ?? false;
        //    $useFooter = $configs['useFooter'] ?? false;
        //    $paperSize = $configs['paperSize'] ?? 'A4';
        //    $orientation = $configs['orientation'] ?? 'portrait';
        //    $customWidth = ($configs['customWidth'] ?? 210);
        //    $customHeight = ($configs['customHeight'] ?? 297);

            if(isset($letterhead["mTop"])){
                $mLeft = $letterhead["mLeft"] ?? 0;
                $mLeft = $mLeft == "0" ? 0 : $mLeft . "px";
                $mRight = $letterhead["mRight"] ?? 0;
                $mRight = $mRight == "0" ? 0 : $mRight . "px";
                $mTop = $letterhead["mTop"] ?? 0;
                $mTop = $mTop == "0" ? 0 : $mTop . "px";
                $mBottom = $letterhead["mBottom"] ?? 0;
                $mBottom = $mBottom == "0" ? 0 : $mBottom . "px";
            } else {
                $mLeft = "20px";
                $mRight = "20px";
                $mTop = "20px";
                $mBottom = "20px";
            }
    @endphp

    <style>
        .hidden {
            display: none;
        }

        body {
            margin: {{ $mTop }} {{ $mRight }} {{ $mBottom }} {{ $mLeft }};
            background: #fff;
        }

        .content div {
            height: auto !important;
        }

        .content {
            padding: 3px {{$mRight}} 3px{{$mLeft}};
            min-width: 100% !important;
        }

        @if(is_numeric(@$letterhead["font-size"]) && !@$useFormFontSize)
            .content * {
            font-size: {{$letterhead["font-size"]}}px !important;
        }

        @elseif(!@$useFormFontSize)
            .content * {
            font-size: 17px;
        }

        @endif

        @if(is_numeric(@$letterhead["line-height"]))
            .content * {
            line-height: {{$letterhead["line-height"]}}px;
        }

        @endif

        @if(!empty(@$letterhead["color"]))
            .content * {
            color: {{$letterhead["color"]}};
        }

        @endif

        @if(strlen(@$letterhead["font-family"]) > 2)
            .content * {
            font-family: '{{$letterhead["font-family"]}}' !important;
        }

        @endif

        @if(is_numeric(@$letterhead["font-size"]) && !@$useFormFontSize)
            .content * {
            font-size: {{$letterhead["font-size"]}}px !important;
        }

        @elseif(!@$useFormFontSize)
            .content * {
            font-size: 17px;
        }

        @endif
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
<body onload="subst()">
@yield('content')
</body>
</html>

