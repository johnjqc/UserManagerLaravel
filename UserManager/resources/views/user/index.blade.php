@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>Date/Time Added</th>
                                  <th></th>
                              </tr>
                          </thead>

                          <tbody>
                              @foreach ($users as $user)
                              <tr>
                                  <td>{{ $user->name }}</td>
                                  <td>{{ $user->email }}</td>
                                  <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                                  <td>
                                      <a href="/users/{{ $user->id }}/edit" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                      <form action="{{route('users.destroy', $user->id)}}" method="post">
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
