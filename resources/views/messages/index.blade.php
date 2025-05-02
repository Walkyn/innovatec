@extends('layouts.app')
@section('title', 'Innovatec - Mensajes')

@section('content')

    <!-- ===== Main Content Start ===== -->
    <main>

        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Mensajes
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li>
                            <a class="font-medium" href="{{ route('home.index') }}">Panel /</a>
                        </li>
                        <li class="font-medium text-primary">Mensajes</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Alerts Start -->
            @include('partials.alerts')
            <!-- ====== Alerts End -->

            <!-- ====== Table Section Start -->
            <div class="flex flex-col gap-10">

                <div class="flex h-screen">
                    <!-- Sidebar con pagos recibidos -->
                    <div class="w-1/3 bg-white dark:bg-boxdark border-r border-gray-200 dark:border-strokedark">
                        <div class="p-6">
                            <h1 class="text-xl font-semibold text-black dark:text-white flex justify-between">
                                Pagos Recibidos
                                <span class="bg-gray-100 dark:bg-meta-4 text-sm px-2 py-1 rounded-md">{{ $pagos->count() }}</span>
                            </h1>
                        </div>
                        <div class="overflow-y-auto p-4">
                            @foreach($pagos as $pago)
                                <div class="flex items-center text-sm mb-2 p-2 hover:bg-gray-50 dark:hover:bg-meta-4 cursor-pointer pago-item"
                                    data-pago-id="{{ $pago['id'] }}">
                                    <div class="relative">
                                        @php
                                            $cliente = $pago['cliente'];
                                            $iniciales = $cliente ? strtoupper(substr($cliente['nombres'],0,1) . substr($cliente['apellidos'],0,1)) : '?';
                                        @endphp
                                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                            {{ $iniciales }}
                                        </div>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="font-semibold text-black dark:text-white">
                                            {{ $cliente ? $cliente['nombres'] . ' ' . $cliente['apellidos'] : 'Cliente no encontrado' }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                            {{ $pago['detalles_servicio'] ? json_decode($pago['detalles_servicio'], true)[0]['servicio'] ?? 'Sin asunto' : 'Sin asunto' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                
                    <!-- Área de detalle del pago seleccionado -->
                    <div class="flex-1 flex flex-col bg-gray-50 dark:bg-boxdark-2" id="detalle-pago">
                        <div class="flex items-center justify-center h-full text-gray-400">
                            Selecciona un pago para ver los detalles.
                        </div>
                    </div>
                </div>

            </div>
            <!-- ====== Table Section End -->
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

@endsection

<!-- Modal de éxito minimalista -->
<div id="modalExito" class="fixed inset-0 z-50 hidden bg-black bg-opacity-30 flex items-center justify-center">
    <div class="bg-white p-5 rounded shadow max-w-xs w-full text-center">
        <p class="text-green-600 font-semibold mb-2">¡Pago actualizado!</p>
        <p class="text-gray-600 text-sm mb-4">Los cambios se guardaron correctamente.</p>
        <button id="cerrarModalExito" class="px-4 py-1.5 bg-green-500 text-white rounded hover:bg-green-600 text-sm font-medium">
            Aceptar
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pagos = @json($pagos);
        const detallePago = document.getElementById('detalle-pago');

        document.querySelectorAll('.pago-item').forEach(function(item) {
            item.addEventListener('click', function() {
                const pagoId = this.getAttribute('data-pago-id');
                const pago = pagos.find(p => String(p['id']) === String(pagoId));
                if (!pago || !pago['cliente']) return;

                let detalles = '';
                try {
                    const servicios = JSON.parse(pago['detalles_servicio']);
                    detalles = servicios.map(s => s.servicio).join(', ');
                } catch {
                    detalles = pago['detalles_servicio'];
                }

                let comprobanteHtml = '';
                if (pago['comprobante_path']) {
                    comprobanteHtml = `
                        <div class="mb-2">
                            <a href="/storage/${pago['comprobante_path']}" target="_blank" class="text-blue-600 underline">Ver comprobante</a>
                            <img src="/storage/${pago['comprobante_path']}" alt="Comprobante" class="mt-2 max-w-xs rounded shadow">
                        </div>
                    `;
                }

                // Opciones de estado
                const estados = [
                    {valor: 'en_revision', texto: 'En revisión'},
                    {valor: 'Aprobado', texto: 'Aprobado'},
                    {valor: 'Rechazado', texto: 'Rechazado'}
                ];

                detallePago.innerHTML = `
                    <div class="flex flex-col h-full">
                        <!-- Header del pago -->
                        <div class="flex items-center border-b px-6 py-4 bg-white">
                            <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white text-lg font-bold">
                                ${pago['cliente']['nombres'].charAt(0).toUpperCase()}${pago['cliente']['apellidos'].charAt(0).toUpperCase()}
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="font-semibold text-black dark:text-white text-lg">
                                    ${pago['cliente']['nombres']} ${pago['cliente']['apellidos']}
                                </div>
                                <div class="text-xs text-gray-400">${pago['cliente']['email'] ?? ''}</div>
                            </div>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                ${pago['estado'] === 'Aprobado' ? 'bg-emerald-100 text-emerald-600' :
                                  pago['estado'] === 'en_revision' ? 'bg-yellow-100 text-yellow-600' :
                                  'bg-rose-100 text-rose-600'}">
                                ${estados.find(e => e.valor === pago['estado']).texto}
                            </span>
                        </div>
                        <!-- Info de pago + comprobante + observaciones actuales -->
                        <div class="px-6 py-4 bg-white border-b">
                            <div>
                                <span class="font-semibold">Servicio:</span> ${detalles} &nbsp; | &nbsp;
                                <span class="font-semibold">Monto:</span> S/ ${parseFloat(pago['monto_total']).toFixed(2)} &nbsp; | &nbsp;
                                <span class="font-semibold">Fecha:</span> ${new Date(pago['created_at']).toLocaleDateString()}
                            </div>
                            ${comprobanteHtml}
                            <div class="max-w-lg w-full mt-4">
                                <div class="bg-white rounded-lg shadow p-4 border">
                                    <div class="font-semibold text-gray-700 mb-2">Observaciones actuales</div>
                                    <div class="text-gray-600 text-sm">
                                        ${pago['observaciones'] ? pago['observaciones'] : '<span class="italic text-gray-400">Sin observaciones registradas.</span>'}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Formulario para nueva observación -->
                        <form id="form-actualizar-pago" class="bg-white border-t p-4 flex flex-col gap-2">
                            <label class="text-xs font-semibold text-gray-500 mb-1">Nueva observación:</label>
                            <textarea name="observaciones" rows="2" class="border rounded p-2 text-sm" placeholder="Escribe aquí la observación que deseas guardar..."></textarea>
                            <div class="flex items-center gap-2 mt-2">
                                <label class="text-xs font-semibold text-gray-500">Estado:</label>
                                <select name="estado" class="border rounded p-1 text-sm">
                                    ${estados.map(e => `<option value="${e.valor}" ${pago['estado'] === e.valor ? 'selected' : ''}>${e.texto}</option>`).join('')}
                                </select>
                                <button type="submit" class="ml-auto bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm font-semibold">Guardar</button>
                            </div>
                            <input type="hidden" name="pago_id" value="${pago['id']}">
                        </form>
                    </div>
                `;

                // Manejar el submit del formulario
                document.getElementById('form-actualizar-pago').onsubmit = async function(e) {
                    e.preventDefault();
                    const form = e.target;
                    const data = {
                        observaciones: form.observaciones.value,
                        estado: form.estado.value,
                        pago_id: form.pago_id.value,
                        _token: '{{ csrf_token() }}'
                    };
                    const resp = await fetch("{{ route('panel.actualizar-pago') }}", {
                        method: "POST",
                        headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
                        body: JSON.stringify(data)
                    });
                    const res = await resp.json();
                    if (res.success) {
                        document.getElementById('modalExito').classList.remove('hidden');
                        document.getElementById('cerrarModalExito').onclick = function() {
                            document.getElementById('modalExito').classList.add('hidden');
                            location.reload();
                        };
                        document.getElementById('modalExito').addEventListener('click', function(e) {
                            if (e.target === this) {
                                this.classList.add('hidden');
                                location.reload();
                            }
                        });
                    } else {
                        alert(res.message || 'Error al actualizar');
                    }
                };
            });
        });
    });
</script>






