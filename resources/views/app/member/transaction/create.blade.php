@extends('layouts.admin.app')
@section('title', 'Buat Transaksi')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <form action="{{ route('member.transaction.store', $id) }}" method="POST">
            @csrf
            <div class="row">
                <h4>Channel Pembayaran</h4>
                @forelse ($channels as $channel)
                    <div class="col-lg-3">
                        <label>
                            <input type="radio" name="method" value="{{ $channel->code }}" class="card-input-element" />
                            <div class="card card-default card-input px-3 py-1">
                                <div class="card-title text-center">{{ $channel->group }}</div>
                                <img style="width: 100%; height: 70px;" src="{{ $channel->icon_url }}" alt="Card image cap">
                                <div class="card-body">
                                    {{ $channel->name }}
                                </div>
                            </div>
                        </label>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body">Tidak ada channel pembayaran!</div>
                    </div>
                @endforelse
            </div>
            <button type="submit" class="btn btn-dark d-block w-100 rounded-3">Buat Transaksi</button>
        </form>
    </div>
@endsection
@push('css')
    <style>
        label {
            width: 100%;
        }

        .card-input-element {
            display: none;
        }

        .card-input {
            /* margin: 10px; */
            padding: 0px;
        }

        .card-input:hover {
            cursor: pointer;
        }

        .card-input-element:checked+.card-input {
            box-shadow: 0 0 1px 1px #2ecc71;
        }
    </style>
@endpush
