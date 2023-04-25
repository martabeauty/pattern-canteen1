<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stock') }}
        </h2>
        <button type="button"
            class="focus:outline-none openModal text-white text-sm py-2.5 px-5 mt-5 mx-5  rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">Open
            Modal</button>
    </x-slot>
    <!-- Scripts -->

    <script src="https://cdn.tailwindcss.com/3.2.4"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-header">
                    <h1><b>Add Product</b></h1>


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


                <form>


                    <div class="space-y-12">


                        <div class="border-b border-gray-900/10 pb-12">



                            <div class="mt-10 grid grid-cols-1 gap-y-8 gap-x-6 sm:grid-cols-6">


                                <div class="sm:col-span-3">
                                    <label for="SellOut" class="block text-sm font-medium leading-6 text-gray-900">
                                        Title</label>
                                    <div class="mt-2">
                                        <input type="number" name="sellout" id="sellout" required
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
                                        <input type="date" name="date" id="date" required
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

                    }
                </script>






                <!-- This example requires Tailwind CSS v2.0+ -->

                <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true" id="interestModal">

                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                        </div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                        <div
                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">

                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                                <div class="sm:flex sm:items-start">

                                    <div
                                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">

                                        <svg @click="toggleModal" class="h-6 w-6 text-red-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" aria-hidden="true">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />

                                        </svg>

                                    </div>

                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">

                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">

                                            Deactivate account

                                        </h3>

                                        <div class="mt-2">

                                            <p class="text-sm text-gray-500">

                                                Are you sure you want to deactivate your account? All of your data will
                                                be
                                                permanently removed. This action cannot be undone.

                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                <button type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">

                                    Deactivate

                                </button>

                                <button type="button"
                                    class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">

                                    Cancel

                                </button>

                            </div>

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


            </div>
        </div>
    </div>


</x-app-layout>
