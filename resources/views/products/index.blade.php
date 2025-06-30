{{-- filepath: resources/views/products/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Products Management') }}
            </h2>
            <a href="{{ route('products.create') }}"
                class="flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-green-600 to-green-400 text-white font-bold rounded-lg shadow hover:from-green-700 hover:to-green-500 transition">
                <i class="fas fa-plus"></i>
                {{ __('Add Product') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-green-50 to-green-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-green-700 uppercase tracking-wider">{{ __('Name') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-green-700 uppercase tracking-wider">{{ __('Price') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-green-700 uppercase tracking-wider">{{ __('Category') }}</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-green-700 uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($products as $product)
                        <tr class="hover:bg-green-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">${{ number_format($product->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $product->category->name ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-yellow-400 text-white font-semibold rounded-lg shadow hover:bg-yellow-500 transition mr-2">
                                    <i class="fas fa-edit mr-1"></i> {{ __('Edit') }}
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('{{ __('Are you sure you want to delete this product?') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                                        <i class="fas fa-trash mr-1"></i> {{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-lg font-semibold">
                                <i class="fas fa-box-open text-2xl mb-2"></i><br>
                                No products found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-6 bg-gray-50 border-t flex justify-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>