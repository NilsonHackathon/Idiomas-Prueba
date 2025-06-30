{{-- filepath: resources/views/categories/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Create Category') }}
            </h2>
            <a href="{{ route('categories.index') }}"
                class="flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-400 text-white font-bold rounded-lg shadow hover:from-blue-700 hover:to-blue-500 transition">
                <i class="fas fa-arrow-left"></i>
                {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 font-bold mb-2">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                        @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 font-bold mb-2">{{ __('Description') }}</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <button type="submit"
                            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                            <i class="fas fa-save"></i>
                            {{ __('Create Category') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>