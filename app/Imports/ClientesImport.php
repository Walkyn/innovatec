<?php

namespace App\Imports;

use App\Models\Cliente;
use App\Models\Pueblo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ClientesImport implements ToModel, WithStartRow, WithEvents
{
    private $totalImportados = 0;
    private $clientesIgnorados = [];
    private $totalIgnorados = 0;
    private $hojaActual = '';
    private $filaActual = 0;
    private $dnisEnExcel = []; // Para mapear DNIs encontrados en el Excel
    private $pueblosPorHoja = []; // Para mantener un registro de los pueblos por hoja

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $this->hojaActual = $event->getSheet()->getTitle();
                $this->filaActual = 0;
                
                // Verificar si ya existe un pueblo para esta hoja
                if (!isset($this->pueblosPorHoja[$this->hojaActual])) {
                    // Buscar o crear el pueblo
                    $pueblo = Pueblo::where('nombre', $this->hojaActual)->first();
                    if (!$pueblo) {
                        // Crear un nuevo pueblo con un distrito por defecto (puedes ajustar esto según tus necesidades)
                        $pueblo = Pueblo::create([
                            'nombre' => $this->hojaActual,
                            'distrito_id' => 1 // Asumiendo que existe un distrito con ID 1
                        ]);
                    }
                    $this->pueblosPorHoja[$this->hojaActual] = $pueblo->id;
                }
            }
        ];
    }

    public function startRow(): int
    {
        return 2;
    }

    public function getTotalImportados()
    {
        return $this->totalImportados;
    }

    public function getClientesIgnorados()
    {
        // Solo retornamos los duplicados del Excel
        return array_filter($this->clientesIgnorados, function($cliente) {
            return strpos($cliente['razon'], 'DNI duplicado en Excel') !== false;
        });
    }

    public function getTotalIgnorados()
    {
        return $this->totalIgnorados;
    }

    private function verificarDNIEnExcel($dni, $fila, $nombre) {
        if (!empty($dni)) {
            if (!isset($this->dnisEnExcel[$dni])) {
                // Primera vez que vemos este DNI
                $this->dnisEnExcel[$dni] = [
                    'fila' => $fila,
                    'hoja' => $this->hojaActual,
                    'nombre' => $nombre
                ];
            } else {
                // DNI duplicado, agregar mensaje informativo
                $this->clientesIgnorados[] = [
                    'hoja' => $this->hojaActual,
                    'fila' => $fila,
                    'nombre' => $nombre,
                    'razon' => "DNI duplicado en Excel. Este DNI también pertenece al cliente: {$this->dnisEnExcel[$dni]['nombre']} en Hoja: {$this->dnisEnExcel[$dni]['hoja']}, Fila: {$this->dnisEnExcel[$dni]['fila']}"
                ];
                $this->totalIgnorados++;
            }
        }
    }

    public function model(array $row)
    {
        $this->filaActual++;

        // Verificar si la fila está completamente vacía
        $filaVacia = true;
        foreach ($row as $valor) {
            if (!empty(trim($valor ?? ''))) {
                $filaVacia = false;
                break;
            }
        }

        if ($filaVacia) {
            return null;
        }

        try {
            $nombreCompleto = trim($row[0] ?? '');
            if (empty($nombreCompleto)) {
                return null;
            }
            
            $partes = explode(' ', $nombreCompleto);
            if (count($partes) === 1) {
                $nombres = $partes[0];
                $apellidos = '';
            } else {
                $nombres = $partes[0];
                $apellidos = implode(' ', array_slice($partes, 1));
            }

            // Verificar duplicados en Excel (solo para mostrar mensaje)
            if (isset($row[1]) && !empty($row[1])) {
                $dniOriginal = trim($row[1]);
                $this->verificarDNIEnExcel($dniOriginal, $this->filaActual, $nombreCompleto);
            }

            // A partir de aquí, continúa la lógica original sin cambios
            $direccion = trim($row[2] ?? '');
            $telefono = trim($row[5] ?? '');
            $dni = '';

            if (isset($row[1]) && !empty($row[1])) {
                $dniOriginal = trim($row[1]);
                $dni = $dniOriginal;
                // Buscar cliente por DNI
                if (Cliente::where('identificacion', $dni)->exists()) {
                    // Si el DNI existe, generamos uno nuevo
                    $dni = $this->generarDNIUnico();
                }
            }

            if (empty($dni)) {
                $dni = $this->generarDNIUnico();
            }

            // Verificar cliente existente
            $clienteExistente = Cliente::where('nombres', $nombres)
                                     ->where('apellidos', $apellidos)
                                     ->where('direccion', $direccion)
                                     ->first();

            if ($clienteExistente) {
                if ($clienteExistente->direccion === $direccion) {
                    if ($clienteExistente->telefono !== $telefono) {
                        $clienteExistente->update([
                            'telefono' => $telefono,
                            'updated_at' => now()
                        ]);
                    }
                    return null;
                }
            }

            // Procesar fecha de instalación
            $fechaInstalacion = null;
            if (isset($row[4]) && !empty($row[4])) {
                try {
                    $fecha = trim((string)$row[4]);
                    if (preg_match('/^\d{2}\/\d{2}\/\d{2}$/', $fecha)) {
                        $fechaInstalacion = Carbon::createFromFormat('d/m/y', $fecha)
                            ->setTime(now()->hour, now()->minute, now()->second)
                            ->format('Y-m-d H:i:s');
                    } elseif (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $fecha)) {
                        $fechaInstalacion = Carbon::createFromFormat('d/m/Y', $fecha)
                            ->setTime(now()->hour, now()->minute, now()->second)
                            ->format('Y-m-d H:i:s');
                    }
                } catch (\Exception $e) {
                    $fechaInstalacion = null;
                }
            }

            if (!$fechaInstalacion) {
                $fechaInstalacion = now()->format('Y-m-d H:i:s');
            }

            $this->totalImportados++;

            return new Cliente([
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'identificacion' => $dni,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'gps' => null,
                'region_id' => 22,
                'provincia_id' => 182,
                'distrito_id' => null,
                'pueblo_id' => $this->pueblosPorHoja[$this->hojaActual] ?? null,
                'estado_cliente' => 'activo',
                'created_at' => $fechaInstalacion,
                'updated_at' => $fechaInstalacion
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Error en la fila: " . $e->getMessage());
        }
    }

    private function generarDNIUnico()
    {
        do {
            $dni = str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);
        } while (Cliente::where('identificacion', $dni)->exists());

        return $dni;
    }
} 