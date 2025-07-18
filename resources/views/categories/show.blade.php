{{-- filepath: resources/views/categories/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Category Details') }}
            </h2>
            <a href="{{ route('categories.index') }}"
                class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> {{ __('Back to List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="mb-6 flex items-center gap-4">
                    <i class="fas fa-folder-open text-4xl text-blue-600"></i>
                    <span class="text-3xl font-bold text-gray-800">{{ $category->name }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-gray-700 font-semibold">{{ __('Description') }}:</span>
                    <span class="text-gray-800">{{ $category->description ?: 'No description.' }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-gray-700 font-semibold">{{ __('Products in this Category') }}:</span>
                    <ul class="list-disc list-inside text-gray-700 mt-2">
                        @forelse($category->product as $product)
                        <li>{{ $product->name }}</li>
                        @empty
                        <li>No products found.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="mt-8 flex gap-4">
                    <a href="{{ route('categories.edit', $category->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-400 text-white font-semibold rounded-lg shadow hover:bg-yellow-500 transition">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                            <i class="fas fa-trash mr-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>