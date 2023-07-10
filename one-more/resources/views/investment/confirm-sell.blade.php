<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sell Crypto') }}
        </h2>
    </x-slot>

    <div class="py-12 flex">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('investments.confirm.sell') }}" method="POST">
                    @csrf


                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-semibold mb-4">Confirm Selling</h2>

                        <div class="mb-4">
                            <label for="quantity_sold" class="block text-sm font-medium text-gray-700">
                                Amount of {{ $symbol }} to sell</label>
                            <input type="number" id="amount" name="amount" step="0.00001" min="0"
                                   class="mt-1 block w-32 sm:w-30 py-2 px-3 border border-gray-300 bg-white
                                rounded-md shadow-sm focus:outline-none focus:ring-blue-500
                                focus:border-blue-500 sm:text-sm flex" oninput="calculateAmount()">
                        </div>
                        @error("amount")
                        <p class="text-black text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error("symbol")
                        <p class="text-black text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error("price")
                        <p class="text-black text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error("amount")
                        @endif

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price of {{ $symbol }}</label>
                            <p class="mt-1">${{ number_format($cryptoPrice, 2) }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="total" class="block text-sm font-medium text-gray-700">Total Amount</label>
                            <p id="total" class="mt-1">$0.00</p>
                            <input type="hidden" id="total" name="total" value="0">
                        </div>

                        <div class="mb-4">
                            <label for="secret" class="block text-sm font-medium text-gray-700">Secret Code</label>
                            <input type="password" id="secret" name="secret" maxlength="6" class="mt-1 block w-24 py-2 px-4 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        @error("secret")
                        <p class="text-black text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <div class="flex">
                            <button type="submit" onclick="calculateAmount()" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Confirm Selling
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="symbol" value="{{ $symbol }}">
                    <input type="hidden" name="price" value="{{ $cryptoPrice }}">
                </form>
            </div>
        </div>
    </div>

    <script>
        function calculateAmount() {
            const investmentInput = document.getElementById('amount');
            const cryptoPrice = {{ $cryptoPrice }};
            const totalElement = document.getElementById('total');
            const totalInput = document.getElementById('total-input');

            const investmentAmount = parseFloat(investmentInput.value);
            const totalAmount = cryptoPrice * investmentAmount;

            totalElement.textContent = '$' + totalAmount.toFixed(2);
            totalInput.value = totalAmount.toFixed(2);
        }
    </script>
</x-app-layout>
