@extends('layouts.app')

@section('content')
    <div class="h-screen bg-gray-200">
       <div class="flex items-center">
           <div class="lg:w-1/2 w-full lg:px-24 sm:px-20 sm:py-8">
               <div class="text-gray-900 text-4xl font-medium text-center">
                   <h3>Which word do you want to define today?</h3>
               </div>

              <div class="mt-5 text-center">
                  <h5 class="text-gray-800 mb-3 text-xs">Login with</h5>
                  <a href="{!! route('login.social', 'facebook') !!}" class="px-2 py-2 rounded m-1 text-xs font-medium border border-gray-100 text-gray-100" style="background:  #2553b4">Facebook</a>
                  <a href="{!! route('login.social', 'google') !!}" class="bg-white px-2 py-2 rounded text-gray-700 m-1 text-xs font-medium border border-gray-500">Google</a>
                  <a href="{!! route('login.social', 'twitter') !!}" class="px-2 py-2 rounded bg-blue-500 text-blue-100 m-1 text-xs font-medium border border-blue-100">Twitter</a>
                  <a href="{!! route('login.social', 'github') !!}" class="px-2 py-2 bg-white text-gray-700 rounded m-1 text-xs font-medium border border-gray-500">GitHib</a>
              </div>

               <form class="" method="POST" action="{{ route('login') }}">
                   @csrf

                   <div class="mt-5">
                       <input id="email"
                              type="email"
                              class="w-full py-5 mt-3 outline-none text-gray-900 px-3 text-lg @error('email') border-red-500 @enderror"
                              name="email"
                              value="{{ old('email') }}"
                              placeholder="pombe@gmail.com"
                              required autocomplete="email" autofocus>

                       @error('email')
                       <p class="text-red-500 text-xs italic mt-4">
                           {{ $message }}
                       </p>
                       @enderror
                   </div>

                   <div>
                       <input id="password"
                              type="password"
                              class="w-full py-5 mt-5 outline-none text-gray-900 px-3 text-lg @error('password') border-red-500 @enderror"
                              placeholder="John Pombe"
                              name="password"
                              required>

                       @error('password')
                       <p class="text-red-500 text-xs italic mt-4">
                           {{ $message }}
                       </p>
                       @enderror
                   </div>

                   <div class="flex mt-3 text-gray-600 text-xs italic">
                       <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                       <label class="text-sm ml-3" for="remember">
                           {{ __('Remember Me') }}
                       </label>
                   </div>

                   <div class="text-center mt-6">
                      <button type="submit" class="w-3/4 focus:outline-none bg-gray-900 text-gray-400 rounded-full font-semibold py-3">
                          {{ __('Login') }}
                      </button>

                      <div class="mt-8 font-medium text-md text-gray-700">
                          @if (Route::has('password.request'))
                              <a class="" href="{{ route('password.request') }}">
                                  {{ __('Forgot Your Password?') }}
                              </a>
                          @endif
                      </div>

                       @if (Route::has('register'))
                           <p class="mt-3 text-gray-500">
                               {{ __("Don't have an account?") }}
                               <a class="text-gray-700 hover:text-gray-800 hover:underline active:text-gray-800 active:underline" href="{{ route('register') }}">
                                   {{ __('Register') }}
                               </a>
                           </p>
                       @endif
                   </div>
               </form>
           </div>
           <div class="hidden lg:block lg:w-1/2">
               <img src="/images/sit-or-shit.jpg" class="h-screen w-full object-cover" alt="Image">
           </div>
       </div>
    </div>
@endsection
