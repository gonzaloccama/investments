<?php
$exclude = ['not', 'amount', 'unit', 'type_file', 'user_id'];
$_files = ['document' => 'PDF', 'image' => 'Imagen']
?>
<table class="table table-striped responsive">
    <thead>
    <tr>
        @foreach($hdrs as $key => $hdr)
            @if($key != 'not')
                <th>
                    <a href="javascript:;" class="text-uppercase ">
                        {{ $hdr }}
                    </a>
                </th>
            @else
                <th class="text-dark">
                    {{ $hdr }}
                </th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody>

    @foreach($dts as $dt)
        <tr>
            @foreach(array_keys($hdrs) as $hdr)
                @if($hdr == 'id')
                    <th class="align-middle" scope="row">
                        {{ $dt[$hdr] }}
                    </th>
                @else
                    <td class="align-middle" scope="row">
                        @if(!in_array($hdr, $exclude))
                            {{ $dt[$hdr] }}
                        @elseif(in_array($hdr, ['type_file']))
                            <a href="#" class="btn btn-link font-weight-bold"
                               wire:click.prevent="openFile({{ $dt->id }}, '{{ $show }}')">{{ $_files[$dt[$hdr]] }}</a>
                        @elseif($hdr == 'amount')
                            {{ __('S/ ') . number_format($dt[$hdr], 2, '.', ',') }}
                        @elseif($hdr == 'unit')
                            {{ $dt[$_unit][$hdr] }}

                        @elseif($hdr == 'user_id')
                            @if(isset($fllname) && !empty($fllname))
                                {{ $dt->user->fullname }}
                            @else
                                {{ $dt[$_unit][$hdr] }}
                            @endif

                        @elseif($hdr == 'not')
                            <button class="btn btn-outline-dark icon-button btn-xs"
                                    wire:click.prevent="{{ $deletion }}({{ $dt->id }}, '{{ $show }}')">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif
                    </td>
                @endif

            @endforeach
        </tr>

    @endforeach


    </tbody>
</table>
