<div id="header-bar" class="container mx-auto py-2 px-2 sm:px-6 lg:px-8">
    <div class="relative inline-block text-left w-auto">
        <a href="{{ url('cart') }}" class="bg-center inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-blue-600 text-sm font-medium text-white">
            <svg 
                class="w-5 h-5" 
                fill="none" 
                stroke-linecap="round" 
                stroke-linejoin="round"
                stroke-width="2" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
                >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />        
            </svg>
            Cart <span class="bg-red-600 px-1 ml-1">{{ count((array) session('cart')) }}</span>
        </a>
    </div>
    
</div>