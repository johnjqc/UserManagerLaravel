@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @if (Session::has('message'))
              <div class="alert alert-success">{{ Session::get('message') }}</div>
          @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                            Lista de Permisos
                            <div class="btn-group pull-right btn-group-xs">
                              <a class="btn btn-default btn-block" href="/permissions/create">
                                  <i class="fa fa-fw fa-permission" aria-hidden="true"></i>
                                  Crear Nuevo Permiso
                              </a>
                            </div>
                        </div>
                  </div>

                <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Email</th>
                                  <th>Fecha de Cracion</th>
                                  <th></th>
                              </tr>
                          </thead>

                          <tbody>
                              @foreach ($permissions as $permission)
                              <tr>
                                  <td>{{ $permission->name }}</td>
                                  <td>{{ $permission->description }}</td>
                                  <td>{{ $permission->created_at->format('F d, Y h:ia') }}</td>
                                  <td>
                                      <a href="/permissions/{{ $permission->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>
                                      <form action="{{route('permissions.destroy', $permission->id)}}" method="post">
                                        <input name="_method" type="hidden" value="DELETE" />
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                                        <button type="submit" class="btn btn-danger" > Eliminar </button>

                                      </form>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
