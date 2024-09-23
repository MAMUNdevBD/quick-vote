<x-app-layout>
    <h2 class="font-bold text-2xl mb-4">Edit Poll</h2>

    <form method="POST" action="{{ route('polls.update', $poll->id) }}">
        @csrf @method('PUT')

        <div class="mb-4">
            <label
                for="title"
                class="block text-gray-700 text-sm font-bold mb-2"
                >Poll Title:</label
            >
            <input
                required
                type="text"
                id="title"
                name="title"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ $poll->title }}"
            />
        </div>

        <div class="mb-4">
            <label
                for="description"
                class="block text-gray-700 text-sm font-bold mb-2"
                >Poll Description:</label
            >
            <textarea
                id="description"
                name="description"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >{{ $poll->description }}</textarea
            >
        </div>
        <div class="mb-4">
            <label
                for="options"
                class="block text-gray-700 text-sm font-bold mb-2"
                >Poll Options:</label
            >
            <script>
                let optionCount = 3;
                function addOptionField() {
                    optionCount++;
                    const newOption = document.createElement("div");
                    newOption.innerHTML = `
                       <div class="flex items-center">
                        <input
                        required
                            type="text"
                            id="option${optionCount}"
                            name="options[]"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2"
                             placeholder="Write an option"
                        />
                        <button
                            type="button"
                            onclick="this.parentNode.remove()"
                            class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Remove
                        </button>
                         </div>
                    `;
                    document
                        .getElementById("optionsContainer")
                        .appendChild(newOption);
                }
            </script>
            <div id="optionsContainer">
                @foreach($poll->options as $option)
                <div class="flex items-center">
                    <input
                        required
                        type="text"
                        id="option{{ $option->id }}"
                        name="options[]"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mt-2"
                        placeholder="Write an option"
                        value="{{ $option->name

                    }}"
                    />
                    <button
                        type="button"
                        onclick="this.parentNode.remove()"
                        class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Remove
                    </button>
                </div>
                @endforeach
            </div>
            <button
                type="button"
                id="addOption"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4"
                onclick="addOptionField()"
            >
                Add Option
            </button>
        </div>

        <div class="mb-4">
            <label
                for="is_public"
                class="block text-gray-700 text-sm font-bold mb-2"
                >Make Poll Public:</label
            >
            <input type="checkbox" id="is_public" name="is_public"
            {{ $poll["is_public"] ? "checked" : "" }} />
        </div>

        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Update Poll
        </button>
    </form>
</x-app-layout>
