<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create talk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('talks.store') }}">
                        @csrf
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <div class="grid grid-cols-1 gap-x-6 gap-y-2">
                                    <div >
                                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                        <div class="mt-2">
                                            <div class="flex w-full rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <input value="{{ @old('title') ?? '' }}" type="text" name="title" id="title" autocomplete="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith">
                                            </div>
                                        </div>
                                        <x-input-error :messages="$errors->get('title')"></x-input-error>
                                    </div>
                                    <div class="mt-2 grid grid-cols-2 gap-x-2">
                                        <div>
                                            <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                                            <div class="mt-2">
                                                <select id="type" name="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    @foreach (\App\Enums\TalkType::cases() as $case)
                                                        <option value="{{ $case->value }}" @selected(@old('type') === $case->value)>{{ $case->value }}</option>
                                                    @endforeach
                                                    {{--                                <option>Standard</option>--}}
                                                    {{--                                <option>Lighting</option>--}}
                                                    {{--                                <option>Keynote</option>--}}
                                                </select>
                                            </div>
                                            <x-input-error :messages="$errors->get('type')"></x-input-error>
                                        </div>

                                        <div>
                                            <label for="length" class="block text-sm font-medium leading-6 text-gray-900">Length</label>
                                            <div class="mt-2 rounded-md ">
                                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                    <input value="{{ @old('length') ?? '' }}" type="text" name="length" id="length" class="rounded-md  block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith">
                                                </div>
                                            </div>
                                            <x-input-error :messages="$errors->get('length')"></x-input-error>

                                        </div>
                                    </div>
                                    <div class="col-span-full">
                                        <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Abstract</label>
                                        <div class="mt-2">
                                            <textarea id="abstract" name="abstract" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ @old('abstract') ?? '' }}</textarea>
                                        </div>
                                        <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                                        <x-input-error :messages="$errors->get('abstract')"></x-input-error>

                                    </div>
                                    <div class="col-span-full">
                                        <label for="organization_notes" class="block text-sm font-medium leading-6 text-gray-900">Organization notes</label>
                                        <div class="mt-2">
                                            <textarea id="organizer_notes" name="organizer_notes" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ @old('organizer_notes') ?? '' }}</textarea>
                                        </div>
                                        <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                                        <x-input-error :messages="$errors->get('organizer_notes')"></x-input-error>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </form>                </div>
            </div>
        </div>
    </div>
</x-app-layout>
