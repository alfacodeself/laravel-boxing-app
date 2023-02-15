@extends('layouts.admin.app')
@section('title', 'Account Trainer')
@section('content')
    <div class="container-fluid">
        <x-admin.form.form :method="'POST'" :route="route('trainer.account.store')">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    @include('layouts.admin.alert')
                    <x-admin.card :title="'Akun Trainer - ' . $account->trainer->nama">
                        <x-admin.form.input type="email" label='Email' name="email" edit="{{ $account->email }}" placeholder="Email" />
                        <x-admin.form.input type="password" attr="autocomplete=new-password" label='Old Password' name="old_password" placeholder="Old Password" />
                        <x-admin.form.input type="password" attr="autocomplete=new-password" label='New Password' name="new_password" placeholder="New Password" />
                        <x-admin.form.input type="password" attr="autocomplete=new-password" label='Confirm Password' name="new_password_confirmation" placeholder="Confirm Password" />
                            
                        <x-admin.form.submit classes="btn-dark rounded-3" name="Ubah Akun Trainer" />
                    </x-admin.card>
                </div>
            </div>
        </x-admin.form.form>
    </div>
@endsection
