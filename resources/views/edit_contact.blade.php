@include('components.header')

<form action="{{ route('contacts.update', ['contact' => $contact->id]) }}" method="POST" class="md:w-6/12 bg-gray-100 p-6 rounded-sm">

    @csrf
    @method('PUT')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ old('name', $contact->name) }}" class="border border-gray-100 rounded-md p-2 w-full" required>
    <label for="company">Company:</label>
    <input type="text" name="company" value="{{ old('company', $contact->company) }}" class="border border-gray-100 rounded-md p-2 w-full" required>
    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" class="border border-gray-100 rounded-md p-2 w-full" required>
    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email', $contact->email) }}" class="border border-gray-100 rounded-md p-2 w-full" required>
    <button type="submit" class="bg-green-500 w-full rounded-md p-2 mt-2 text-white mb-4">Update Contact</button>
    <a href="{{ url()->previous() }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
        Back
    </a>
</form>

@include('components.footer')