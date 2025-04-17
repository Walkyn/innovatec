@forelse($backups as $backup)
    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
        <td class="p-4 w-4">
            <div class="flex items-center">
                <input id="checkbox-table-{{ $backup->id }}" type="checkbox"
                    onclick="event.stopPropagation()"
                    class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="checkbox-table-{{ $backup->id }}" class="sr-only">checkbox</label>
            </div>
        </td>
        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $backup->nombre }}
        </th>
        <td class="px-4 py-3 whitespace-nowrap">{{ $backup->tamanio }}</td>
        <td class="px-4 py-3 whitespace-nowrap">{{ $backup->created_at->format('Y-m-d H:i') }}</td>
        <td class="px-4 py-3 text-xs">
            <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $estadoClase[$backup->estado] ?? 'text-gray-700 bg-gray-100' }} flex items-center gap-1 whitespace-nowrap w-fit">
                <i class="fas {{ $iconoClase[$backup->estado] ?? 'fa-question-circle' }} text-xs"></i>
                <span class="text-xs">{{ $backup->estado }}</span>
            </span>
        </td>
        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <div class="flex items-center space-x-4">
                <button type="button"
                    onclick="descargarBackup('{{ route('backup.descargar', $backup->id) }}')"
                    class="flex items-center text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Descargar
                </button>
                <button type="button"
                    data-modal-target="delete-modal"
                    data-modal-toggle="delete-modal"
                    onclick="setBackupIdToDelete({{ $backup->id }})"
                    class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Eliminar
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400">
            No hay copias de seguridad disponibles
        </td>
    </tr>
@endforelse 