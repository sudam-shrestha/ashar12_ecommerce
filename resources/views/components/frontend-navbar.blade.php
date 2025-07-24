<nav class="container flex justify-between items-center">
    <div>
        <img src="{{ asset(Storage::url($company->logo)) }}" class="h-[40px]" alt="{{ $company->name }}">
    </div>
    <form class="w-[40%] mx-auto">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="default-search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)]"
                placeholder="Search Mockups, Logos..." required />
            <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-[var(--color-primary)] hover:bg-[var(--color-primary)] focus:ring-4 focus:outline-none focus:ring-[var(--color-primary)] font-medium rounded-lg text-sm px-4 py-2">Search</button>
        </div>
    </form>
    <div>
        <a href="">SignIn</a>
        <a href="">SignUp</a>
    </div>
</nav>
