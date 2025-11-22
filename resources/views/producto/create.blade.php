@extends('layouts.app')

@section('title','Crear Producto')

@push('css')
<style>
    #descripcion {
        resize: none;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index')}}">Productos</a></li>
        <li class="breadcrumb-item active">Crear producto</li>
    </ol>

    <div class="card">
        <form action="{{ route('productos.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body text-bg-light">

                <div class="row g-4">

                    <!---Nombre---->
                    <div class="col-12">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
                        @error('nombre')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <!---Descripción---->
                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion')}}</textarea>
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
                                <input type="file" name="img_path" id="img_path" class="form-control" accept="image/*">
                                @error('img_path')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Galería de Imágenes---->
                            <div class="col-12">
                                <label for="images" class="form-label">Galería de Imágenes:</label>
                                <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
                                <small class="text-muted">Puedes seleccionar varias imágenes.</small>
                                @error('images.*')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Galería de Videos---->
                            <div class="col-12">
                                <label for="videos" class="form-label">Galería de Videos:</label>
                                <input type="file" name="videos[]" id="videos" class="form-control" accept="video/*" multiple>
                                <small class="text-muted">Puedes seleccionar varios videos.</small>
                                @error('videos.*')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!----Codigo---->
                            <div class="col-12">
                                <label for="codigo" class="form-label">Código:</label>
                                <input type="text" name="codigo" id="codigo" class="form-control" value="{{old('codigo')}}">
                                @error('codigo')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Color---->
                            <div class="col-12">
                                <label for="color" class="form-label">Color:</label>
                                <input type="text" name="color" id="color" class="form-control" value="{{old('color')}}" placeholder="Ej: Rojo, Azul, Negro">
                                @error('color')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Género---->
                            <div class="col-12">
                                <label for="genero" class="form-label">Género:</label>
                                <select name="genero" id="genero" class="form-select">
                                    <option value="unisex" {{ old('genero') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                                    <option value="hombre" {{ old('genero') == 'hombre' ? 'selected' : '' }}>Hombre</option>
                                    <option value="mujer" {{ old('genero') == 'mujer' ? 'selected' : '' }}>Mujer</option>
                                    <option value="niño" {{ old('genero') == 'niño' ? 'selected' : '' }}>Niño</option>
                                    <option value="niña" {{ old('genero') == 'niña' ? 'selected' : '' }}>Niña</option>
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
                                    <option value="{{$item->id}}" {{ old('marca_id') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
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
                                    <option value="{{$item->id}}" {{ old('presentacione_id') == $item->id ? 'selected' : '' }}>
                                        {{$item->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('presentacione_id')
                                <small class="text-danger">{{'*'.$message}}</small>
                                @enderror
                            </div>

                            <!---Categorías---->
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
                                    <option value="{{$item->id}}" {{ old('categoria_id') == $item->id ? 'selected' : '' }}>
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
                            src="{{ asset('assets/img/paisaje.png') }}"
                            alt="Imagen por defecto">

                        <img src="" alt="Ha cargado un archivo no compatible"
                            id="img-preview"
                            class="img-fluid img-thumbnail mb-3" style="display: none;">

                        <hr>
                        <p>Galería de Imágenes:</p>
                        <div id="gallery-preview" class="row g-2"></div>
                    </div>

                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>


</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    // Preview para imagen principal
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

    // Preview para galería de imágenes
    const inputGallery = document.getElementById('images');
    const galleryPreview = document.getElementById('gallery-preview');

    inputGallery.addEventListener('change', function() {
        // Limpiar previsualizaciones anteriores
        galleryPreview.innerHTML = '';

        if (this.files && this.files.length > 0) {
            // Mostrar contador de imágenes
            const counter = document.createElement('div');
            counter.className = 'col-12 mb-2';
            counter.innerHTML = `<small class="text-muted">${this.files.length} imagen(es) seleccionada(s)</small>`;
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
</script>
@endpush