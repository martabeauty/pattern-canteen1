<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ul class="grid grid-cols-4 gap-4">
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Today's expenses</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">₹ {{ $data['buyin'] }}</h1>
                </li>
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Today's income</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">₹ {{ $data['selltoday'] }}
                    </h1>
                    <p class="text-gray-500 text-sm font-medium">UPI income</p>
                    <h4 class="font-semibold text-4xl text-gray-800 leading-tight">₹ {{ $data['upitoday'] }}
                    </h4>
                    <p class="text-gray-500 text-sm font-medium">Cash income</p>
                    <h4 class="font-semibold text-4xl text-gray-800 leading-tight">₹ {{ $data['cashtoday'] }}
                    </h4>
                </li>
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Yesterday's expenses</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">₹ {{ $data['buyyesterday'] }}
                    </h1>
                </li>
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Yesterday's income</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">₹
                        {{ $data['sellyesterday'] }}
                    </h1>

                    <p class="text-gray-500 text-sm font-medium">UPI income</p>
                    <h4 class="font-semibold text-4xl text-gray-800 leading-tight">₹ {{ $data['upiyesterday'] }}
                    </h4>
                    <p class="text-gray-500 text-sm font-medium">Cash income</p>
                    <h4 class="font-semibold text-4xl text-gray-800 leading-tight">₹ {{ $data['cashyesterday'] }}
                    </h4>
                </li>
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Items in stock</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                        {{ $data['stock'] }}
                    </h1>
                </li>
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Active products</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                        {{ $data['productactive'] }}
                    </h1>
                </li>
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Active categories</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                        {{ $data['catactive'] }}
                    </h1>
                </li>
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Inactive products</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                        {{ $data['productinactive'] }}
                    </h1>
                <li class="transform overflow-hidden rounded-lg bg-white text-left shadow sm:w-full sm:max-w-lg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <p class="text-gray-500 text-sm font-medium">Inactive categories</p>
                    <h1 class="font-semibold text-4xl text-gray-800 leading-tight">
                        {{ $data['catinactive'] }}
                    </h1>
                </li>
            </ul>
        </div>
    </div>
</x-app-layout>