@extends('layouts.admin.app')
@section('title', 'Schedule Program')
@section('content')
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Jadwal Program Class</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th rowspan="2" class="text-center bg-dark text-light">Hari - Kelas</th>
                                    @foreach ($data['hari'] as $hari)
                                        <th colspan="{{ count($data['waktu']) }}" class="text-center text-capitalize bg-dark text-light">
                                            {{ $hari }}
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    {{-- <th></th> --}}
                                    @foreach ($data['hari'] as $hari)
                                        @foreach ($data['waktu'] as $waktu)
                                            <th class="bg-primary">{{ $waktu }}</th>
                                        @endforeach
                                    @endforeach
                                </tr>
                                @foreach ($data['kelas'] as $key => $kelas)
                                    <tr>
                                        <th class="bg-dark text-light">{{ $key }}</th>
                                        @foreach ($kelas as $k)
                                            @foreach ($k as $l)
                                                @if ($l == 0)
                                                    <td class="text-center">-</td>
                                                @else
                                                    <td class="bg-danger text-center" style="cursor: pointer" onclick="alert('clicked')">Ada</td>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
