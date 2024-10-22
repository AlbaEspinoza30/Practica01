<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">entrada</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form action="{{$entrada->id ? route('entrada.update',$entrada) : route('entrada.store')}}" method="post" enctype="multipart/form-data">
            @if($entrada->id)
            @method('PUT')
            <input type="hidden" name="id" value="{{ $entrada->id }}">
            @endif
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{$entrada->nombre}}" required
                            placeholder="Ingrese nombre">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nombre">Categoría</label>
                        <select class="form-control" name="evento_id" id="">
                            @foreach($categorias as $cat)
                            <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nombre">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" value="{{$entrada->descripcion}}"
                            placeholder="Ingrese descripción">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nombre">Stock</label>
                        <input type="text" class="form-control" name="stock" value="{{$entrada->stock}}"
                            placeholder="Ingrese descripción">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nombre">Precio</label>
                        <input type="text" class="form-control" name="precio" value="{{$entrada->precio}}"
                            placeholder="Ingrese descripción">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nombre">Barcode</label>
                        <input type="text" class="form-control" name="barcode" value="{{$entrada->barcode}}"
                            placeholder="Ingrese descripción">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="nombre">Imagen</label>
                        <input type="file" class="form-control" name="imagen">
                    </div>
                    @if($entrada->imagen)
                    <div>                        
                        <img class="img-rounded" width="100" height="100"
                         src="{{asset('entradas/'.$entrada->imagen)}}" alt="{{$entrada->imagen}}">
                    </div>
                    @endif
                </div>

            </div>



            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>