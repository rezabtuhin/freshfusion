<x-layout title="Register | Fresh Fusion">
    <div class="flex h-[100vh] items-center justify-center px-6 py-12 lg:px-8 overflow-y-scroll overflow-hidden"
         style="
            background-image: url('{{ asset('/storage/images/login-register-bg.jpg') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
         "
    >
        <div class="bg-gray-300 w-[30vw] p-7 rounded">
            <h1 class="lg:text-6xl md:text-4xl sm:text-3xl text-3xl text-center" style="
                    font-family: 'Righteous', sans-serif;
                    font-weight: 800;
                    font-style: normal;">
                <span class="text-blue-600">Fresh</span>Fusion
            </h1>
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register New</h2>
            </div>

            <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
                <form id="register" method="POST" action="/register" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Full Name<span class="text-red-600 font-bold">*</span></label>
                        <input name="name" type="text" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="John Doe" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email address<span class="text-red-600 font-bold">*</span></label>
                        <input name="email" type="email" id="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="john.doe@company.com" required />
                    </div>
                    <div class="mb-3">
                        <label for="role" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Phone<span class="text-red-600 font-bold">*</span></label>
                        <div class="flex items-center">
                            <div id="dropdown-phone-button" data-dropdown-toggle="dropdown-phone" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg" type="button">
                                +880
                            </div>
                            <div class="relative w-full">
                                <input type="text" name="phone" id="phone-input" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="1778798873" required />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Select an option<span class="text-red-600 font-bold">*</span></label>
                        <select name="role" id="role" class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            <option value="User">User</option>
                            <option value="Delivery Man">Delivery Man</option>
                            <option value="Vendor">Vendor</option>
                        </select>
                    </div>
                    <div class="mb-3 hidden" id="image-input-filed">
                        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Banner<span class="text-red-600 font-bold">*</span></label>
                        <input name="banner" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Password<span class="text-red-600 font-bold">*</span></label>
                        <input name="password" type="password" id="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="•••••••••" required />
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Confirm password<span class="text-red-600 font-bold">*</span></label>
                        <input name="confirm_password" type="password" id="confirm_password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="•••••••••" required />
                    </div>
                    <input type="submit" class="flex w-full justify-center rounded-md bg-blue-700 hover:bg-blue-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" value="Register">
                </form>
                <p class="mt-5 text-center text-sm text-gray-500">
                    Already a member?
                    <a href="/login" class="font-semibold leading-6 text-blue-700 hover:text-blue-600 hover:underline">Login</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#image-input-filed').hide();
            $('#role').change(function() {
                if ($(this).val() === 'Vendor') {
                    $('#image-input-filed').show();
                    $('#file_input').prop('required', true);
                } else {
                    $('#image-input-filed').hide();
                    $('#file_input').prop('required', false);
                }
            });
        });
    </script>
</x-layout>
