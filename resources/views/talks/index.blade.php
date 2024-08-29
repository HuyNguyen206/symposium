<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List talk') }}
            </h2>
            <x-nav-link
                class="hover:text-white focus:text-white inline-block text-white px-4 py-2 rounded-2xl bg-blue-600"
                href="{{route('talks.create')}}">Create talk
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Presenter
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Length
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Abstract
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Organizer note
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created at
                                </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($talks as $talk)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a class="underline" href="{{route('talks.show', $talk->id)}}">
                                            {{$talk->title}}
                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$presenter->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$talk->type}}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{$talk->length}}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ Str::limit($talk->abstract,50)}}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{Str::limit($talk->organizer_notes,50)}}

                                    </td>

                                    <td class="px-6 py-4">
                                        {{$talk->created_at}}
                                    </td>
                                    <td>
                                        <div class="flex">
                                            <x-delete-item :route="route('talks.destroy', $talk)">Delete talk</x-delete-item>
                                             <x-button :route="route('talks.edit', $talk)">Edit</x-button>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
