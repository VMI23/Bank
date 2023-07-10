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
                            <form method="POST" action="/accounts/store">
                                @csrf

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Account Name</label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                    focus:outline-none focus:shadow-outline" id="name" name="name" type="text"
                                           placeholder="Enter your account name" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="currency">Currency</label>
                                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                     focus:outline-none focus:shadow-outline" id="currency" name="currency" required>
                                        <option value="">Select a currency</option>
                                        <option value="EUR">Euro (EUR)</option>
                                        <option value="AUD">Australian Dollar (AUD)</option>
                                        <option value="BGN">Bulgarian Lev (BGN)</option>
                                        <option value="BRL">Brazilian Real (BRL)</option>
                                        <option value="CAD">Canadian Dollar (CAD)</option>
                                        <option value="CHF">Swiss Franc (CHF)</option>
                                        <option value="CNY">Chinese Yuan (CNY)</option>
                                        <option value="CZK">Czech Koruna (CZK)</option>
                                        <option value="DKK">Danish Krone (DKK)</option>
                                        <option value="GBP">British Pound Sterling (GBP)</option>
                                        <option value="HKD">Hong Kong Dollar (HKD)</option>
                                        <option value="HUF">Hungarian Forint (HUF)</option>
                                        <option value="IDR">Indonesian Rupiah (IDR)</option>
                                        <option value="ILS">Israeli Shekel (ILS)</option>
                                        <option value="INR">Indian Rupee (INR)</option>
                                        <option value="ISK">Icelandic Krona (ISK)</option>
                                        <option value="JPY">Japanese Yen (JPY)</option>
                                        <option value="KRW">South Korean Won (KRW)</option>
                                        <option value="MXN">Mexican Peso (MXN)</option>
                                        <option value="MYR">Malaysian Ringgit (MYR)</option>
                                        <option value="NOK">Norwegian Krone (NOK)</option>
                                        <option value="NZD">New Zealand Dollar (NZD)</option>
                                        <option value="PHP">Philippine Peso (PHP)</option>
                                        <option value="PLN">Polish Zloty (PLN)</option>
                                        <option value="RON">Romanian Leu (RON)</option>
                                        <option value="SEK">Swedish Krona (SEK)</option>
                                        <option value="SGD">Singapore Dollar (SGD)</option>
                                        <option value="THB">Thai Baht (THB)</option>
                                        <option value="TRY">Turkish Lira (TRY)</option>
                                        <option value="USD">United States Dollar (USD)</option>
                                        <option value="ZAR">South African Rand (ZAR)</option>
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="initdeposit">Initial Deposit</label>
                                    <label for="balance"></label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                    focus:outline-none focus:shadow-outline" id="balance" name="balance" type="number"
                                                                        placeholder="Enter the initial deposit amount" required>
                                </div>

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
