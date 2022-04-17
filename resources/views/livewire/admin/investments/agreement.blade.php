<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $invest->user->lastname }} | {{ $invest->code }} | Contrato</title>
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
    </style>
</head>
<body style="padding: 30px;">

<header class="clearfix">
    <div id="logo">
        <img src="{{ public_path().'/assets/logos/logo.png' }}">
    </div>
    <div id="company">
        <h2 class="name font-20">{{ $config->name }}</h2>
        <div class="font-14">RUC: {{ $config->ruc }}</div>
        <div class="font-14">{{ $config->addresses }}</div>
        <div class="font-14"><a href="tel:{{ json_decode($config->phones)[0] }}">{{ json_decode($config->phones)[0] }}</a></div>
    </div>
</header>

<footer class="font-italic font-14">
    <div id="notices">
        <span>{{ $invest->code }}</span>
    </div>
    <div class="num">pág. <span class="pagenum"></span></div>
</footer>

<hr>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to font-13"><b>DNI: </b>{{ $invest->user->dni }}</div>
            <h2 class="name font-18">{{ $invest->user->fullname }}</h2>
            <div class="address font-14">{{ $invest->user->address . ', ' . $invest->user->city }}</div>
            <div class="email font-14"><a href="tel:{{ $invest->user->mobile }}">{{ $invest->user->mobile }}</a></div>
        </div>
        <div id="invoice">
            <h1 class="font-20" style="margin-bottom: 5px">{{ $invest->code }}</h1>
            <div class="date font-13"><span style="color:#000;">Inicio:</span>

                <?php
                echo ucfirst(Carbon\Carbon::parse($invest->start_date)
                    ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
                ?>

            </div>
            <div class="date font-13"><span style="color:#000;">Culminación:</span>

                <?php
                echo ucfirst(Carbon\Carbon::parse($invest->end_date)
                    ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
                ?>

            </div>
            <div class="date font-11">

                {{ $invest->beetween_days }} dias

            </div>
        </div>
    </div>
    <hr>

    <h2 class="name mb-3 mt-5 font-18 text-center">
        <u>CONTRATO PRIVADO DE INVERSIONES A PLAZO</u>
    </h2>

    <p class="text-justify font-14">La empresa <span>{{ $config->name }}</span> con RUC N° {{ $config->ruc }}, domiciliada en
        el {{ $config->addresses }}, de la ciudad de Puno, en la fecha indicada, ha recibido una inversión, del
        (los/las) Sr. (a) (s): <b>{{ $invest->user->fullname }}</b>.</p>


    {{--    water mark--}}
    {{--    <p class="rotingtxt">Inversiones Sur Capital</p>--}}

    <ul class="font-14">
        <li><b>Por la suma de:</b> {{ $invest->isCurrency->symbol . ' ' . number_format($invest->amount, 2, '.', ',') }}
            con 00/100 {{ $invest->isCurrency->currency }}.
        </li>
        <li><b>Depositados en su cuenta N°:</b></li>
        <li>Monto que devengará una tasa de interés efectiva mensual (fija) Inicial de:
            <b>{{  number_format($invest->isPlan->percent , 0, '.', ',') . '%' }}</b></li>
        <li>Monto que devengará una tasa de interés efectiva anual (fija) inicial
            de: <b>{{ $invest->isPlan->percent * $invest->period . '%' }}</b></li>
        <li class="text-justify">Bajo las condiciones señaladas en el contrato que las condiciones generales de la
            empresa {{ $config->name }} con RUC N° {{ $config->ruc }} y el (los/las) clientes.
        </li>
        <li>Los intereses se calculan en 1 año calendario equivalente a de 365 días.</li>

        <li><b>Plazo: </b>{{ $invest->beetween_days }} dias</li>
        <li><b>Monto total de utilidad a ser
                pagado:</b> {{ $invest->isCurrency->symbol . ' ' . number_format($invest->return_amount * $invest->period , 2, '.', ',') }}
            con 00/100 {{ $invest->isCurrency->currency }}.
        </li>
        <li><b>Monto de utilidad mensual a ser
                pagado:</b> {{ $invest->isCurrency->symbol . ' ' . number_format($invest->return_amount, 2, '.', ',') }}
            con 00/100 {{ $invest->isCurrency->currency }}.
        </li>
        <li><b>Fecha de apertura:</b> <?php
            echo ucfirst(Carbon\Carbon::parse($invest->start_date)
                ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
            ?>
        </li>
        <li><b>Fecha de vencimiento:</b> <?php
            echo ucfirst(Carbon\Carbon::parse($invest->end_date)
                ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
            ?>
        </li>
        <li><b>Modalidad de pago de utilidades:</b> MENSUAL.</li>
    </ul>



{{--    <div class="watermark">SUR CAPITAL</div>--}}




    <p class="text-justify font-14">Con la capacidad y legalidad del contrato de inversión a plazo sobre producción de activo,
        tomado en
        consideración las siguientes clausulas.</p>

    <p class="text-justify font-14"><b><u>PRIMERO:</u></b> Don(ña) <b class="text-uppercase">{{ $invest->user->fullname }}</b>
        entrega en este acto por concepto de inversión al Gerente de INVERSIONES SUR CAPITAL <b class="text-uppercase">Sr.
            JHOSEP MARCELO COILA GONZALES</b>, un capital
        de <b>{{ $invest->isCurrency->symbol . ' ' . number_format($invest->amount, 2, '.', ',') }}</b>
        con 00/100 {{ $invest->isCurrency->currency }}., que reconoce haber recibido y cuyo destino es para un fondo
        inversiones a largo plazo.</p>

    <p class="text-justify font-14"><b><u>SEGUNDO:</u></b> El aporte del inversionista será utilizado a discreción de la EMPRESA
        DE INVERSIONES SUR CAPITAL no siendo necesario el informe de actividades e inversiones de aportes.</p>

    <p class="text-justify font-14"><b><u>TERCERO:</u></b> El contrato no podrá ser divulgado y/o difundido por ningún motivo,
        ya sea a terceros ajenos de la empresa y/o en redes sociales, en caso se diera este, quedará anulado y cancelado
        devolviéndose el monto de inversiones que incluye el descuento de las utilidades pagadas hasta la fecha.</p>

    <p class="text-justify font-14"><b><u>CUARTO:</u></b> El plazo mínimo de contrato es de un año con (365 días calendarios).
        El(la) socio(a) puede realizar operaciones de retiro de dinero al vencimiento o renovación de su inversión
        presentado una solicitud simple y el contrato original. (el plazo de devolución de capital será de 15 días
        hábiles).</p>

    <p class="text-justify font-14"><b><u>QUINTO:</u></b> Si la inversión del 15 al 31 de cada mes tu fecha de pago será del 01
        al 05 de cada mes, si la inversión del 01 al 14 de cada mes tu fecha de pago será 15 al 20 de cada mes, mientras
        se tenga vigente el contrato acordado por ambas partes, iniciándose a partir de la firma del presente contrato.
    </p>

    <p class="text-justify font-14"><b><u>SEXTO: </u></b>El presente contrato queda sujeto a ajustes terminado el plazo y en su
        defecto previo sanción estipulada en la cláusula tercera.</p>



    <h5 class="name mb-3 mt-5 font-16"><b>PENALIDADES</b></h5>

    <p class="text-justify font-14">Toda cancelación antes de su vencimiento será penalizada con el no pago de utilidades,
        conforme a lo siguiente:</p>

    <ul class="font-14">
        <li class="text-justify">Para los plazos entre 61 y 90 días, se penalizará en 60 días de utilidades.</li>
        <li class="text-justify">Para los plazos entre 91 y 180 días, se penalizará con 90 días de utilidades.</li>
        <li class="text-justify">Para los plazos entre 181 y 360 días, se penalizará con 180 días de utilidades.</li>
        <li class="text-justify">Pasados los pagos de penalidades, se pagará la tasa pactada a partir de la dicha
            fecha.
        </li>
        <li class="text-justify">Para la modalidad de abono de utilidades cada 30 días en otra cuenta, el cliente se
            encuentra obligado a
            devolver las utilidades abonadas. En caso de no hacerlo, dicha suma será encargada de capital de la
            inversión al momento de la cancelación.
        </li>
    </ul>

    <h5 class="name mb-3 mt-5 font-16"><b>RENDIMIENTO DE INVERSIONES</b></h5>

    <p class="text-justify font-14">Debido a que las inversiones no cobran comisiones u/o tipo de gastos, el rendimiento
        efectivo de las inversiones se paga en 100%.</p>

    <p class="text-justify font-14">Saldo mínimo de equilibrio para obtener rendimiento: US$ 2,000 o 5,000 soles.</p>

    <p class="text-justify font-14">El cliente puede realizar operaciones de retiro de dinero al vencimiento, cancelación
        anticipada o renovación de su inversión en nuestras oficinas portando su documento de identidad vigente. (el)
        plazo devolución de capital será de 15 días hábiles.</p>

    <p class="text-justify font-14">En caso el cliente haya abierto su inversión con renovación automática al vencimiento, es su
        responsabilidad revisar la tasa vigente en el momento de su renovación. Para esto, puede llamar a nuestra banca
        por teléfono ({{ json_decode($config->phones)[0] }}).</p>

    <p class="text-justify font-14">Declaro haber leído y revisado la constancia de inversión y el contrato que rige las
        condiciones generales de las {{ $config->name }} con RUC N° {{ $config->ruc }}.</p>

    <p class="text-justify font-14">Todas las dudas y consultas relacionadas a estos documentos me fueron absueltas y firmo con
        conocimiento pleno de las condiciones establecidas en dichos documentos.</p>

    <p class="text-right mt-4 mb-4 font-14">Puno,
        <?php
        echo ucfirst(Carbon\Carbon::parse($invest->created_at)
            ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
        ?>
    </p>


    <table>
        <tr>
            <td style="height: 100px; border: 1px solid #e5e5e5;background-color: rgba(129,129,129,0.03)"
                class="col-6"></td>
            <td style="height: 100px; border: 1px solid #e5e5e5;background-color: rgba(129,129,129,0.03)"
                class="col-6"></td>
        </tr>
        <tr>
            <td style="font-size: 12px; text-align: center; border: 1px solid #e5e5e5;">
                <p class="m-0 p-0">GERENTE GENERAL</p>
                <p class="m-0 p-0">INVERSIONES SUR CAPITAL</p>
                <p class="m-0 p-0">JHOSEP MARCELO COILA GONZALES</p>
                <p class="m-0 p-0">DNI N°: 71637845</p>
            </td>
            <td style="font-size: 12px; text-align: center; border: 1px solid #e5e5e5;">
                <p class="m-0 p-0">INVERSIONISTA</p>
                <p class="m-0 p-0 text-uppercase">{{ $invest->user->fullname }}</p>
                <p class="m-0 p-0">DNI N°: {{ $invest->user->dni }}</p>
            </td>
        </tr>
    </table>

    <p class="text-justify font-11">El presente contrato es de uso exclusivo entre SUR CAPITAL con RUC
        N° 10716378450 – CLIENTE,
        en el cual no se implican adquisiciones, obligaciones o beneficios adicionales que no estén estipulados en el
        presente contrato.</p>


    <h2 class="name mb-3 mt-5 font-16 text-center">
        <u>CONTRATO DE ADMINISTRACION DE FONDOS INVERSION (PERSONA NATURAL)</u>
    </h2>

    <p class="text-justify font-14">Conste por el presente documentos, el contrato de administración de fondos inversión que se
        detallan en el anexo a este contrato (el contrato), que celebra de una parte, {{ $config->name }} con RUC N°
        {{ $config->ruc }}, con domicilio en {{ $config->addresses }}, Provincia y departamento de Puno, debidamente
        representado por el promotor cuyos datos figuran en la sección segunda de este documento, a quien en adelante se
        le denominará {{ $config->name }} con y de la otra parte, las(s) persona(s) cuyos datos generales figuran
        igualmente en la sección segunda de éste documentos y a quienes se le denominará PARTICIPE, en los siguientes
        términos y condiciones:</p>

    <h5 class="name mb-3 mt-5 font-16"><b><u>SECCION PRIMERA:</u> CONDICIONES GENERALES</b></h5>
    <style>
        ol {
            counter-reset: item;
        }

        ol > li {
            counter-increment: item;
        }

        ol ol > li {
            display: block;
        }

        ol ol > li:before {
            content: counters(item, ".") ". ";
            margin-left: -38px;
        }
    </style>
    <ol type="I" class="font-14">
        <li class="p-0 m-0 font-italic">
            <b>Clausula primera: de los fondos</b>
            <p class="text-justify" style="font-style: normal;">El presente contrato regula las disposiciones generales
                que les son aplicables a todas las
                inversiones, así como a todos aquellos que serán administrados en futuro por {{ $config->name }} con RUC
                N°
                {{ $config->ruc }}, en adelante LOS FONDOS.</p>
        </li>
        <li class="p-0 m-0 font-italic">
            <b>Clausula segunda: objeto del contrato</b>
            <p class="text-justify" style="font-style: normal;">El objeto del presente contrato es la administración de
                los aportes que el participe
                invertirá en nuestros fondos de inversión, de acuerdo a los términos y condiciones establecidos en el
                presente
                contrato.</p>
        </li>

        <li class="p-0 m-0 font-italic">
            <b>Clausula tercera: suscripción, rescate, transferencia, traspaso, suscripciones
                programas y rescates programados</b>
            <ol style="font-style: normal;" class="mt-1">
                <li class="text-justify">Las suscripciones y su forma de pago, rescates transferencia, traspaso,
                    suscripciones programas y
                    rescates programados, se rigen por las disposiciones de la empresa, los cuales el participe declara
                    conocer
                    y aceptar en su totalidad.
                </li>
                <li class="text-justify">EL PARTICIPE autoriza expresamente a INVERSIONES SUR CAPITAL con RUC N°
                    10716378450 a rescatar los
                    fondos en aquellos casos requeridos por disposición de la empresa por deudas que se mantengan en
                    productos o
                    servicios afines al grupo económico.
                </li>
                <li class="text-justify">EL PARTÍCIPE podrá rescatar sus inversiones, parcial o totalmente, sujeto a los
                    saldos mínimos de
                    permanencia establecidos por INVERSIONES SUR CAPITAL con RUC N° 10716378450. En este sentido,
                    participe
                    acepta que en caso la orden de rescate parcial de participación de los fondos implique que el valor
                    resultante del saldo de la participación del fondo sea inferior al saldo mínimo de permanencia
                    indicado,
                    INVERSIONES SUR CAPITAL con RUC N° 10716378450 podrá tratar a dicha orden de rescate como una
                    solicitud de
                    rescate total de las cuotas de participación del participe en dicho fondo.
                </li>
            </ol>
        </li>
        <br>
        <li class="p-0 m-0 font-italic">
            <b>Clausula cuarto: OBLIGACIONES DE SUR CAPITAL con RUC N° 10716378450 Y EL PARTICIPE</b>
            <ol style="font-style: normal;" class="mt-1">
                <li>Son obligaciones de INVERSIONES SUR CAPITAL con RUC N° 10716378450:</li>
                <ol>
                    <li class="text-justify">Invertir los recursos de los fondos a nombre y por cuenta de estos, según
                        corresponda.
                    </li>
                    <li class="text-justify">Valorizar mensualmente, trimestralmente, semestralmente y anualmente las
                        inversiones de los
                        fondos, respectivamente.
                    </li>
                </ol>
            </ol>

            <ol style="font-style: normal;" class="mt-1">
                <li>Son obligaciones del participe:</li>
                <ol>
                    <li class="text-justify">Cumplir con lo establecido de acuerdo al tiempo de inversión.</li>
                    <li class="text-justify">Informar a INVERSIONES SUR CAPITAL con RUC N° 10716378450 de manera
                        inmediata, por escrito o vía
                        telefónica, todo cambio en los datos consignados en el presente, atreves de la solicitud
                        actualización de datos al contrato de administración o comunicándose al número telefónico
                        (951005920) en caso de utilizar esta última opción, INVERSIONES SUR CAPITAL podrá solicitarte
                        información adiciones para validar sus datos personales asimismo, INVERSIONES SUR CAPITAL podrá
                        poner a disposición del participe otros medios electrónicos (internet o firmas electrónicas)
                        para que el participe pueda actualizar o modificar sus datos, de acuerdo a los establecido en el
                        respectivo prospecto simplificado. El participe deberá cumplir los requisitos que INVERSIONES
                        SUR CAPITAL pueda establecer en el respectivo contrato para ello, asumiendo los riesgos
                        derivados del empleo de estos medios.
                    </li>
                    <li class="text-justify">Solicitar el rescate total o parcial de su inversión, con un plazo
                        anticipado de 15 días
                        hábiles, que a tal efecto le comunique INVERSIONES SUR CAPITAL, en los casos que se refiere a la
                        cláusula decima de este contrato.
                    </li>
                </ol>
            </ol>
        </li>
        <br>
        <li class="p-0 m-0 font-italic">
            <b>Clausula quinta: gastos asumidos por el participe y por los fondos.</b>
            <p class="text-justify" style="font-style: normal;">El participe deberá pagar los gastos y consumos
                detallados por el área de logística de la empresa.</p>
        </li>
        <br>
        <li class="p-0 m-0 font-italic">
            <b>Clausula sexta: declaraciones del participe.</b>
            <p class="text-justify" style="font-style: normal;">El participe declara que:</p>
            <ol style="font-style: normal;">
                <li class="text-justify">Es consciente de los alcances de la operación que realiza al firmar el presente
                    contrato y asume el riesgo derivado de las inversiones que realiza INVERSIONES SUR CAPITAL.
                </li>
                <li class="text-justify">Su incorporación a los fondos importa su plena aceptación y sometimiento a la
                    constancia de inversión correspondiente y demás reglas que regule el funcionamiento de los fondos.
                </li>
                <li class="text-justify">Ha sido debidamente informado por INVERSIONES SUR CAPITAL:
                    <ol>
                        <li class="text-justify">De la política de inversiones de los fondos.</li>
                        <li class="text-justify">De los riesgos asociados a las inversiones que pueda realizar cada uno
                            de los fondos.
                        </li>
                        <li class="text-justify">Que INVERSIONES SUR CAPITAL asegura una rentabilidad futura con
                            sanciones de utilidad devasta un 100% acuerdo al contrato en cartilla de información.
                        </li>
                    </ol>
                </li>
                <li class="text-justify">Ha sido debidamente informado de los aspectos relevantes de los fondos tales
                    como:
                    <ol>
                        <li class="text-justify">El porcentaje correspondiente por el concepto de comisión unificada
                            establecida para los fondos.
                        </li>
                        <li class="text-justify">Los porcentajes de las comisiones de suscripción, transferencia,
                            traspaso y rescate establecidas por los fondos.
                        </li>
                        <li class="text-justify">La totalidad de los gastos asumidos por los fondos.</li>
                        <li class="text-justify">El Plazo para la liquidación de los mismos.</li>
                    </ol>
                </li>
                <li class="text-justify">INVERSIONES SUR CAPITAL difundirá toda la información a los partícipes a través
                    de sus oficinas
                    incluyendo aquellas referidas a la modificación de los contratos de administración, normas vigentes.
                    Así mismo, INVERSIONES SUR CAPITAL enviara a los correos electrónicos de los partícipes, un resumen
                    de las modificaciones aprobadas indicándola fecha de entrada en vigencia de las modificaciones.
                </li>
                <li class="text-justify">En caso no solicite los rescates, habiéndose resuelto el contrato, según se
                    indica en la cláusula novena del presente contrato, en los plazos otorgados, INVERSIONES SUR CAPITAL
                    procesara dichos. Rescates observando el procedimiento establecido en el segundo párrafo de dicha
                    cláusula novena.
                </li>
            </ol>
        </li>
        <br>
        <li class="p-0 m-0 font-italic">
            <b>Clausula séptima: Domicilio.</b>
            <p class="text-justify" style="font-style: normal;">Las partes señalan como sus domicilios los indicados al
                realizar el presente documentos, respectivamente, al cual se dirigirá toda la comunicación escrita,
                notificación judicial o extrajudicial.</p>
        </li>
        <br>
        <li class="p-0 m-0 font-italic">
            <b>Clausula octava: tratamiento de información.</b>
            <ol style="font-style: normal;">
                <li class="text-justify">El participe declara y reconoce que de acuerdo a la ley N° 29733 ley de
                    protección de datos personales su reglamento aprobado mediante decreto supremo N°0032013-JUS y las
                    demás disposiciones
                    complementarias otorga su consentimiento para que INVERSIONES SUR CAPITAL trata la información que
                    este le ha entregado sobre su situación personal financiera y económica “en adelante la
                    “información”) con la finalidad de ejecutar la contractual que origina este contrato el participe
                    reconoce que estarán incluidos dentro de su información todos aquellos datos y referencias a los que
                    INVERSIONES SUR CAPITAL pudiera acceder en el curso normal de sus operaciones ya sea por haber sido
                    proporcionados por el participe o por terceros o por haber sido desarrollados por (en adelante la
                    información INVERSIONES SUR CAPITAL a que se encuentren tanto en forma física, oral o electrónica y
                    que pidieran calificar como datos personales conforme la legislación de la materia. En virtud de lo
                    señalado, el participe expresamente a INVERSIONES SUR CAPITAL a incorporar su información al grupo
                    económico de datos personales de clientes de responsabilidad de este; que, en este sentido,
                    almacenar, dar tratamiento procesar y transferir información a las empresas que conforma su grupo
                    económico, conforme a los procedimientos que INVERSIONES SUR CAPITAL determina el marco de sus
                    operaciones habituales, para efectos de los fines señalados en este párrafo. El término “dar
                    tratamiento” tiene para estos efectos, el significado contenido en el artículo 2 numeral 17 de la
                    ley N° 29733, ley de protección de datos personales y señalado por la ley N° 29233 ley de protección
                    de datos personales.
                </li>
                <li class="text-justify">Así mismo, el participe autoriza INVERSIONES SUR CAPITAL a utilizar la
                    información, afectos de:
                    <ol>
                        <li class="text-justify">I. Ofrecer la alternativa de inversión en cualquiera de los fondos de
                            inversión que este administre, a través de cualquiera de los medios establecidos en este
                            contrato.
                        </li>
                        <li class="text-justify">II. Ofrecerle, a través de cualquier medio escrito, verbal, electrónico
                            y/o informático, cualquier otro producto o servicios de las empresas que conforman su grupo
                            económico.
                        </li>
                    </ol>
                </li>
                <li class="text-justify">Transferir a las empresas que conforman su grupo económico, afectos de que cada
                    una de ellas pueda ofrecer sus productos o servicios, a través de cualquier medio escrito, verbal,
                    electrónico y/o informático. El participe reconoce haber sido informado que su información podrá ser
                    conservada, tratada, trasferida por INVERSIONES SUR CAPITAL hasta diez años después de que finalice
                    su relación contractual con INVERSIONES SUR CAPITAL. El participe puede ejercer sus derechos de
                    acceso, rectificación, cancelación y oposición, siempre que cumpla con sus requisitos exigidos por
                    las normas aplicables, dirigiéndose de forma presencial a las oficinas de sus agentes colocadores y
                    de INVERSIONES SUR CAPITAL a nivel nacional en el horario establecido por la atención al público.
                </li>
                <li class="text-justify">El participe puede revocar su consentimiento a tratamiento de sus datos, en
                    cualquier momento durante la vigencia de este contrato y con posterioridad a su resolución. El
                    participe podrá solicitar la revocación de su consentimiento en forma presencial y por escrito en
                    cualquier de sus oficinas en el horario establecido.
                </li>
                <li class="text-justify">Anterior. INVERSIONES SUR CAPITAL tendrá un plazo de quince días hábiles,
                    contados a partir del día hábil siguiente de presentada la solicitud de revocatoria para dar trámite
                    a la solicitud de revocatoria y conformar al partícipe de ello, no obstante, lo anterior, el plazo
                    antes señalado podrá ser ampliado por INVERSIONES SUR CAPITAL por causa fundamentada, por una sola
                    vez y por un plazo adicional igual al original, previa comunicación al participe.
                </li>
            </ol>
        </li>
    </ol>

    <p class="text-right mt-4 mb-4 font-14">Puno,
        <?php
        echo ucfirst(Carbon\Carbon::parse($invest->created_at)
            ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
        ?>
    </p>

    <table>
        <tr>
            <td style="height: 100px; border: 1px solid #e5e5e5;background-color: rgba(129,129,129,0.03)"
                class="col-6"></td>
            <td style="height: 100px; border: 1px solid #e5e5e5;background-color: rgba(129,129,129,0.03)"
                class="col-6"></td>
        </tr>
        <tr>
            <td style="font-size: 12px; text-align: center; border: 1px solid #e5e5e5;">
                <p class="m-0 p-0">GERENTE GENERAL</p>
                <p class="m-0 p-0">INVERSIONES SUR CAPITAL</p>
                <p class="m-0 p-0">JHOSEP MARCELO COILA GONZALES</p>
                <p class="m-0 p-0">DNI N°: 71637845</p>
            </td>
            <td style="font-size: 12px; text-align: center; border: 1px solid #e5e5e5;">
                <p class="m-0 p-0">INVERSIONISTA</p>
                <p class="m-0 p-0 text-uppercase">{{ $invest->user->fullname }}</p>
                <p class="m-0 p-0">DNI N°: {{ $invest->user->dni }}</p>
            </td>
        </tr>
    </table>

</main>

</body>
</html>
