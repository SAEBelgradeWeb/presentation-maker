<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="/presentations" method="POST">
                        @csrf
                        <div>
                            <label for="title">Title</label>
                            <input type="text" name="title">
                        </div>
                        <div>
                            <label for="description">Prompt</label>
                            <textarea name="description" id="" cols="30" rows="10"></textarea>
                        </div>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($presentations as $presentation)
                    <div>{{$presentation->title}} <a href="#">View</a></div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
