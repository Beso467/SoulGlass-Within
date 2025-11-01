<div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">

        <!-- Create Button -->
        <div class="mb-4">
            <button wire:click="create" 
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Create New Quote
            </button>
        </div>

        <!-- Modal -->
        @if($showModal)
            <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
                <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                    <h2 class="text-xl font-bold mb-4">{{ $quoteId ? 'Edit quote' : 'Create New Quote' }}</h2>

                    <form wire:submit.prevent="save" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mirror</label>
                            <select wire:model.defer="mirror_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Select</option>
                                @foreach($mirrors as $mirror)
                                    <option value="{{ $mirror->id }}">{{ $mirror->name }}</option>
                                @endforeach
                            </select>
                            @error('mirror_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">text</label>
                            <textarea wire:model.defer="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </textarea>
                            @error('text') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
