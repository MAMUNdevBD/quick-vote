<x-app-layout>
   <div class="bg-white p-5 pt-0 rounded">
    <div class="flex justify-end">
           <button
   type="button"
       onclick="copyUrl('{{ url()->current() }}')"
       class="border border-sky-500 text-sky-500 font-bold py-2 px-4 rounded mt-5 w-40"
   >
       Share
   </button>
   <script>
       function copyUrl(url) {
           navigator.clipboard.writeText(url).then(() => {
               alert('URL copied to clipboard!');
           }).catch(err => {
               console.error('Failed to copy URL: ', err);
           });
       }
   </script>
    </div>
     <h2 class="font-bold text-2xl mb-4">{{ $poll->title }}</h2>
    <p class="text-gray-700 mb-4">{{ $poll->description }}</p>

    <form method="POST" action="{{ route('votes.store') }}">
        @csrf @foreach($poll->options as $option) @endforeach
        <input type="hidden" name="poll_id" value="{{ $poll->id }}">
        @if($poll->isAlreadySubmitted(Auth::id()))
        <div class="space-y-2">
            @foreach($poll->options as $option)
            <div
                class="grid grid-cols-3 gap-4 capitalize border border-gray-300 p-2"
            >
                <div class="">
                    <label
                        for="option_{{ $option->id }}"
                        class="ml-2"
                        >{{ $option->name }}</label
                    >
                </div>
                <div class="">
                    <div class="w-72 bg-gray-200 h-2.5">
                        <div
                            class="bg-blue-600 h-2.5"
                            style="width: {{ $poll->votes->where('option_id', $option->id)->count() / $poll->votes()->count() * 100 }}%"
                        ></div>
                    </div>
                    <div class="text-right flex">
                        <span class="text-sm">
                            {{ $poll->votes->where('option_id', $option->id)->count() }}
                            votes ({{ number_format($poll->votes->where('option_id', $option->id)->count() / $poll->votes()->count() * 100, 2)



                            }}%)
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @else
                <p class="mt-5">You have already voted in this poll.</p>
            @endif

        @else @foreach($poll->options as $option)
              <label
                for="option_{{ $option->id }}"
                class="flex items-center capitalize gap-2 cursor-pointer mb-2"
                >
                <input
                id="option_{{ $option->id }}"
                    type="radio"
                    name="option_id"
                    value="{{ $option->id }}"
                    class="form-radio"
                />
            {{ $option->name }}
          </label>
        @endforeach
        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5 w-40"
        >
            Vote
        </button>
        @endif
    </form>


   </div>
</x-app-layout>
