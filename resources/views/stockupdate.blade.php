<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stock') }}
        </h2>
    </x-slot>
    <!-- Scripts -->

    <script src="https://cdn.tailwindcss.com/3.2.4"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    @php
        
        $data = json_decode($product, true);
        
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-header">
                    <h1><b>Sell Out for {{ $data[0]['title'] }}</b></h1>

                </div>


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


                @if ($data[0]['in_stock'] == 1)
                    <form>


                        <div class="space-y-12">


                            <div class="border-b border-gray-900/10 pb-12">

                                <input type="hidden" name="buyin" id="buyin" value="{{ $data[0]['quantity'] }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                             placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                              focus:ring-indigo-600 sm:text-sm sm:leading-6">

                                <div class="mt-10 grid grid-cols-1 gap-y-8 gap-x-6 sm:grid-cols-6">

                                    <!--
                                    <div class="sm:col-span-3">
                                        <label for="SellOut"
                                            class="block text-sm font-medium leading-6 text-gray-900">Sell Out</label>
                                        <div class="mt-2">
                                            <input type="number" value="{{ $data[0]['sellout'] }}" name="sellout"
                                                id="sellout" required
                                                class="block w-full col-span-6 rounded-md border-0 py-1.5
                                             text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                               focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                -->


                                    <div class="sm:col-span-3">
                                        <label for="SellOut"
                                            class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
                                        <div class="mt-2">
                                            <input type="number" value="{{ $data[0]['qty'] }}" name="qty"
                                                id="qty" required
                                                class="block w-full col-span-6 rounded-md border-0 py-1.5
                                             text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300
                                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                               focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="Date"
                                            class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                                        <div class="mt-2">
                                            <input type="date" value="{{ $data[0]['date'] }}" name="date"
                                                id="date" required
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
                                url: '/stock/update',
                                data: {
                                    "_token": "<?php echo csrf_token(); ?>",
                                    "id": "<?php echo $data[0]['id']; ?>",
                                    "buyin": "<?php echo $data[0]['quantity'] * $data[0]['price_per_item']; ?>",
                                    //   "sellout": $("#sellout").val(),
                                    "qty": $("#qty").val(),
                                    "date": $("#date").val(),
                                },
                                success: function(data) {
                                    console.log(data);
                                    if ((data.status == 1)) {
                                        $("#msg1").html(data.msg);
                                        $("#myflash1").show();
                                        $("#myflash1").fadeOut(2500);
                                    }
                                    if ((data.status == 2)) {
                                        $("#msg").html(data.msg);
                                        $("#myflash").show();
                                        $("#myflash").fadeOut(2500);
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
                @endif
            </div>
        </div>
    </div>


</x-app-layout>
