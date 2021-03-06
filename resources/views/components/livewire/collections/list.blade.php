<div>

    @if($collections->total() === 0)
        <div class="mt-6 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-primary-text sm:text-3xl sm:leading-9 sm:truncate pb-4 border-b border-gray-200">{{ __('Collections') }}</h2>
            </div>
        </div>
        <div class="empty-categories relative w-full flex flex-col md:flex-row items-center justify-end relative py-12 md:py-24">
            <img src="{{ asset('shopper/images/empty/categories.svg') }}" class="w-full object-cover relative flex lg:absolute lg:top-0" alt="Empty state">
            <div class="w-full lg:w-1/2 relative z-90">
                <div class="w-full pl-0 lg:pl-20 lg:pt-20 xl:pt-24">
                    <h3 class="text-primary-text font-medium text-xl mb-2">{{ __('Organize your products into collections') }}</h3>
                    <p class="text-gray-500 text-lg mb-3">{{ __('Create collections to help your customers find products.') }}</p>
                    <a href="{{ route('shopper.collections.create') }}" class="btn btn-primary inline-flex">{{ __('Create collection') }}</a>
                </div>
            </div>
        </div>
    @endif

    @if($collections->total() > 0)
        <div class="my-6 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-primary-text sm:text-3xl sm:leading-9 sm:truncate">{{ __('Collections') }}</h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('shopper.collections.create') }}" class="btn btn-primary">{{ __('Create collection') }}</a>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <div class="bg-white border-b border-gray-200">
                <div class="sm:hidden p-4">
                    <select aria-label="Selected tab" class="form-select form-select-shopper block w-full pl-3 pr-10 py-2 text-base leading-6 sm:text-sm sm:leading-5 transition ease-in-out duration-150">
                        <option>{{ __('All') }}</option>
                    </select>
                </div>
                <div class="hidden sm:block">
                    <div class="">
                        <nav class="-mb-px flex">
                            <a href="#" class="whitespace-no-wrap ml-8 py-4 px-3 border-b-2 border-brand-500 font-medium text-sm leading-5 text-brand-400 focus:outline-none focus:text-brand-500 focus:border-brand-500">
                                {{ __('All') }}
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="px-4 py-4 sm:px-6">
                <label for="filter" class="sr-only">{{ __('Search collections') }}</label>
                <div class="flex rounded-md shadow-sm">
                    <div class="relative flex-grow focus-within:z-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                            </svg>
                        </div>
                        <input id="filter" wire:model.debounce.300ms="search" class="form-input block w-full rounded-none rounded-l-md pl-10 transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="{{ __('Search collections') }}" />
                        <span wire:loading class="spinner right-0 top-0 mt-5 mr-6"></span>
                    </div>
                    <button wire:click="sort('{{ $direction }}')" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                        </svg>
                        <span class="ml-2">{{ __('Sort') }}</span>
                    </button>
                </div>
            </div>
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="min-w-0 flex-1 flex items-center">
                    <div class="flex-shrink-0 text-gray-800">
                        {{ __('Title') }}
                    </div>
                </div>
                <div></div>
            </div>
            <ul>
                @foreach($collections as $collection)
                    <li class="border-t border-gray-200">
                        <a href="{{ route('shopper.collections.edit', $collection) }}" class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                            <div class="flex items-center px-4 py-4 sm:px-6">
                                <div class="min-w-0 flex-1 flex items-center">
                                    <div class="flex-shrink-0">
                                        @if($collection->preview_image_link !== null)
                                            <img class="h-10 w-10 rounded-md object-cover" src="{{ $collection->preview_image_link }}" alt="{{ $collection->name }}" />
                                        @else
                                            <span class="flex items-center justify-center h-10 w-10 bg-gray-100 text-gray-300 rounded-md">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1 items-center px-4 md:grid md:grid-cols-2 md:gap-4">
                                        <div>
                                            <div class="text-sm leading-5 font-medium text-brand-400 truncate">{{ $collection->name }}</div>
                                            <div class="mt-1 flex items-center text-sm leading-5 text-gray-500">
                                                <span class="truncate py-1 px-2 text-xs bg-gray-100 rounded-md">{{ $collection->slug }}</span>
                                            </div>
                                        </div>
                                        <div class="hidden md:block">
                                            <div>
                                                <div class="text-sm leading-5 text-gray-900">
                                                    {{ $collection->published_at <= now() ? __('Published on') : __('Will be published on') }}
                                                    <time datetime="{{ $collection->published_at->format('F j, Y') }}">
                                                        {{ $collection->published_at->format('F j, Y') }}
                                                    </time>
                                                </div>
                                                <div class="mt-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 {{ $collection->type === "auto" ? 'bg-green-100 text-green-800' :  'bg-blue-100 text-blue-800' }}">
                                                        <svg class="-ml-1 mr-1.5 h-2 w-2 {{ $collection->type === "auto" ? 'text-green-400' :  'text-blue-400' }}" fill="currentColor" viewBox="0 0 8 8">
                                                            <circle cx="4" cy="4" r="3" />
                                                        </svg>
                                                        {{ $collection->type === "auto" ? __('Automatic') : __('Manual') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    {{ $collections->links('shopper::components.livewire.wire-mobile-pagination-links') }}
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm leading-5 text-gray-700">
                            {{ __('Showing') }}
                            <span class="font-medium">{{ ($collections->currentPage() - 1) * $collections->perPage() + 1 }}</span>
                            {{ __('to') }}
                            <span class="font-medium">{{ ($collections->currentPage() - 1) * $collections->perPage() + count($collections->items()) }}</span>
                            {{ __('of') }}
                            <span class="font-medium"> {!! $collections->total() !!}</span>
                            {{ __('results') }}
                        </p>
                    </div>
                    {{ $collections->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
