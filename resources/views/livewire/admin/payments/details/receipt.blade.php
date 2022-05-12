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
<body>

<div style="border: 3px solid rgba(17,39,92,0.34); border-radius: 25px; padding: 20px 30px;">
    <header class="clearfix">
        <div id="logo">
            <img src="{{ public_path().'/assets/logos/logo.png' }}"
                 style="width: 66px !important;height: 66px !important;">
        </div>
        <div class="pl-2 mt-1">
            <h2 class="name font-18">{{ $config->name }}</h2>
            <div class="font-11">RUC: {{ $config->ruc }}</div>
            <div class="font-11">{{ $config->addresses }}</div>
            <div class="font-11"><a
                    href="tel:{{ json_decode($config->phones)[0] }}">{{ json_decode($config->phones)[0] }}</a></div>
        </div>

        <div id="company" style="margin-top: -75px !important; padding-top: 0 !important;">
            <h2 class="name font-24"><u>RECIBO DE EGRESOS</u></h2>
            <div class="font-16" style="color: grey">Nro:
                <span>{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="font-22 text-primary" style="margin-top: -8px">
                {{ $payment->isCurrency->symbol }}
                {{ number_format($payment->amount, 2, '.', ',') }}
            </div>
        </div>
    </header>
    <hr>
    <main>

        <p class="text-justify mb-0 font-16"><b>Entregué al Sr(a):</b>
            <span style="color: #6a6a6a;">{{ $payment->investment->user->fullname }}</span>.
        </p>

        <p class="text-justify mb-0 font-16"><b>La suma de:</b>
            <span
                style="color: #6a6a6a;">{{ $payment->isCurrency->symbol }} {{ number_format($payment->amount, 2, '.', ',') }}</span>.
        </p>

        <p class="text-justify mb-0 font-16"><b>Por concepto de:</b>
            <span style="color: #6a6a6a;">
                <?php
                $type_bonus = [
                    'referred' => 'Referido',
                    'reself' => 'Referido de 30K a si mismo',
                    'invest' => 'Bonus por mayor a 30K',
                ];

                $type_paid = [
                    'return' => 'Pago de retorno mesual',
                    'capital' => 'Pago de capital',
                ];

                if ($payment->toBonus) {
                    $type_paid = array_merge(
                        ['bonus' => 'Por bonus ' . $type_bonus[$payment->toBonus->type]
                            . ' de ' . number_format($payment->toBonus->percent, 0) . '%'], $type_paid);
                }

                ?>
                {{ $type_paid[$payment->type_payment] }}.
            </span>
        </p>

        <p class="text-right mt-3 mb-4 font-14">Puno,
            <?php
            echo ucfirst(Carbon\Carbon::now()
                ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
            ?>
        </p>

        <table class="font-14">
            <tr>
                <td class="bg-white pt-4 pb-0">
                    <hr>
                </td>
                <td class="bg-white pt-4 pb-0">
                    <hr>
                </td>
            </tr>
            <tr class="p-0 m-0 font-11 text-uppercase">
                <td class="col-md-6 p-0 m-0 bg-white text-center">
                    <p class="p-0 m-0">RECIBIDO CONFORME</p>
                    <p class="p-0 m-0">{{ $payment->investment->user->fullname }}</p>
                    <p class="p-0 m-0">DNI: {{ $payment->investment->user->dni }}</p>
                </td>
                <td class="col-md-6 p-0 m-0 bg-white text-center">
                    <p class="p-0 m-0">ENTREGUÉ CONFORME</p>
                    <p class="p-0 m-0">Sr. ANGEL JESUS CASILLA GONZALES</p>
                    <p class="p-0 m-0">DNI: 70188069</p>
                </td>
            </tr>
        </table>
    </main>
</div>
<hr>
<div style="border: 3px solid rgba(17,39,92,0.34); border-radius: 25px; padding: 20px 30px;">
    <header class="clearfix">
        <div id="logo">
            <img src="{{ public_path().'/assets/logos/logo.png' }}"
                 style="width: 66px !important;height: 66px !important;">
        </div>
        <div class="pl-2 mt-1">
            <h2 class="name font-18">{{ $config->name }}</h2>
            <div class="font-11">RUC: {{ $config->ruc }}</div>
            <div class="font-11">{{ $config->addresses }}</div>
            <div class="font-11"><a
                    href="tel:{{ json_decode($config->phones)[0] }}">{{ json_decode($config->phones)[0] }}</a></div>
        </div>

        <div id="company" style="margin-top: -75px !important; padding-top: 0 !important;">
            <h2 class="name font-24"><u>RECIBO DE EGRESOS</u></h2>
            <div class="font-16" style="color: grey">Nro:
                <span>{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="font-22 text-primary" style="margin-top: -8px">
                {{ $payment->isCurrency->symbol }}
                {{ number_format($payment->amount, 2, '.', ',') }}
            </div>
        </div>
    </header>
    <hr>
    <main>

        <p class="text-justify mb-0 font-16"><b>Entregué al Sr(a):</b>
            <span style="color: #6a6a6a;">{{ $payment->investment->user->fullname }}</span>
        </p>

        <p class="text-justify mb-0 font-16"><b>La suma de:</b>
            <span
                style="color: #6a6a6a;">{{ $payment->isCurrency->symbol }} {{ number_format($payment->amount, 2, '.', ',') }}</span>
        </p>

        <p class="text-justify mb-0 font-16"><b>Por concepto de:</b>
            <span style="color: #6a6a6a;">
            Pago por retorno mensual.
            </span>
        </p>

        <p class="text-right mt-3 mb-4 font-14">Puno,
            <?php
            echo ucfirst(Carbon\Carbon::now()
                ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
            ?>
        </p>

        <table class="font-14">
            <tr>
                <td class="bg-white pt-4 pb-0">
                    <hr>
                </td>
                <td class="bg-white pt-4 pb-0">
                    <hr>
                </td>
            </tr>
            <tr class="p-0 m-0 font-11 text-uppercase">
                <td class="col-md-6 p-0 m-0 bg-white text-center">
                    <p class="p-0 m-0">RECIBIDO CONFORME</p>
                    <p class="p-0 m-0">{{ $payment->investment->user->fullname }}</p>
                    <p class="p-0 m-0">DNI: {{ $payment->investment->user->dni }}</p>
                </td>
                <td class="col-md-6 p-0 m-0 bg-white text-center">
                    <p class="p-0 m-0">ENTREGUÉ CONFORME</p>
                    <p class="p-0 m-0">Sr. ANGEL JESUS CASILLA GONZALES</p>
                    <p class="p-0 m-0">DNI: 70188069</p>
                </td>
            </tr>
        </table>
    </main>
</div>

{{--<footer class="font-italic font-14">--}}
{{--    <div id="notices">--}}
{{--        <span>{{ \Carbon\Carbon::today() }}</span>--}}
{{--    </div>--}}
{{--    --}}{{--    <div class="num">pág. <span class="pagenum"></span></div>--}}
{{--</footer>--}}

{{--<hr>--}}


</body>
</html>

