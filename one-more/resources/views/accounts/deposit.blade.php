<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex justify-center items-center ">
                        <div class="w-1/3 bg-white shadow-md rounded px-8 pt-6 pb-8">
                            <h2 class="text-2xl font-bold mb-6"></h2>
                            <form method="POST" action="/accounts/deposit">
                                @csrf

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Deposit to
                                        Account
                                        Number</label>
                                    <input type="hidden" name="account_number" value="{{$account->account_number}}">
                                    {{$account->account_number}}
                                </div>

                                @error("account_number")
                                <p class="text-black text-s mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Enter
                                        Amount</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                    focus:outline-none focus:shadow-outline" id="amount" name="amount" type="text"
                                           placeholder="Enter amount" required>
                                </div>
                                @error("amount")
                                <p class="text-black text-s mt-1">{{ $message }}</p>
                                @enderror
                                @if(session()->has('error'))
                                    <div class="fixed bg-blue-500 text-black py-2 px-4 text-sm">
                                        <p>
                                            {{ session('error') }}
                                        </p>
                                    </div>
                                @endif

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Enter code</label>
                                    <input type="text" name="secret"
                                           class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2">
                                </div>

                                @error("secret")
                                <p class="text-black text-s mt-1">{{ $message }}</p>
                                @enderror


                                <div class="flex items-center justify-center mb-4">
                                    <button
                                        class="text-gray-500 hover:text-gray-700 focus:outline-none transition bg-transparent border border-gray-300 py-2 px-4 rounded"
                                        type="submit">
                                        Deposit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

