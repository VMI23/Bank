<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Table  -->
                    @foreach($accounts as $account)
                        <h2 class="text-center text-2xl font-bold mb-6">Transaction History for
                            Account: {{ $account->account_number }}</h2>

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">
                                <div class="flex justify-center">
                                    <table class="max-w-7xl mx-auto w-full bg-white divide-y divide-gray-200">
                                        <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Type
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sender Account
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sender Name
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Receiver Account
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Receiver Name
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Rate
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount in Corresponding Currency
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactionHistory as $transaction)
                                            @if($transaction->sender_account_id == $account->id || $transaction->receiver_account_id == $account->id)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->created_at }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->type }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($transaction->type == 'deposit' || $transaction->type == 'withdrawal')
                                                            -
                                                        @elseif($transaction->sender_account)
                                                            {{ $transaction->sender_account->account_number }} ({{$transaction ->sender_account->currency}})
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($transaction->type == 'deposit' || $transaction->type == 'withdrawal')
                                                            -
                                                        @elseif($transaction->sender_account && $transaction->sender_account->user)
                                                            {{ $transaction->sender_account->user->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($transaction->type == 'deposit' || $transaction->type == 'withdrawal')
                                                            -
                                                        @elseif($transaction->receiver_account)
                                                            {{ $transaction->receiver_account->account_number }}({{ $transaction->currency}})
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($transaction->type == 'deposit' || $transaction->type == 'withdrawal')
                                                            -
                                                        @elseif($transaction->receiver_account && $transaction->receiver_account->user)
                                                            {{ $transaction->receiver_account->user->name }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>

                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($transaction->sender_account_id == $account->id)
                                                            <span class="text-red-500">-{{ $transaction->amount }}</span>
                                                        @elseif($transaction->receiver_account_id == $account->id)
                                                            <span class="text-green-500">+{{ $transaction->amount }}</span>
                                                        @else
                                                            {{ $transaction->amount }}
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($transaction->sender_account_id == $account->id || $transaction->receiver_account_id == $account->id)
                                                            {{ $transaction->rate }}
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($transaction->sender_account_id == $account->id)
                                                            <span
                                                                class="text-red-500">-{{ $transaction->amount_in_corresponding_currency }}  {{$transaction->currency}}</span>
                                                        @elseif($transaction->receiver_account_id == $account->id)
                                                            <span class="text-green-500">+{{ $transaction->amount_in_corresponding_currency }}
                                                                {{$transaction->currency}}</span>
                                                        @else
                                                            {{ $transaction->amount_in_corresponding_currency }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- End of Table -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

