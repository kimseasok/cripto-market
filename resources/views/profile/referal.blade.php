@extends('layouts.user')
@section('content')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('level1') }}
    </h2>
</x-slot>

<div id="referal-page">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="dark:text-white text-xl text-center items-center mb-8">RECOMMEND FRIENDS<br />AND EARN UP TO 35% COMMISSION</h2>
        <div class="rq flex item-center">
            {!! QrCode::size(300)->generate("https://cityindexx.com/{{$user->username}}") !!}
        </div>
        <div class="download-button my-8 text-center"><button class="btn btn-primary">DOWNLOAD</button></div>
        <div class="mt-5 relative">
            <label for="ref-code">Referal code</label>
            <input type="text" class="w-full" value="{{$user->username}}" disabled>
            <i class="bi bi-files absolute"></i>
        </div>
        <div class="mt-5 relative">
            <label for="ref-link">Referal link</label>
            <input type="text" class="w-full" value="https://cityindexx.com/register/{{$user->username}}" disabled>
            <i class="bi bi-files absolute"></i>
        </div>
    </div>

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="InvestPlan" data-tabs-toggle="#InvestPlanContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="level1-tab" data-tabs-target="#level1" type="button" role="tab" aria-controls="level1" aria-selected="false">Level</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="level2-tab" data-tabs-target="#level2" type="button" role="tab" aria-controls="level2" aria-selected="false">Level 2</button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="level3-tab" data-tabs-target="#level3" type="button" role="tab" aria-controls="level3" aria-selected="false">Level 3</button>
            </li>
        </ul>
    </div>
    <div id="InvestPlanContent">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="level1" role="tabpanel" aria-labelledby="level1-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">10% of the handling fee D: 100x0.01=10</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="level2" role="tabpanel" aria-labelledby="level2-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">25% of the handling fee C: 100x0.25=25</p>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="level3" role="tabpanel" aria-labelledby="level3-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">35% of handling fee B: 100x0.35=35</p>
        </div>
    </div>


</div>
@endsection