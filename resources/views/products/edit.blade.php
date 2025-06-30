{{-- filepath: resources/views/products/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
            <a href="{{ route('products.index') }}"
                class="flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-green-600 to-green-400 text-white font-bold rounded-lg shadow hover:from-green-700 hover:to-green-500 transition">
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

                <form action="{{ route('products.update', $products->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">{{ __('Name') }}</label>
                        <input type="text" name="name" value="{{ old('name', $products->name) }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">
                        @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">{{ __('Price') }}</label>
                        <input type="number" name="price" value="{{ old('price', $products->price) }}" step="0.01" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">
                        @error('price')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">{{ __('Description') }}</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">{{ old('description', $products->description) }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">{{ __('Category') }}</label>
                        <select name="category_id" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300">
                            <option value="">{{ __('Select a category') }}</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between mt-8">
                        <button type="submit"
                            class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow transition">
                            <i class="fas fa-save"></i>
                            {{ __('Update Product') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>