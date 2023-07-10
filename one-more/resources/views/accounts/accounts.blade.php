<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="flex justify-center items-center">
                        <div class="border-2 border-blue-500 rounded-md p-4">
                            <a href="/accounts/create" class="text-gray-500 hover:text-gray-700 focus:outline-none transition bg-transparent border border-gray-300 py-2 px-4 rounded">
                                Create an account
                            </a>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-lg font-bold text-center">Account List</h2>

                        <div class="flex justify-center">
                            <table class="mt-4 border border-gray-300">
                                <thead>
                                <tr>
                                    <th class="border-b-2 px-4 py-2"></th>
                                    <th class="border-b-2 px-4 py-2">Account Name</th>
                                    <th class="border-b-2 px-4 py-2">Account Number</th>
                                    <th class="border-b-2 px-4 py-2">Amount</th>
                                    <th class="border-b-2 px-4 py-2">Currency</th>
                                    <th class="border-b-2 px-4 py-2"></th>
                                    <th class="border-b-2 px-4 py-2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($accounts as $account)
                                    <tr>
                                        <td class="border-b px-4 py-2">{{$loop->index+1}}</td>
                                        <td class="border-b px-4 py-2">{{$account->name}}</td>
                                        <td class="border-b px-4 py-2">{{$account->account_number}}</td>
                                        <td class="border-b px-4 py-2">{{$account->balance}}</td>
                                        <td class="border-b px-4 py-2">{{$account->currency}}</td>
                                        <td>
                                            <form action="{{ route('accounts.deposit') }}" method="GET" class="inline">
                                                @csrf
                                                <input type="hidden" name="account_id" value="{{ $account->id }}">
                                                <button type="submit" class="text-sm text-green-500 hover:text-green-700 focus:outline-none bg-green-200 hover:bg-green-300 px-3 py-1 rounded-lg">
                                                    Deposit
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('accounts.withdrawal') }}" method="GET" class="inline">
                                                @csrf
                                                <input type="hidden" name="account_id" value="{{ $account->id }}">
                                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 focus:outline-none bg-red-200 hover:bg-red-300 px-3 py-1 rounded-lg">
                                                    Withdrawal
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('accounts.transfer', ['id' => $account->id]) }}" method="GET" class="inline">
                                                @csrf
                                                <input type="hidden" name="account_id" value="{{ $account->id }}">
                                                <button type="submit" class="text-sm text-blue-500 hover:text-blue-700 focus:outline-none bg-blue-200 hover:bg-blue-300 px-3 py-1 rounded-lg">
                                                    Transfer
                                                </button>
                                            </form>
                                        </td>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(session()->has('success'))
                        <div class="fixed bg-blue-500 text-black py-2 px-4 rounded-xl text-sm">
                            <p>
                                {{ session('success') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(session()->has('QR'))
        <div class="fixed bottom-4 right-4">
            <div class="bg-red-500 text-black py-2 px-4 rounded-xl text-sm">
                <p>
                    Please scan this QR code now:
                    {!! QrCode::size(200)->generate(session('QR')) !!}
                </p>
            </div>
        </div>
    @endif
</x-app-layout>
