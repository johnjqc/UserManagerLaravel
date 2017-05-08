@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">

            <strong>Editar Usuario:</strong> {{ $user->name }}
            <a href="/users" class="btn btn-primary btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Regresar a </span>Usuarios
            </a>

          </div>
          <form method="post" action="/users/{{ $user->id }}">
            <input name="_method" type="hidden" value="PUT" />
            <input name="_token" type="hidden" value="{{ csrf_token() }}" />

            <div class="panel-body">

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                <div class="col-md-9">
                  <div class="input-group">
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-user }}" aria-hidden="true"></i></label>
                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ $user->name}}" />
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                <div class="col-md-9">
                  <div class="input-group">
                    <label class="input-group-addon" for="email"><i class="fa fa-fw fa-envelope " aria-hidden="true"></i></label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}" />
                  </div>
                </div>
              </div>

              <div class="pw-change-container">
                <div class="form-group has-feedback row">
                  <div class="col-md-9">
                    <div class="input-group">
                      <label class="input-group-addon" for="password"><i class="fa fa-fw fa-lock" aria-hidden="true"></i></label>
                      <input type="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-footer">

                <div class="row">

                  <div class="col-xs-6">
                    <button type="submit" class="btn btn-success btn-block margin-bottom-1 btn-change-pw" >
                      <i class="fa fa-fw fa-save" aria-hidden="true"></i> Actualizar
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
