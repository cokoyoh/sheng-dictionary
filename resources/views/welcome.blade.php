@extends('layouts.app')

@section('content')
    <div class="bg-gray-200">
        <div class="container mx-auto w-1/2 pt-5">
            <word-definition :word="{title: 'Sipite', dislikes: 24563}"></word-definition>
            <word-definition :word="{title: 'Doktari', likes: 200}"></word-definition>
        </div>
    </div>
@endsection
