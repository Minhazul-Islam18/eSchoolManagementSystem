    <ol class="dd-list">
        @forelse ($menuItems as $item)
            <li class="dd-item selection:border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 flex justify-between items-center"
                data-id="{{ $item->id }}" wire:key="{{ $item->id }}">
                <div class="dd-handle">
                    @if ($item->type == 'divider')
                        <strong>Divider: {{ $item->title }}</strong>
                    @else
                        <span>{{ $item->title }}</span> <small class="url">{{ $item->url }}</small>
                    @endif
                </div>
                <div class="flex flex-wrap gap-2 justify-center items-center">
                    <button wire:click='editItem({{ $item->id }})' @click="openCEmodal = true"
                        data-modal-target="CEmodal" data-modal-toggle="CEmodal"
                        class="text-white bg-sky-500 border border-sky-500 rounded flex items-center px-2 py-1 shahow-md hover:bg-opacity-100 transition fade gap-2  dark:text-gray-800">Edit</button>
                    <button wire:click='destroyItem({{ $item->id }})'
                        class="bg-red-500 border border-red-500 rounded flex items-center px-2 py-1 shahow-md text-white hover:bg-opacity-100 transition fade gap-2">Delete</button>
                </div>
                @if (!$item->childs->isEmpty())
                    <x-menuBuilderComponent :menuItems="$item
                        ->childs()
                        ->orderBy('order', 'ASC')
                        ->get()" />
                @endif
            </li>
        @empty
            <li class="font-medium text-center text-blue-200 dark:text-blue-900 hover:underline">No
                Items found
            </li>
        @endforelse
    </ol>
