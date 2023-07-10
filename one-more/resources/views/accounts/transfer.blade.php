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

                    <div class="w-full max-w-md mx-auto">
                        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/accounts/transfer"
                              method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="sender">From
                                    Account:</label>
                                <input type="hidden" name="sender_account_number" value="{{$userAccount->account_number}}">
                                   {{$userAccount->account_number}}

                            </div>
                            @error("sender")
                            <p class="text-black text-s mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">Amount to
                                    Transfer:</label>
                                <input id="amount" name="amount" type="number" step="0.01"
                                       class="w-full bg-white border border-gray-300 rounded py-2 px-3 leading-tight focus:outline-none
                       focus:shadow-outline"
                                       placeholder="Enter amount">
                            </div>
                            @error("amount")
                            <p class="text-black text-s mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="receiver">Recipient
                                    Account:</label>
                                <select id="receiver" name="receiver"
                                        class="w-full bg-white border border-gray-300 rounded py-2 px-3 leading-tight focus:outline-none
                         focus:shadow-outline">
                                    @foreach($allAccounts as $account)
                                        <option
                                            value="{{ $account['account_number'] }}">{{ $account['account_number'] }}
                                            ({{ $account['currency'] }}) ({{ $account->user->name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error("receiver")
                            <p class="text-black text-s mt-1">{{ $message }}</p>
                            @enderror


                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="receiver">Recipient's
                                    Name
                                </label>
                                <input id="receiverName" name="receiverName"
                                       class="w-full bg-white border border-gray-300 rounded py-2 px-3 leading-tight focus:outline-none
                         focus:shadow-outline">

                                </input>
                            </div>
                            @error("receiverName")
                            <p class="text-black text-s mt-1">{{ $message }}</p>
                            @enderror


                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Enter code</label>
                                <input type="text" name="secret" class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2">
                            </div>

                            <div class="flex items-center justify-between">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none
                focus:shadow-outline" type="submit">
                                    Transfer Funds
                                </button>
                            </div>
                            @error("secret")
                            <p class="text-black text-s mt-1">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
