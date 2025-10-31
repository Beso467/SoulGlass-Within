<div>
    <button wire:click="create" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Create New Mirror</button>

    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                <h2 class="text-xl font-bold mb-4">{{ $mirrorId ? 'Edit Mirror' : 'Create New Mirror' }}</h2>

                <form wire:submit.prevent="save" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" wire:model.defer="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" wire:model.defer="slug" placeholder="auto-generated from name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Season</label>
                        <input type="text" wire:model.defer="season" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('season') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea wire:model.defer="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center space-x-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model.defer="is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Starts At</label>
                        <input type="datetime-local" wire:model.defer="starts_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('starts_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ends At</label>
                        <input type="datetime-local" wire:model.defer="ends_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('ends_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
