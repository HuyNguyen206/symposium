<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('List conference') }}
            </h2>
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
                                    location
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    url
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    starts_at
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    ends_at
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($conferences as $conference)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a class="underline" href="{{ route('conferences.show', $conference->id) }}">
                                            {{ $conference->title }}
                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $conference->location }}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $conference->description }}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $conference->url }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $conference->starts_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $conference->ends_at }}
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
