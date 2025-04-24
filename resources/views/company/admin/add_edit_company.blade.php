@extends('layout.app')

@section('content')
    <x-breadcrumb :items="[
        ['name' => 'Companies', 'url' => route('companies.index')],
        ['name' => isset($company) ? 'Edit Company' : 'Create Company']
    ]" />

    <form action="{{ isset($company) ? route('companies.update', $company->id) : route('companies.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if(isset($company))
            @method('PUT')
        @endif

        <div class="flex justify-between items-center mb-[6vh]">
            <h1 class="text-2xl font-normal text-slate-400">{{ isset($company) ? 'Edit Company' : 'Create Company' }}</h1>

            <button type="submit"
                class="bg-[#FF6B5D] text-white px-[5vw] py-2 rounded-lg hover:bg-[#ff5544] shadow-xl transition-colors">
                {{ isset($company) ? 'Update' : 'Save' }}
            </button>

        </div>

        <div>
            <h2 class="text-lg font-normal text-slate-400 mb-6">COMPANY INFORMATION</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600 mb-2">Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('name', $company->name ?? '') }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email address</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('email', $company->email ?? '') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo Field -->
                <div class="mb-4">
                    <label for="logo" class="block text-sm font-medium text-gray-600 mb-2">Logo</label>
                    <div class="flex flex-col gap-3">
                        <div class="relative">
                            <input type="file" name="logo" id="logo" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="flex items-center gap-2 px-3 py-2 border border-gray-300 rounded-md bg-white">
                                <span class="text-gray-500">Choose File</span>
                                <span class="text-gray-400 file-name">No file chosen</span>
                            </div>
                        </div>
                        @if(isset($company) && $company->logo)
                            <div class="w-full max-w-[300px]">
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo"
                                    class="w-full h-auto rounded-md object-cover">
                            </div>
                        @endif
                        @error('logo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Website Field -->
                <div class="mb-4">
                    <label for="website" class="block text-sm font-medium text-gray-600 mb-2">Website</label>
                    <input type="url" name="website_link" id="website"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('website', $company->website_link ?? '') }}">
                    @error('website')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- <div class="mt-6 flex justify-end">
                <button type="submit"
                    class="bg-[#FF6B5D] text-white px-4 py-2 rounded-md hover:bg-[#ff5544] transition-colors">
                    {{ isset($company) ? 'Update' : 'Save' }}
                </button>
            </div> --}}

        </div>

    </form>
@endsection