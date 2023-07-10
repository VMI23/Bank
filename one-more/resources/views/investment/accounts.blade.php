<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts') }}
        </h2>
    </x-slot>

    <div class="py-10 flex">
        <div class="w-3/4 mx-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($accounts->isEmpty())
                        <div class="flex justify-center items-center mb-6">
                            <div class="border-2 border-blue-500 rounded-md p-4">
                                <a href="{{ route('investments.create') }}" class="text-gray-500 hover:text-gray-700 focus:outline-none transition bg-transparent border border-gray-300 py-2 px-4 rounded">
                                    Create an Investment account
                                </a>
                            </div>
                        </div>
                    @else
                        @foreach($accounts as $account)
                            <div class="mb-4">
                                Wallet free funds: {{ $account->balance }} {{ $account->currency }}
                            </div>

                            <div class="bg-white rounded-lg shadow-lg p-6">
                                <h2 class="text-2xl font-semibold mb-4">Holdings</h2>

                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th class="py-2 px-4 text-left">Holding</th>
                                        <th class="py-2 px-4 text-left">Price Change 24%</th>
                                        <th class="py-2 px-4 text-left">Current Price USD</th>
                                        <th class="py-2 px-4 text-left">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($holdings as $holding)
                                        <tr>
                                            <td class="py-2 px-4 text-left">
                                                <a href="{{ route('investment.history', ['symbol' => $holding->symbol]) }}" class="text-blue-500 hover:text-blue-700 focus:outline-none">
                                                    {{ number_format($holding->amount, 4) }} - {{ $holding->symbol }}
                                                </a>
                                            </td>
                                            <td class="py-2 px-4 text-left">
                                                @php
                                                    $priceChange = $priceChanges[$holding->symbol];
                                                    $priceChangeClass = $priceChange >= 0 ? 'text-green-500' : 'text-red-500';
                                                    $priceChangeSign = $priceChange >= 0 ? '+' : '-';
                                                @endphp
                                                <span class="{{ $priceChangeClass }}">
                                                        {{ $priceChangeSign }}{{ $priceChange }}
                                                    </span>
                                            </td>
                                            <td class="py-2 px-4 text-left">{{$currentPrices[$holding->symbol]}}</td>
                                            <td class="py-2 px-4 text-left">
                                                <form action="{{ route('investments.confirm.sell') }}" method="GET" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="symbol" value="{{ $holding->symbol }}">
                                                    <button type="submit" class="text-sm text-red-500 hover:text-red-700 focus:outline-none bg-red-200 hover:bg-red-300 px-3 py-1 rounded-lg">
                                                        Sell
                                                    </button>
                                                </form>
                                                <form action="{{ route('investments.confirm.buy') }}" method="GET" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="symbol" value="{{ $holding->symbol }}">
                                                    <button type="submit" class="text-sm text-green-500 hover:text-green-700 focus:outline-none bg-green-200 hover:bg-green-300 px-3 py-1 rounded-lg">
                                                        Buy
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        @if ($accounts->isNotEmpty())
            <div class="flex">
                <div class="mx-5">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h2 class="text-2xl font-semibold mb-4">Buy Crypto</h2>
                            <form action="{{ route('investments.confirm.buy') }}" method="GET">
                                @csrf
                                <div class="mb-4">
                                    <label for="symbol" class="block text-sm font-medium text-gray-700">Currency</label>
                                    <select id="symbol" name="symbol" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        @foreach($symbols ?? '' as $symbol)
                                            <option value="{{ $symbol }}">{{ $symbol }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Buy
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if(session()->has('success'))
        <div class="fixed bg-blue-500 text-black py-2 px-4 rounded-xl text-sm">
            <p>
                {{ session('success') }}
            </p>
        </div>
    @endif
</x-app-layout>
