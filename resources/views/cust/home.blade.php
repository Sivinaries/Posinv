<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    @include('user.layout.head')
    <style>
        .slider-container {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .slider-wrapper {
            display: flex;
            transition: transform 0.5s ease-in-out;
            gap: 20px;
            /* This will space the slides out */
        }

        .slider-slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .slider-slide img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* Automatic sliding effect using keyframes */
        @keyframes slideAnimation {
            0% {
                transform: translateX(0);
            }

            33% {
                transform: translateX(-100%);
            }

            66% {
                transform: translateX(-200%);
            }

            100% {
                transform: translateX(0);
            }
        }

        .slider-wrapper {
            animation: slideAnimation 10s infinite;
        }
    </style>
</head>

<body class="font-poppins bg-gray-50">
    <div class='w-full sm:max-w-sm mx-auto '>
        <div class='sm:max-w-sm'>
            <div class="space-y-2">
                @foreach ($profil as $item)
                    <div class="grid grid-cols-4 bg-red-900 p-4 shadow-xl rounded-b-[20px]">
                        <div class="space-y-2 col-span-3">
                            <div class="flex gap-2">
                                <div class="my-auto">
                                    <h1 class="text-2xl text-white font-bold">{{ $item->name }}</h1>
                                </div>
                            </div>
                            <div>
                                <div class="my-auto">
                                    <h1 class="text-sm text-white font-light">{{ $item->alamat }}</h1>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                @auth
                                    <div class="space-y-2">
                                        <h1 class="text-2xl font-base text-white">Hi, {{ auth()->user()->name }}</h1>
                                    </div>
                                @else
                                    <div class="space-y-2">
                                        <div>
                                            <h1 class="text-2xl font-base text-white">
                                                Welcome!
                                            </h1>
                                        </div>
                                        <div class="flex gap-2">
                                            <div class="p-1 border border-white rounded-md">
                                                <a href="{{ route('login') }}" class="">
                                                    <h1 class="text-white text-sm px-2 text-center">Login</h1>
                                                </a>
                                            </div>
                                            <div class="p-1 border border-white rounded-md">
                                                <a href="{{ route('register') }}" class="">
                                                    <h1 class="text-white text-sm px-2 text-center">Register</h1>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                        @auth
                            <div class="flex flex-col items-end">
                                <form class="" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <div class="bg-white p-1.5 rounded-md">
                                        <div class="my-auto">
                                            <button type="submit">
                                                <img class="my-auto mx-auto" src="{{ asset('img/logout.svg') }}"
                                                    alt="">
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endauth
                    </div>
                @endforeach
                <div class="p-4 space-y-6">
                    <!-- CSS-based Slider -->
                    <div class="slider-container">
                        <div class="slider-wrapper">
                            @foreach ($showcase as $item)
                                <div class="slider-slide">
                                    <div class="w-full">
                                        <img src="{{ asset('storage/img/' . basename($item->img)) }}"
                                            alt="Showcase Image" class="w-full h-auto rounded-md">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @auth
                        <div class="grid grid-cols-3 gap-6">
                            <a class="" href="{{ route('user-product') }}">
                                <div class="p-1 border rounded-xl bg-red-900 shadow-xl">
                                    <div class="mx-auto w-6 h-12">
                                        <img class="w-full h-full" src="{{ asset('/img/menu.svg') }}" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h1 class="text-base font-light text-black text-center">Product</h1>
                                </div>
                            </a>
                            <a class="" href="{{ route('user-antrian') }}">
                                <div class="p-1 border rounded-xl bg-red-900 shadow-xl">
                                    <div class="mx-auto w-6 h-12">
                                        <img class="w-full h-full" src="{{ asset('/img/antrian.svg') }}" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h1 class="text-base font-light text-black text-center">Entry</h1>
                                </div>
                            </a>
                            <a class="" href="{{ route('user-akun') }}">
                                <div class="p-1 border rounded-xl bg-red-900 shadow-xl">
                                    <div class="mx-auto w-6 h-12">
                                        <img class="w-full h-full" src="{{ asset('/img/profil.svg') }}" alt="">
                                    </div>
                                </div>
                                <div>
                                    <h1 class="text-base font-light text-black text-center">Akun</h1>
                                </div>
                            </a>
                        </div>
                        @endauth
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($menus as $menu)
                                <a href="{{ route('user-show', ['id' => $menu->id]) }}">
                                    <div class="bg-red-800 p-2 rounded-md space-y-1">
                                        <div class="p-2 bg-white rounded-md">
                                            <img src="{{ asset('storage/img/' . basename($menu->img)) }}"
                                                alt="Product Image" class='mx-auto my-auto w-14 h-17 rounded-xl relative' />
                                        </div>
                                        <div>
                                            <h1 class="text-white text-sm font-bold">{{ $menu->name }}</h1>
                                            <h1 class="text-white text-sm font-bold">Rp.
                                                {{ number_format($menu->price, 0, ',', '.') }}
                                            </h1>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
