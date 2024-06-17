<div {{ $attributes }}>
    <table class="table-auto border-collapse w-full">
        <thead>
            <tr class="border-b-2 border-b-gray-400 dark:border-b-gray-500 bg-gray-100 dark:bg-gray-800">
                <th class="px-2 py-2 text-left">ID</th>
                <th class="px-2 py-2 text-center">Nome</th>
                <th class="px-2 py-2 text-center">Email</th>
                <th class="px-2 py-2 text-center">Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-b border-b-gray-400 dark:border-b-gray-500">
                <td class="px-2 py-2 text-left hidden sm:table-cell">{{ $user->id }}</td>
                <td class="px-2 py-2 text-center">{{ $user->name }}</td>
                <td class="px-2 py-2 text-center">{{ $user->email }}</td>
                <td class="flex justify-center space-x-1">Nada</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>