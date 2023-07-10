<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Investment History') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-6 bg-white border-b border-gray-200">

                    <!-- Table -->
                    <h2 class="text-center text-2xl mb-6">
                        Investment History for {{ $symbol }}
                    </h2>

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
                                            Amount Bought
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Amount Sold
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price Bought
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price Sold
                                        </th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($histories as $history)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $history->created_at }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $history->amount_bought }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $history->amount_sold ?? ' ' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $history->price_bought ?? ' '}}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $history->price_sold ?? '' }}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End of Table -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
