@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="lg:w-2/3 lg:mx-auto bg-white p-6 py-12 md:px-6 rounded">
            <h1 class="text-2xl font-normal text-center">Define a new word</h1>
            <form method="post" action="{!! route('words.store') !!}">
                @csrf
                <div class="field mb-6">
                    <label for="title" class="label text-sm mb-2 block">Word</label>
                    <div class="control">
                        <input type="text" value="" name="title" required="required"
                               placeholder="Doktari"
                               class="focus:outline-none text-gray-800 px-4 py-4
                               leading-6 bg-transparent border border-gray-300 rounded px-3 py-4 text-sm w-full">
                    </div>
                </div>
                <div class="field mb-6">
                    <label for="description" class="label text-sm mb-2 block">Definition</label>
                    <div class="control">
                        <textarea rows="6" name="description" required="required"
                                  placeholder="- A person who prevents you from eating nyama."
                                  class="focus:outline-none text-gray-700 px-4 py-4 leading-6 bg-transparent border border-gray-300 rounded p-2 text-sm w-full">

                        </textarea>
                    </div>
                </div>

                <div class="field mb-6">
                    <label for="examples" class="label text-sm mb-2 block">Examples</label>
                    <div class="control">
                        <textarea rows="5" name="examples" required="required"
                                  placeholder="- Umeona doktari hapa?"
                                  class="focus:outline-none text-gray-700 px-4 py-4 leading-6 bg-transparent border border-gray-300 rounded p-2 text-sm w-full">

                        </textarea>
                    </div>
                </div>

                <div class="field mb-6">
                    <button type="submit" class="bg-gray-900 text-gray-300 px-4 py-2 rounded font-semibold mr-5">Submit</button>
                    <a href="/" class="text-gray-500 text-sm px-4 py-2 border border-gray-500 rounded hover:text-gray-700">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection