@extends('layouts.app')

@section('title','Editar Producto')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
    .multimedia-item {
        position: relative;
        display: inline-block;
        margin: 5px;
    }
    .multimedia-item .btn-delete {
        position: absolute;
        top: 0;
        right: 0;
        background: rgba(255,0,0,0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index')}}">Productos</a></li>
        <li class="breadcrumb-item active">Editar producto</li>
    </ol>

    <div class="card text-bg-light">
        <form action="{{route('productos.update',['producto'=>$producto])}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="card-body">

                <div class="row g-4">

                    <!----Codigo---->
                    <div class="col-md-6">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" id="codigo"
                            class="form-control"
                            value="{{old('codigo',$producto->codigo)}}">
                        @error('codigo')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <p class="form-label">Código de barras</p>

                        <?php
                        require base_path('vendor/autoload.php');
                        $codigo = $producto->codigo;
                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();

                        try {
                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($codigo, $generator::TYPE_EAN_13)) . '">';
                        } catch (Exception $e) {
                            echo "Formato no compatible";
                        }
                        ?>
                    </div>

                    <!---Nombre---->
                    <div class="col-12">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text"
                            name="nombre"
                            id="nombre"
                            class="form-control"
                            value="{{old('nombre',$producto->nombre)}}">
                        @error('nombre')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Descripción---->
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea
                            name="descripcion"
                            id="descripcion"
                            rows="3"
                            class="form-control">{{old('descripcion',$producto->descripcion)}}</textarea>
                        @error('descripcion')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                </div>

                <br>

                <div class="row g-4">

                    <div class="col-md-6">

                        <div class="row g-4">

                            <!---Imagen Principal---->
                            <div class="col-12">
                                <label for="img_path" class="form-label">Imagen Principal:</label>
                                <input type="file" name="img_path" id="img_path" class="form-control" accept=".avif,.webp,.jpeg,.jpg,.png">
                                @error('img_path')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Galería de Imágenes---->
                            <div class="col-12">
                                <label for="images" class="form-label">Agregar más imágenes:</label>
                                <input type="file" name="images[]" id="images" class="form-control" accept=".avif,.webp,.jpeg,.jpg,.png" multiple>
                                @error('images.*')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Galería de Videos---->
                            <div class="col-12">
                                <label for="videos" class="form-label">Agregar más videos:</label>
                                <input type="file" name="videos[]" id="videos" class="form-control" accept="video/*" multiple>
                                @error('videos.*')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Color---->
                            <div class="col-12">
                                <label for="color" class="form-label">Color:</label>
                                <input type="text" name="color" id="color" class="form-control" value="{{old('color', $producto->color)}}" placeholder="Ej: Rojo, Azul, Negro">
                                @error('color')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Género---->
                            <div class="col-12">
                                <label for="genero" class="form-label">Género:</label>
                                <select name="genero" id="genero" class="form-select">
                                    <option value="unisex" {{ old('genero', $producto->genero) == 'unisex' ? 'selected' : '' }}>Unisex</option>
                                    <option value="hombre" {{ old('genero', $producto->genero) == 'hombre' ? 'selected' : '' }}>Hombre</option>
                                    <option value="mujer" {{ old('genero', $producto->genero) == 'mujer' ? 'selected' : '' }}>Mujer</option>
                                    <option value="niño" {{ old('genero', $producto->genero) == 'niño' ? 'selected' : '' }}>Niño</option>
                                    <option value="niña" {{ old('genero', $producto->genero) == 'niña' ? 'selected' : '' }}>Niña</option>
                                </select>
                                @error('genero')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Marca---->
                            <div class="col-12">
                                <label for="marca_id" class="form-label">Marca:</label>
                                <select data-size="4"
                                    title="Seleccione una marca"
                                    data-live-search="true"
                                    name="marca_id"
                                    id="marca_id"
                                    class="form-control selectpicker show-tick">
                                    <option value="">No tiene marca</option>
                                    @foreach ($marcas as $item)
                                    <option value="{{$item->id}}"
                                        {{$producto->marca_id == $item->id || old('marca_id') == $item->id ? 'selected' : '' }}>
                                        {{$item->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('marca_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Presentaciones---->
                            <div class="col-12">
                                <label for="presentacione_id" class="form-label">Presentación:</label>
                                <select data-size="4"
                                    title="Seleccione una presentación"
                                    data-live-search="true"
                                    name="presentacione_id"
                                    id="presentacione_id"
                                    class="form-control selectpicker show-tick">
                                    @foreach ($presentaciones as $item)
                                    <option value="{{$item->id}}"
                                        {{$producto->presentacione_id == $item->id || old('presentacione_id') == $item->id ? 'selected' : '' }}>
                                        {{$item->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('presentacione_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Categoría---->
                            <div class="col-12">
                                <label for="categoria_id" class="form-label">Categoría:</label>
                                <select data-size="4"
                                    title="Seleccione la categoría"
                                    data-live-search="true"
                                    name="categoria_id"
                                    id="categoria_id"
                                    class="form-control selectpicker show-tick">
                                    <option value="">No tiene categoría</option>
                                    @foreach ($categorias as $item)
                                    <option value="{{$item->id}}"
                                        {{ $producto->categoria_id == $item->id || old('categoria_id') == $item->id ? 'selected' : '' }}>
                                        {{$item->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <p>Imagen Principal:</p>

                        <img id="img-default"
                            class="img-fluid mb-3"
                            src="{{ $producto->img_path ? asset($producto->img_path) : asset('assets/img/paisaje.png') }}"
                            alt="Imagen por defecto">

                        <img src="" alt="Ha cargado un archivo no compatible"
                            id="img-preview"
                            class="img-fluid img-thumbnail mb-3" style="display: none;">
                        
                        <hr>
                        <p>Galería Multimedia:</p>
                        <div class="row">
                            @foreach($producto->multimedia as $media)
                                <div class="col-md-4 mb-3">
                                    <div class="multimedia-item">
                                        @if($media->tipo == 'imagen')
                                            <img src="{{ asset($media->ruta) }}" class="img-thumbnail" style="width:100%; height:100px; object-fit:cover;">
                                        @else
                                            <video src="{{ asset($media->ruta) }}" class="img-thumbnail" style="width:100%; height:100px; object-fit:cover;"></video>
                                        @endif
                                        
                                        {{-- Formulario para eliminar --}}
                                        <button type="button" class="btn-delete" onclick="deleteMedia({{ $media->id }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr>
                        <p>Nuevas Imágenes:</p>
                        <div id="gallery-preview" class="row g-2"></div>
                    </div>

                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
        
        {{-- Formulario oculto para eliminar multimedia --}}
        <form id="deleteMediaForm" action="" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    </div>

</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    const inputImagen = document.getElementById('img_path');
    const imagenPreview = document.getElementById('img-preview');
    const imagenDefault = document.getElementById('img-default');

    inputImagen.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagenPreview.src = e.target.result;
                imagenPreview.style.display = 'block';
                imagenDefault.style.display = 'none';
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    function deleteMedia(id) {
        if(confirm('¿Estás seguro de eliminar este archivo?')) {
            const form = document.getElementById('deleteMediaForm');
            form.action = '/producto-multimedia/' + id;
            form.submit();
        }
    }

    // Preview para galería de imágenes nuevas
    const inputGallery = document.getElementById('images');
    const galleryPreview = document.getElementById('gallery-preview');

    if (inputGallery && galleryPreview) {
        inputGallery.addEventListener('change', function() {
            // Limpiar previsualizaciones anteriores
            galleryPreview.innerHTML = '';

            if (this.files && this.files.length > 0) {
                // Mostrar contador de imágenes
                const counter = document.createElement('div');
                counter.className = 'col-12 mb-2';
                counter.innerHTML = `<small class="text-muted">${this.files.length} imagen(es) nueva(s) seleccionada(s)</small>`;
                galleryPreview.appendChild(counter);

                // Crear preview para cada imagen
                Array.from(this.files).forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-4 col-md-3';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail';
                        img.style.width = '100%';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.alt = `Preview ${index + 1}`;
                        
                        col.appendChild(img);
                        galleryPreview.appendChild(col);
                    }

                    reader.readAsDataURL(file);
                });
            }
        });
    }
</script>
@endpush