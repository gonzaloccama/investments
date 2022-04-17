<div class="card border rounded-0" style="border-color: grey;">
    <?php
    $money = ['amount'];
    $fld = ['not', 'status', 'progress', 'for_percent'];
    $lnk = ['mobile', 'email'];
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
                                @elseif(in_array($header, ['status']))
                                    @if(isset($_status) && !empty($_status))
                                        <span class="rounded-0 badge badge-{{ $result[$header] }}">
                                           {{ $_status[$result[$header]] }}
                                        </span>
                                    @endif
                                @elseif(in_array($header, ['amount']))
                                    <p class="w-100 text-right">
                                        {{ isset($currencies) && !empty($currencies) ? $result->isCurrency->symbol : 'S/ ' }}
                                        {{ number_format($result[$header], 2, '.', ',') }}
                                    </p>
                                @elseif(in_array($header, ['mobile']))
                                    <a href="tel:{{ $result[$header] }}">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['email']))
                                    <a href="mailto:{{ $result[$header] }}">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['created_at', 'updated_at', 'start_date', 'end_date']))
                                    <?php
                                    echo ucfirst(Carbon\Carbon::parse($result[$header])
                                        ->format('Y-m-d'));
                                    ?>

                                @elseif(in_array($header, ['progress', 'for_percent']))


                                        <?php

                                        $prc = $result->percent > 97 ? '#317347' : '#1D477A';

                                        if ($result->remaining_hours <= 0) {
                                            echo 'completado';
                                        } else {
                                           echo intdiv($result->remaining_hours, 24) . ' días, ' . ($result->remaining_hours % 24) . ' horas';
                                        }
                                        ?>

                                        <div class="progress-outer" style="border-color:{{ $prc }};">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped"
                                                     style="width:{{ $result->percent }}%; background-color: {{ $prc }};"></div>
                                                <div class="progress-value" style="color: {{ $prc }};">
                                                    <span>{{ $result->percent }}</span>%
                                                </div>
                                            </div>
                                        </div>


                                @elseif($header == 'not')

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

                                    @if(isset($customs) && !empty($customs))
                                        @include('livewire.widgets.admin.table.custom-actions')
                                    @endif
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
