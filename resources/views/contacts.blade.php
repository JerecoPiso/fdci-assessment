@include('components.header')
<div class="mt-2 md:w-6/12">
  
    @if (session('success'))
    <div class="bg-green-500 py-1 px-4 rounded-md mb-2 text-center text-white fixed  top-3 right-5">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex justify-between px-2">
        <a href="{{ route('contacts.create') }}" class="bg-green-500 text-white px-2 py-[5px] rounded-sm">Add contact</a>
        <div>
            <input type="text" id="searchInput" name="search" value="{{ old('search', $search) }}" placeholder="Search contacts..." class="placeholder:text-sm border rounded p-1" oninput="searchContacts()" />
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2 ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Company
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="contacts-list">

            </tbody>
        </table>
        <div id="paginationLinks" class="m-4">
            {{ $contacts->links() }} 
        </div>
    </div>

</div>
@include('components.footer')