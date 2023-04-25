<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>
    <!-- Scripts -->

    <script src="https://cdn.tailwindcss.com/3.2.4"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">



                <script>
                    $(document).ready(function() {
                        $("#myflash").hide();
                        $("#myflash1").hide();
                        $("#myflash2").hide();

                    });
                </script>

                <div id="myflash"
                    class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
                    role="alert" style="display:none">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                            </svg></div>
                        <div>
                            <p class="font-bold">Successfull</p>
                            <p class="text-sm"><span id="msg"></p>
                        </div>
                    </div>
                </div>



                <div id="myflash1"
                    class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md"
                    role="alert" style="display:none">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                            </svg></div>
                        <div>
                            <p class="font-bold">Updated</p>
                            <p class="text-sm"><span id="msg1"></p>
                        </div>
                    </div>
                </div>



                <div id="myflash2"
                    class="bg-red-100 border-t-4 border-red-500 rounded-b text-rose-900 px-4 py-3 shadow-md"
                    role="alert" style="display:none">
                    <div class="flex">
                        <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                            </svg></div>
                        <div>
                            <p class="font-bold">Error</p>
                            <p class="text-sm"><span id="msg2"></p>
                        </div>
                    </div>
                </div>


                <form>


                    <div class="space-y-12">


                        <div class="border-b border-gray-900/10 pb-12">



                            <div class="mt-10 grid grid-cols-1 gap-y-8 gap-x-6 sm:grid-cols-6">



                                <div class="sm:col-span-3">
                                    <label for="amount"
                                        class="block text-sm font-medium leading-6 text-gray-900">Amount</label>
                                    <div class="mt-2">
                                        <input type="number" name="amount" id="amount" required
                                            value="{{ $payment->amount }}"
                                            class="block w-full col-span-6 rounded-md border-0 py-1.5
                                             text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                               focus:ring-indigo-600 sm:text-sm sm:leading-6" disabled>
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="amount"
                                        class="block text-sm font-medium leading-6 text-gray-900">Cash</label>
                                    <div class="mt-2">
                                        <input type="number" name="cash" id="cash" required
                                            value="{{ $paymode[0]['cash'] }}"
                                            class="block w-full col-span-6 rounded-md border-0 py-1.5
                                             text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                               focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="amount"
                                        class="block text-sm font-medium leading-6 text-gray-900">UPI</label>
                                    <div class="mt-2">
                                        <input type="number" name="upi" id="upi" required
                                            value="{{ $paymode[0]['upi'] }}"
                                            class="block w-full col-span-6 rounded-md border-0 py-1.5
                                             text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                               focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>


                                <div class="sm:col-span-3">
                                    <label for="pending"
                                        class="block text-sm font-medium leading-6 text-gray-900">Pending</label>
                                    <div class="mt-2">
                                        <input type="number" name="pending" id="pending" required
                                            value="{{ $paymode[0]['pending'] }}"
                                            class="block w-full col-span-6 rounded-md border-0 py-1.5
                                             text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                               focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                {{--
                                <div class="sm:col-span-3">
                                    <label for="quantity"
                                        class="block text-sm font-medium leading-6 text-gray-900">Mode</label>
                                    <div class="mt-2">
                                        <select
                                            class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                                            id="mode">

                                            <option value="{{ $payment->mode }}">{{ $payment->mode }}</option>
                                            @if ($payment->mode != 'upi')
                                                <option value="upi">UPI</option>
                                            @else
                                                <option value="cash">Cash</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                                --}}

                                <div class="sm:col-span-3">
                                    <label for="Date"
                                        class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                                    <div class="mt-2">
                                        <input type="date" value="{{ $payment->date }}" name="date" id="date"
                                            required
                                            class="block w-full col-span-6 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">

                        <button type="button" onclick="addData()"
                            class="rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm
                                 hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 
                                 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </form>

                <script>
                    function addData() {
                        $.ajax({
                            type: 'POST',
                            url: '/payment/mode',
                            data: {
                                "_token": "<?php echo csrf_token(); ?>",
                                "amount": $("#amount").val(),
                                "cash": $("#cash").val(),
                                "upi": $("#upi").val(),
                                "pending": $("#pending").val(),
                                "date": $("#date").val(),
                           //     "mode": $("#mode").val(),

                            },
                            success: function(data) {
                                console.log(data);
                                if ((data.status == 1)) {
                                    $("#msg1").html(data.msg);
                                    $("#myflash1").show();
                                    $("#myflash1").fadeOut(2500);
                                    $(location).prop('href', 'http://127.0.0.1:8000/payment')


                                }

                                if ((data.status == 2)) {
                                    $("#msg").html(data.msg);
                                    $("#myflash").show();
                                    $("#myflash").fadeOut(2500);

                                    $(location).prop('href', 'http://127.0.0.1:8000/payment')

                                }
                                if ((data.status == 0)) {
                                    $("#msg2").html(data.msg);
                                    $("#myflash2").show();
                                    $("#myflash2").fadeOut(2500);
                                }

                            }
                        });
                    }
                </script>

            </div>
        </div>
    </div>


</x-app-layout>