<x-app-layout>
    <h2 class="font-bold text-2xl mb-4">Create New Poll</h2>

    <form method="POST" action="{{ route('polls.store') }}">
        @csrf

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
            ></textarea>
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
                @for ($i = 1; $i <= 3; $i++)
                <div class="flex items-center">
                    <input
                        required
                        type="text"
                        id="option{{ $i }}"
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
                @endfor
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
            <input type="checkbox" id="is_public" name="is_public" />
        </div>

        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Create Poll
        </button>
    </form>
</x-app-layout>
