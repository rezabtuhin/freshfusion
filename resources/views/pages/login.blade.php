<x-layout title="Login | Fresh Fusion">
    <div class="flex h-[100vh] items-center justify-center px-6 py-12 lg:px-8"
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
                <h2 class="mt-3 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
            </div>

            <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="/login" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <input type="submit" value="login" class="flex w-full justify-center rounded-md bg-blue-700 hover:bg-blue-800 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"/>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Not a member?
                    <a href="/register" class="font-semibold leading-6 text-blue-700 hover:text-blue-600 hover:underline">Register</a>
                </p>
            </div>
        </div>
    </div>

</x-layout>
