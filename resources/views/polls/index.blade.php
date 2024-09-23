<x-app-layout>
    <div class="mb-4 flex justify-between items-end">
        <h1 class="font-bold text-2xl mb-4">My Polls</h1>

        <a
            href="{{ route('polls.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Create New Poll
        </a>
    </div>
    @foreach ($polls as $poll)
    <div
        class="flex items-center justify-between gap-4 capitalize bg-white rounded border border-gray-300 p-2 mb-4"
    >
        <div class="flex-grow">
            <a
                href="{{ route('polls.edit', $poll->id) }}"
                >{{ $poll->title }}</a
            >
        </div>
        <div class="text-right">
            {{ $poll->created_at->diffForHumans() }}
        </div>
        <div class="text-left">
            <a
                href="{{ route('polls.edit', $poll->id) }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
            >
                Edit
            </a>
        </div>
        <div class="text-right">
            <form
                action="{{ route('polls.destroy', $poll->id) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this poll?');"
            >
                @csrf @method('DELETE')
                <button
                    type="submit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                >
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</x-app-layout>
