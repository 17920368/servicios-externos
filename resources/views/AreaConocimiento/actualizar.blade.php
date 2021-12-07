@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xs-12">
                <div class="card">
                    <div class="card-header">{{ __('MODIFICAR ÁREA DE CONOCIMIENTO') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('area-conocimiento.update', $areaConocimientos->idAreaC) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label for="txtNombre" class="form-label">ÁREA DE CONOCIMIENTO</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre"
                                    value="{{ $areaConocimientos->nomAreaC }}"
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <button type="submit" class="btn btn-primary">MODIFICAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
