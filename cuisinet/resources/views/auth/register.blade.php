@extends('layouts.app')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full space-y-8 bg-white p-12 rounded-3xl shadow-2xl border border-gray-50">
        <div class="text-center">
            <span class="bg-emerald-100 text-emerald-700 text-xs font-black px-3 py-1 rounded-full uppercase tracking-widest">Nouveau Chef</span>
            <h2 class="mt-4 text-4xl font-extrabold text-gray-900">Créer un compte</h2>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <label class="text-xs font-bold uppercase text-gray-400 ml-1">Nom Complet</label>
                    <input type="text" name="name" required class="mt-1 block w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                </div>
                <div class="col-span-1">
                    <label class="text-xs font-bold uppercase text-gray-400 ml-1">Adresse Email</label>
                    <input type="email" name="email" required class="mt-1 block w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                </div>
                <div class="col-span-2">
                    <label class="text-xs font-bold uppercase text-gray-400 ml-1">Mot de passe</label>
                    <input type="password" name="password" required class="mt-1 block w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                </div>
                <div class="col-span-2">
                    <label class="text-xs font-bold uppercase text-gray-400 ml-1">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required class="mt-1 block w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all">
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" required class="h-4 w-4 text-emerald-600 border-gray-300 rounded">
                <label class="ml-2 block text-sm text-gray-600">J'accepte les conditions d'utilisation</label>
            </div>

            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent text-sm font-extrabold rounded-xl text-white bg-gray-900 hover:bg-black transition-all shadow-xl">
                Créer mon compte
            </button>
        </form>
    </div>
</div>
@endsection