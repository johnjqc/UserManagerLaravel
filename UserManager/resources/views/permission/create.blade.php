@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">

            <strong>Registro de Permiso</strong>
            <a href="/permissions" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Regresar a </span>Permisos
            </a>

          </div>
          <form method="post" action="/permissions">
            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            <div class="panel-body">

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                <div class="col-md-9">
                  <div class="input-group">
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-permission }}" aria-hidden="true"></i></label>
                    <input type="text" name="name" class="form-control" placeholder="Nombre"  />
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                <div class="col-md-9">
                  <div class="input-group">
                    <label class="input-group-addon" for="description"><i class="fa fa-fw fa-envelope " aria-hidden="true"></i></label>
                    <input type="text" name="description" class="form-control" placeholder="Description"  />
                  </div>
                </div>
              </div>

            <div class="panel-footer">

              <div class="row">

                <div class="col-xs-6">
                  <button type="submit" class="btn btn-success btn-block margin-bottom-1 btn-change-pw" >
                    <i class="fa fa-fw fa-save" aria-hidden="true"></i> Crear
                  </button>
                </div>
                <div class="col-xs-6">
                </div>
              </div>
            </div>
        </div>
          </form>
      </div>
    </div>
  </div>



@endsection
