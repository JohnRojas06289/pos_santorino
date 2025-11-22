<?php

namespace App\Services;

use App\Models\Producto;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductoService
{
    /**
     * Crear un Registro
     */
    public function crearProducto(array $data): Producto
    {
        $producto = Producto::create([
            'codigo' => $data['codigo'],
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'img_path' => isset($data['img_path']) && $data['img_path']
                ? $this->handleUploadImage($data['img_path'])
                : null,
            'marca_id' => $data['marca_id'],
            'categoria_id' => $data['categoria_id'],
            'presentacione_id' => $data['presentacione_id'],
            'color' => $data['color'] ?? null,
            'genero' => $data['genero'] ?? 'unisex',
        ]);

        if (isset($data['images'])) {
            $this->handleUploadMultimedia($data['images'], $producto, 'imagen');
        }

        if (isset($data['videos'])) {
            $this->handleUploadMultimedia($data['videos'], $producto, 'video');
        }

        return $producto;
    }

    /**
     * Editar un registro
     */
    public function editarProducto(array $data, Producto $producto): Producto
    {

        $producto->update([
            'codigo' => $data['codigo'],
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'],
            'img_path' => isset($data['img_path']) && $data['img_path']
                ? $this->handleUploadImage($data['img_path'], $producto->img_path)
                : $producto->img_path,
            'marca_id' => $data['marca_id'],
            'categoria_id' => $data['categoria_id'],
            'presentacione_id' => $data['presentacione_id'],
            'color' => $data['color'] ?? null,
            'genero' => $data['genero'] ?? 'unisex',
        ]);

        if (isset($data['images'])) {
            $this->handleUploadMultimedia($data['images'], $producto, 'imagen');
        }

        if (isset($data['videos'])) {
            $this->handleUploadMultimedia($data['videos'], $producto, 'video');
        }

        return $producto;
    }


    /**
     * Guarda una imagen en el Storage
     * 
     */
    private function handleUploadImage(UploadedFile $image, $img_path = null): string
    {
        if ($img_path) {
            $relative_path = str_replace('storage/', '', $img_path);

            if (Storage::disk('public')->exists($relative_path)) {
                Storage::disk('public')->delete($relative_path);
            }
        }

        $name = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = 'storage/' . $image->storeAs('productos', $name, 'public');
        return $path;
    }

    /**
     * Guarda multimedia en el Storage
     */
    private function handleUploadMultimedia(array $files, Producto $producto, string $tipo): void
    {
        foreach ($files as $file) {
            $name = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'storage/' . $file->storeAs('productos/multimedia', $name, 'public');

            $producto->multimedia()->create([
                'ruta' => $path,
                'tipo' => $tipo
            ]);
        }
    }
}
