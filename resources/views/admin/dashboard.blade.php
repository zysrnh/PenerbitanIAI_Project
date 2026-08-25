@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard Utama')

@section('content')
    <!-- Welcome Header -->
    <div class="mb-6">
        <h3 class="text-lg font-bold text-slate-900">Selamat datang, {{ Auth::user()->name }} 👋</h3>
        <p class="text-xs text-slate-500 mt-0.5">Berikut ringkasan statistik dan aktivitas sistem penerbitan saat ini.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <!-- Card 1 -->
        <div class="bg-white p-5 rounded-xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Total Admin</span>
                <h4 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalUsers }}</h4>
                <span class="text-[11px] text-emerald-600 font-medium mt-0.5 block"><i class="fa-solid fa-circle-check text-[10px] mr-1"></i>Akun terdaftar</span>
            </div>
            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-users-gear"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-5 rounded-xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Super Admin</span>
                <h4 class="text-2xl font-extrabold text-rose-600 mt-1">{{ $totalSuperAdmins }}</h4>
                <span class="text-[11px] text-slate-400 mt-0.5 block">Akses penuh sistem</span>
            </div>
            <div class="w-10 h-10 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-5 rounded-xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Admin Standar</span>
                <h4 class="text-2xl font-extrabold text-slate-800 mt-1">{{ $totalAdmins }}</h4>
                <span class="text-[11px] text-slate-400 mt-0.5 block">Operator penerbitan</span>
            </div>
            <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-user-check"></i>
            </div>
        </div>
    </div>

    <!-- Quick Action / Info Box -->
    <div class="bg-white rounded-xl border border-slate-200/80 p-5 shadow-xs flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h4 class="font-bold text-sm text-slate-900">Kelola Akun & Hak Akses</h4>
            <p class="text-xs text-slate-500 mt-0.5">Tambah akun admin baru atau sesuaikan izin akses dengan mudah.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-lg text-xs font-semibold transition shrink-0">
            Buka Manajemen Admin &rarr;
        </a>
    </div>
@endsection
