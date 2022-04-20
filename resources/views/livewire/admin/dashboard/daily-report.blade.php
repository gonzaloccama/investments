<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Informe | de Entrega</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path().'/assets/pdf/style.css' }}">
    <link rel="stylesheet" type="text/css" href="{{ public_path().'/assets/css/vendor/bootstrap.min.css' }}">
    <style>
        .rotingtxt {
            -webkit-transform: rotate(331deg);
            -moz-transform: rotate(331deg);
            -o-transform: rotate(331deg);
            transform: rotate(331deg);
            font-size: 6em;
            color: rgba(28, 135, 229, 0.17);
            position: absolute;
            font-family: 'Denk One', sans-serif;
            text-transform: uppercase;
            text-align: center;
        }
    </style>
    <style>
        .watermark {
            position: absolute;
            top: 35%;
            left: 105px;
            transform: rotate(-45deg);
            transform-origin: 50% 50%;
            opacity: .18;
            font-size: 100px;
            color: #00477e;
            width: 520px;
            text-align: center;
            border: 15px solid #00477e;
            border-radius: 30px;
            /*background-color: rgb(37, 97, 143);*/
        }

        .tb-d td, .tb-d th {
            background-color: #fff !important;
            text-align: left !important;
            padding: 2px 0 2px 20px !important;
            font-size: 14px !important;
        }
    </style>
</head>
<body style="padding: 30px;">

{{--<header class="clearfix">--}}
{{--    <div id="logo">--}}
{{--        <img src="{{ public_path().'/assets/logos/logo.png' }}">--}}
{{--    </div>--}}
{{--    <div id="company">--}}
{{--        <h2 class="name font-20">{{ $config->name }}</h2>--}}
{{--        <div class="font-14">RUC: {{ $config->ruc }}</div>--}}
{{--        <div class="font-14">{{ $config->addresses }}</div>--}}
{{--        <div class="font-14"><a--}}
{{--                href="tel:{{ json_decode($config->phones)[0] }}">{{ json_decode($config->phones)[0] }}</a></div>--}}
{{--    </div>--}}
{{--</header>--}}

<footer class="font-italic font-14">
    <div id="notices">
        <span>{{ \Carbon\Carbon::today() }}</span>
    </div>
{{--    <div class="num">pág. <span class="pagenum"></span></div>--}}
</footer>

{{--<hr>--}}
<main>

    <h2 class="name mb-3 mt-0 font-18 text-center">
        <u>ACTA DE ENTREGA DE DINERO SEDE PUNO</u>
    </h2>
    <p class="text-right mt-4 mb-4 font-14">Puno,
        <?php
        echo ucfirst(Carbon\Carbon::today()
            ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
        ?>
    </p>

    <b class="name mb-3 mt-5 font-16 text-left">
        <u>INFORME N°02-2022-GRUPO DE INVERSIONES “SUR CAPITAL”.</u>
    </b>

    <table class="mt-3 tb-d w-100">

        <tbody>
        <tr>
            <th class="pl-4 w-20"><b>DE</b></th>
            <th class="pl-0">:</th>
            <td class="pl-0 w-70">
                Sr. JHOSEP MARCELO
                COILA GONZALES
            </td>
        </tr>

        <tr>
            <th class="pl-4 w-20"><b>DEL</b></th>
            <th class="pl-0">:</th>
            <td class="pl-0 w-70">Sr. ANGEL JESUS CASILLA
                GONZALES
            </td>
        </tr>

        <tr>
            <th class="pl-4 w-20"><b>ASUNTO</b></th>
            <th class="pl-0">:</th>
            <td class="pl-0 w-70">Informe Diario de
                INGRESO DE EFECTIVO
            </td>
        </tr>

        <tr>
            <th class="pl-4 w-20"><b>FECHA</b></th>
            <th class="pl-0">:</th>
            <td class="pl-0 w-70">
                <?php
                echo ucfirst(Carbon\Carbon::today()
                    ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
                ?>
            </td>
        </tr>
        </tbody>
    </table>

    <p class="text-justify font-14">Yo, ANGEL JESUS CASILLA GONZALES con DNI 70188569, encargado de la administración y
        caja de la empresa <b>GRUPO DE INVERSIONES “SUR CAPITAL”</b>, procedo hacer parte diario por concepto de ingreso
        de efectivo de la fecha
        <?php
        echo ucfirst(Carbon\Carbon::today()
            ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
        ?>
        al <b>Sr. JHOSEP MARCELO COILA GONZALES</b>, gerente general.</p>


    <table class="mt-3 w-100">
        <tbody>
        <tr>
            <th class="p-1 pl-4  text-left w-10" style="color: #0a4372">
                <span class="font-16">EFECTIVO (S/)</span>
            </th>
            <td class="p-1 pr-4  text-right w-30">
                <?php
                $s = \App\Models\Investment::whereIn('status', ['completed', 'active'])
                    ->where('currency', 1)->whereDate('created_at', \Carbon\Carbon::today())->sum('amount');
                ?>
                {{ 'S/ ' . number_format($s, 2, '.', ',') }}
            </td>
            <td class="w-30"></td>
        </tr>
        <tr>
            <th class="p-1 pl-4  text-left w-10" style="color: #0a4372">
                <span class="font-16">EFECTIVO ($)</span>
            </th>
            <td class="p-1 pr-4 text-right w-30">
                <?php
                $d = \App\Models\Investment::whereIn('status', ['completed', 'active'])
                    ->where('currency', 2)->whereDate('created_at', \Carbon\Carbon::today())->sum('amount');
                ?>
                {{ '$ ' . number_format($d, 2, '.', ',') }}
            </td>
            <td class="w-30"></td>
        </tr>
        </tbody>
    </table>

    <table border="0" cellspacing="0" cellpadding="0" class="font-11">
        <thead>
        <tr>
            <th class="total">#</th>
            <th class="desc">DNI</th>
            <th class="desc">NOMBRES</th>
            <th class="unit">MONTO</th>
            <th class="qty">INGRESO</th>
            <th class="total">RETORNO</th>
        </tr>
        </thead>
        <tbody>
        @if($investments->count() > 0)
            @foreach($investments as $invest)
                <tr>
                    <td class="total">{{ $invest->code }}</td>
                    <td class="desc">{{ $invest->user->dni }}</td>
                    <td class="desc">{{ $invest->user->fullname }}
                    </td>
                    <td class="unit">{{ $invest->amount }}</td>
                    <td class="qty">30</td>
                    <td class="total">{{ $invest->return_amount }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">Ningún ingreso para hoy <?php
                    echo ucfirst(Carbon\Carbon::today()
                        ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
                    ?></td>
            </tr>
        @endif
        </tbody>
    </table>

    <p class="text-justify font-14">A continuación, se procesó a dar fe de los actos mencionados, por ambas partes para
        hacer parte de ingreso de efectivo de la presente fecha.</p>

    <table class="font-14">
        <tr>
            <td class="bg-white pt-5 pb-0">
                <hr>
            </td>
            <td class="bg-white pt-5 pb-0">
                <hr>
            </td>
        </tr>
        <tr>
            <td class="col-md-6 pt-0 bg-white text-center">
                <p class="p-0 m-0">Sr. JHOSEP MARCELO COILA GONZALES</p>
                <p class="p-0 m-0">GERENTE GENERAL</p>
            </td>
            <td class="col-md-6 pt-0 bg-white text-center">
                <p class="p-0 m-0">Sr. ANGEL JESUS CASILLA GONZALES</p>
            </td>
        </tr>
    </table>

</main>

</body>
</html>
