<div class="card border rounded-0" style="border-color: grey;">
    <?php
    $money = ['price', 'total', 'subtotal', 'amount'];
    $fld = ['not', 'status', 'image', 'activated', 'progress', 'for_percent', 'type'];
    $lnk = ['url', 'link', 'mobile', 'phone', 'email', 'whatsapp', 'website'];
    $dtes = ['created_at', 'updated_at', 'start_date', 'end_date'];
    ?>
    <div class="card-body" style="overflow-x: auto">
        {{ $results->links('livewire.widgets.admin.table.detail-pagination') }}
        <div class="scrollbar scroller">
            <table class="table table-hover responsive">
                <thead class="thead-light">
                <tr>
                    @foreach($headers as $key => $header)
                        @if($key != 'not')
                            <th class="align-middle">
                                <a href="javascript:;" wire:click.prevent="changeSort('{{ $key }}')"
                                   class="{{ $fieldSort == $key ? ' text-primary' : '' }} text-uppercase"
                                   style="white-space: nowrap;">
                                    {{ $header }}
                                    <i class="fas {{ $fieldSort == $key ? $iconSort.' text-primary' : 'fas fa-sort' }}"></i>
                                </a>
                            </th>
                        @else
                            <th class="text-dark align-middle text-center">
                                {{ $header }}
                            </th>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>

                @foreach($results as $result)
                    <tr>
                        @foreach(array_keys($headers) as $header)
                            <th class="align-middle" scope="row">
                                @if(!in_array($header, array_merge($money, $fld, $lnk, $dtes)))
                                    {{ $result[$header] }}
                                @elseif($header == 'image')
                                    <div class="text-center">
                                        <img src="{{ asset($path) . '/' . $result[$header] }}" style="height: 70px;"
                                             class="img-thumbnail" alt="{{ $result[$header] }}">
                                    </div>
                                @elseif(in_array($header, ['type']))
                                    {{ $statusOther[$result[$header]] }}
                                @elseif(in_array($header, ['status', 'activated']))
                                    @if(isset($_statusIndex) && !empty($_statusIndex))
                                        <span
                                            class="badge {{ (int)$result[$header]?'badge-success-1':'badge-danger-1' }}">
                                       {{ $_statusIndex[$result[$header]] }}
                                    </span>
                                    @elseif(isset($_status) && !empty($_status))
                                        <span class="rounded-0 badge badge-{{ $result[$header] }}">
                                           {{ $_status[$result[$header]] }}
                                        </span>
                                    @else
                                        <span class="rounded-0 badge {{ $result[$header] }}">
                                           {{ $result[$header] }}
                                        </span>
                                    @endif
                                @elseif(in_array($header, ['total', 'amount']))
                                    <p class="w-100 text-right">
                                        {{ isset($currencies) && !empty($currencies) ? $result->isCurrency->symbol : 'S/ ' }}
                                        {{ number_format($result[$header], 2, '.', ',') }}
                                    </p>
                                @elseif(in_array($header, ['mobile', 'phone']))
                                    <a href="tel:{{ $result[$header] }}">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['website', 'url', 'link']))
                                    <a href="{{ $result[$header] }}" target="_blank">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['email']))
                                    <a href="mailto:{{ $result[$header] }}">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['whatsapp']))
                                    <a href="https://api.whatsapp.com/send?phone=51{{ $result[$header] }}"
                                       target="_blank">{{ $result[$header] }}</a>

                                @elseif(in_array($header, ['created_at', 'updated_at', 'start_date', 'end_date']))
                                    <?php
                                    if (isset($humanDiff) && !empty($humanDiff)) {
                                        echo ucfirst(Carbon\Carbon::parse($result[$humanDiff])
                                            ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y | g:i:s A'));
                                    } else {
                                        echo ucfirst(Carbon\Carbon::parse($result[$header])
                                            ->format('Y-m-d'));
                                    }
                                    ?>

                                @elseif(in_array($header, ['progress', 'for_percent']))
                                    @if(in_array($result->status, ['active', /*'inactive',*/ 'completed', 'canceled']))
                                        @if($result->remaining_hours == 0)

                                            @if($result->payment_date)
                                                Reembolsado
                                            @else
                                                Completado
                                            @endif
                                        @elseif($result->status == 'canceled')
                                            Cancelado
                                        @else
                                            {{ intdiv($result->remaining_hours, 24) . ' días, ' . ($result->remaining_hours % 24) . ' horas' }}
                                        @endif

                                        <?php
                                        $percent = $result->percent;

                                        $prc = $result->percent > 97 ? '#317347' : '#1D477A';

                                        if ($result->status == 'canceled') {
                                            $prc = '#f63c44';
                                            $percent = 0.00;
                                        }
                                        ?>

                                        <div class="progress-outer" style="border-color:{{ $prc }};">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped"
                                                     style="width:{{ $percent }}%; background-color: {{ $prc }};"></div>
                                                <div class="progress-value" style="color: {{ $prc }};">
                                                    <span>{{ $percent }}</span>%
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                    @elseif(in_array($result->status, ['canceled']))--}}
                                        {{--                                        <span class="rounded-0 badge badge-canceled">--}}
                                        {{--                                               inactivo--}}
                                        {{--                                            </span>--}}
                                    @else
                                        @if($result->amount > 0)
                                            <span class="rounded-0 badge badge-success-1">
                                               requiere activar
                                            </span>
                                        @else
                                            <span class="rounded-0 badge badge-inactive">
                                               sin fondos
                                            </span>
                                        @endif
                                    @endif

                                @elseif($header == 'not')

                                    @if(isset($customs) && !empty($customs))
                                        @include('livewire.widgets.admin.table.custom-actions')
                                    @endif

                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-secondary btn-xs" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                            <i class="simple-icon-settings"
                                               style="font-size: 14px; position: absolute; margin-top: -7px"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-secondary btn-xs dropdown-toggle {{-- dropdown-toggle-split--}}"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{--                                        <i class="fe-plus" style="font-size: 18px; position: relative; top: 2px"></i>--}}
                                        </button>

                                        <div class="dropdown-menu">
                                            @include('livewire.widgets.admin.table.actions')
                                        </div>
                                    </div>

                                @endif
                            </th>
                        @endforeach
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
        <div class="separator mt-2"></div>
        <div class="wrap-pagination-info mt-0 pt-0">
            {{ $results->links('livewire.widgets.admin.table.pagination') }}
        </div>
    </div>

</div>

