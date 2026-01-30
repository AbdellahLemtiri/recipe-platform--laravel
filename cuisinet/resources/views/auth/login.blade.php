@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-2xl border border-gray-50">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 italic">Heureux de vous revoir !</h2>
            <p class="mt-2 text-center text-sm text-gray-500">Connectez-vous pour accéder à vos recettes favorites.</p>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="rounded-md space-y-4">
                <div>
                    <label class="text-xs font-bold uppercase text-gray-400 ml-1">Adresse Email</label>
                    <input type="email" name="email" required class="appearance-none rounded-xl relative block w-full px-4 py-4 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm bg-gray-50" placeholder="chef@saveurs.fr">
                </div>
                <div>
                    <label class="text-xs font-bold uppercase text-gray-400 ml-1">Mot de passe</label>
                    <input type="password" name="password" required class="appearance-none rounded-xl relative block w-full px-4 py-4 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 focus:z-10 sm:text-sm bg-gray-50" placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-900 font-medium">Se souvenir de moi</label>
                </div>
                <div class="text-sm">
                    <a href="#" class="font-bold text-emerald-600 hover:text-emerald-500">Oublié ?</a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-extrabold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all shadow-lg shadow-emerald-100">
                    S'authentifier
                </button>
            </div>
        </form>
        <p class="text-center text-sm text-gray-500">
            Pas encore de compte ? <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:underline">Rejoignez-nous</a>
        </p>
    </div>
</div>
@endsection