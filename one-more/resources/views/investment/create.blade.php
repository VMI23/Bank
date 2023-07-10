<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex justify-center items-center ">
                        <div class="w-1/3 bg-white shadow-md rounded px-8 pt-6 pb-8">
                            <h2 class="text-2xl font-bold mb-6">Create an Account</h2>
                            <form method="POST" action="{{ route('investments.store') }}">
                                @csrf

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Account Name</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                    focus:outline-none focus:shadow-outline" id="name" name="name" type="text"
                                           placeholder="Enter your account name" required>
                                </div>

                                <div class="mb-4">
                                   <input type="hidden" id="currency" name="currency" value="USD">
                                </div>

                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="initdeposit">Initial Deposit - USD</label>
                                    <label for="balance"></label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                    focus:outline-none focus:shadow-outline" id="balance" name="balance" type="number"
                                                                        placeholder="Enter the initial deposit amount" required>
                                </div>
                                @error('balance')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                                @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                                @error('currency')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror


                                <div class="flex items-center justify-center mb-4">
                                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none transition bg-transparent border border-gray-300 py-2 px-4 rounded" type="submit">
                                        Create Account
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
