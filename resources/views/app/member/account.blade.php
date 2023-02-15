@extends('layouts.admin.app')
@section('title', 'Account Member')
@section('content')
    <div class="container-fluid">
        @include('layouts.admin.alert')
        <x-admin.form.form :method="'POST'" :route="route('member.account.store')">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <x-admin.card :title="'Akun Member - ' . $account->member->nama">
                        <x-admin.form.input type="email" label='Email' name="email" edit="{{ $account->email }}" placeholder="Email" />
                        <x-admin.form.input type="password" attr="autocomplete=new-password" label='Old Password' name="old_password" placeholder="Old Password" />
                        <x-admin.form.input type="password" attr="autocomplete=new-password" label='New Password' name="new_password" placeholder="New Password" />
                        <x-admin.form.input type="password" attr="autocomplete=new-password" label='Confirm Password' name="new_password_confirmation" placeholder="Confirm Password" />
                            
                        <x-admin.form.submit classes="btn-dark rounded-3" name="Ubah Akun Member" />
                    </x-admin.card>
                </div>
            </div>
        </x-admin.form.form>
    </div>
@endsection
