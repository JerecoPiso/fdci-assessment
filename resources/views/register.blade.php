@include('components.header')
<form action="{{ route('registration') }}" method="POST" class="md:w-3/12 bg-gray-100 p-6 rounded-sm mt-4">
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
    @if (session('success'))
    <div class="bg-green-500 p-1 rounded-md mb-2 text-center text-white">
        {{ session('success') }}
    </div>
    @endif
    <label for="">Email</label>
    <input type="email" class="border border-gray-100 rounded-md p-2 w-full" name="email" required>
    <label for="">Name</label>
    <input type="text" class="border border-gray-100 rounded-md p-2 w-full" name="name" required>
    <label for="">Password</label>
    <input type="password" class="border border-gray-100 rounded-md p-2 w-full" name="password" required>
    <button type="submit" class="bg-green-500 w-full rounded-md p-2 mt-2 text-white">Register</button>
    <a href="{{ route('login') }}" class="text-sky-600">Already have an account?</a>
</form>
@include('components.footer')