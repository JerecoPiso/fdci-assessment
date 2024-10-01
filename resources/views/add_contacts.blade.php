@include('components.header')

<form action="{{ route('contacts.store') }}" method="POST" class="md:w-6/12 bg-gray-100 p-6 rounded-sm">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <label for="">Name</label>
    <input type="text" class="border border-gray-100 rounded-md p-2 w-full" name="name" required>
    <label for="">Company</label>
    <input type="text" class="border border-gray-100 rounded-md p-2 w-full" name="company" required>
    <label for="">Phone</label>
    <input type="text" class="border border-gray-100 rounded-md p-2 w-full" name="phone" required>
    <label for="">Email</label>
    <input type="email" class="border border-gray-100 rounded-md p-2 w-full" name="email" required>
    <button type="submit" class="bg-green-500 w-full rounded-md p-2 mt-2 text-white mb-4">Add Contact</button>
    <a href="{{ url()->previous() }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
        Back
    </a>
</form>

@include('components.footer')