@extends('layout.app')

@section('content')

    <!-- Notification alert -->
    @if (session('success'))
        <div class="fixed top-10 right-0 p-4">
            <div class="bg-green-500 text-white rounded-lg shadow-md p-4">
                {{ session('success') }}
            </div>
        </div>
    @elseif (session('error'))
        <div class="fixed top-10 right-0 p-4">
            <div class="bg-red-500 text-white rounded-lg shadow-md p-4">
                {{ session('error') }}
            </div>
        </div>
    @endif


    <!-- Content -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Companies</h1>
        <a href="{{ route('companies.create')}}">
            <button class="bg-[#FF6B5D] text-white px-4 py-2 rounded-md hover:bg-[#ff5544] transition-colors">
                Add New Company
            </button>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Website</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($companies as $company)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo"
                                        class="h-10 w-10 rounded-md object-cover">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $company->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $company->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap max-w-lg truncate">
                            {{ $company->website_link }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-3">
                                <a href="{{ route('companies.edit', $company->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this company?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                            No companies found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection