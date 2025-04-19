@extends('layouts.app', ['breadcrumbs' => [
['href'=> route('dashboard'), 'text'=> 'Dashboard', 'active'],
]])

@section('content')
<div class="py-4">
    <div class="spacer-lg">
        @livewire('dashboard-data-cards')
    </div>

    <div class="my-8">
        @livewire('set-academic-year')
    </div>

    @if (auth()->user()->hasRole('student'))
    <div class="mt-8"> <!-- Added margin top for more spacing -->
        <a href="{{route('students.print-profile',auth()->user()->id)}}" aria-label="Download Profile">
            <div class="card bg-purple-500 dark:bg-purple-600 text-white md:text-2xl">
                <div class="card-body flex gap-6 items-center justify-center p-8"> <!-- Increased gap and padding -->
                    <i class="fa fa-download text-2xl" aria-hidden="true"></i> <!-- Increased icon size -->
                    <p class="font-bold text-xl">Download Profile</p> <!-- Increased text size -->
                </div>
            </div>
        </a>
    </div>
    @endif
</div>
@endsection