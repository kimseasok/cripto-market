@extends('layouts.user')
@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('level1') }}
    </h2>
</x-slot>

<div id="referal-page">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="dark:text-white text-xl text-center items-center">PLEASE CONTACT US</h2>
        <p class="text-center">We only provide the telegram chat support! Please contact via <a href="https://t.me/CITYINDEX08" target="_blank" class="font-medium">Telegram</a> or <br>
            scan the below QR
        </p>
        <div class="rq flex item-center mt-5">
            {!! QrCode::size(300)->generate("https://cityindexx.com/{{$user->username}}") !!}
        </div>

        <p class="text-center mt-5"><a href="https://t.me/CITYINDEX08" target="_blank" class="btn btn-primary"><i class="bi bi-send"></i>Click here to chat</a></p>
    </div>
    @endsection