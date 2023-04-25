<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
        <button type="button" class="bg-gray-800 openModal cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm">
            Add Product
        </button>
    </x-slot>

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @livewire('product-table')
    </div>

    <div class="relative z-10 invisible" id="interestModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <form>
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


                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Add
                                        Product
                                    </h3>
                                    <div class="mt-2">

                                        <div class="md:flex md:items-center mb-6">
                                            <div class="md:w-2/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                                    for="inline-full-name">
                                                    Title
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <input
                                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                                    id="title" type="text" place holder="Title">
                                            </div>
                                        </div>
                                        <div class="md:flex md:items-center mb-6">
                                            <div class="md:w-2/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                                    for="description">
                                                    Description
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <textarea id="description"
                                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"></textarea>
                                            </div>
                                        </div>

                                        <div class="md:flex md:items-center mb-6">
                                            <div class="md:w-2/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                                    for="description">
                                                    Category
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <select
                                                    class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                                                    id="categoryadd">
                                                    <option value="">Select the Category</option>
                                                    @foreach (json_decode($category, true) as $val)
                                                        <option value="{{ $val['id'] }}">{{ $val['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="md:flex md:items-center mb-6">
                                            <div class="md:w-2/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                                    for="qty">
                                                    Quantity
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <input
                                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                                    id="qtyadd" type="number" place holder="Qty">
                                            </div>
                                        </div>



                                        <div class="md:flex md:items-center mb-6">
                                            <div class="md:w-2/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                                    for="description">
                                                    Price Per Item
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <input
                                                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                                    id="priceadd" type="text" place holder="priceitem">
                                            </div>
                                        </div>


                                        <div class="md:flex md:items-center mb-6">
                                            <div class="md:w-2/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                                    for="description">
                                                    Available in Stock
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <select
                                                    class="h-full rounded-md border-0 bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                                                    id="stockadd">
                                                    <option value="">Available in Stock</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>

                                                </select>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">


                            <button type="button" onclick="addData()"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 
                        text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                                Add Product</button>
                            <button type="button"
                                class="closeModal mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Close</button>




                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.openModal').on('click', function(e) {
                $('#interestModal').removeClass('invisible');
            });
            $('.closeModal').on('click', function(e) {
                $('#interestModal').addClass('invisible');
            });
        });
    </script>


    <script>
        function addData() {
            $.ajax({
                type: 'POST',
                url: '/product/add',
                data: {
                    "_token": "<?php echo csrf_token(); ?>",
                    "title": $("#title").val(),
                    "des": $("#description").val(),
                    "cat": $("#categoryadd").val(),
                    "qty": $("#qtyadd").val(),
                    "price": $("#priceadd").val(),
                    "stock": $("#stockadd").val(),
                },
                success: function(data) {
                    console.log(data);
                    if ((data.status == 1)) {
                        $("#msg1").html(data.msg);
                        $("#myflash1").show();
                        $("#myflash1").fadeOut(2500);
                        setTimeout(function() {
                            document.location.reload(true);
                        }, 10);
                    }
                    if ((data.status == 2)) {
                        $("#msg").html(data.msg);
                        $("#myflash").show();
                        $("#myflash").fadeOut(2500);
                        setTimeout(function() {
                            document.location.reload(true);
                        }, 10);
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

</x-app-layout>
