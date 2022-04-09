<div class="card border rounded-0" style="border-color: grey;">
    <?php
    $money = ['price', 'total', 'subtotal'];
    $fld = ['not', 'status', 'image', 'activated', 'progress'];
    $lnk = ['url', 'link', 'mobile', 'phone', 'email', 'whatsapp', 'website']
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
                                @if(!in_array($header, array_merge($money, $fld, $lnk)))
                                    {{ $result[$header] }}
                                @elseif($header == 'image')
                                    <div class="text-center">
                                        <img src="{{ asset($path) . '/' . $result[$header] }}" style="height: 70px;"
                                             class="img-thumbnail" alt="{{ $result[$header] }}">
                                    </div>
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
                                @elseif($header == 'total')
                                    <p>S/ {{ number_format($result[$header], 2, '.', ',') }}</p>
                                @elseif(in_array($header, ['mobile', 'phone']))
                                    <a href="tel:{{ $result[$header] }}">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['website', 'url', 'link']))
                                    <a href="{{ $result[$header] }}" target="_blank">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['email']))
                                    <a href="mailto:{{ $result[$header] }}">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['whatsapp']))
                                    <a href="https://api.whatsapp.com/send?phone=51{{ $result[$header] }}"
                                       target="_blank">{{ $result[$header] }}</a>
                                @elseif(in_array($header, ['progress']))
                                    <?php
                                    $prc = $result[$header] > 97 ? '#317347' : '#1D477A';
                                    if ($result->status == 'canceled') {
                                        $prc = '#f63c44';
                                    }
                                    ?>
                                    {{--                                <div class="progress progress-custom">--}}
                                    {{--                                    <div class="progress-bar progress-bar-striped progress-bar-animated"--}}
                                    {{--                                         style="width: {{ $result[$header] }}%; background-color: #{{ $prc }};">--}}
                                    {{--                                        {{ $result[$header] }}%--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}

                                    <div class="progress-outer" style="border-color:{{ $prc }};">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped"
                                                 style="width:{{ $result[$header] }}%; background-color: {{ $prc }};"></div>
                                            <div class="progress-value" style="color: {{ $prc }};">
                                                <span>{{ $result[$header] }}</span>%
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

