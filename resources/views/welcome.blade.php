<x-app-layout>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($polls as $poll)
        <div
            class="border border-gray-500 rounded-md p-4 flex flex-col bg-white"
        >
            <h2 class="font-semibold">{{ $poll->title }}</h2>
            <p class="text-xs py-4 flex-grow">
                {{ $poll->description }}
            </p>
            <div class="flex justify-end">
                @if (Auth::check())
                <a href="/polls/{{ $poll->id }}">
                    <button
                        type="button"
                        class="mt-4 px-4 py-2 bg-blue-500 text-white font-bold rounded hover:bg-blue-700 transition duration-300"
                    >
                        View
                    </button>
                </a>
                @else
                <a href="/login">
                    <button
                        type="button"
                        class="mt-4 px-4 py-2 text-blue-500 underline font-bold rounded transition duration-300"
                    >
                        Login to Vote
                    </button>
                </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
