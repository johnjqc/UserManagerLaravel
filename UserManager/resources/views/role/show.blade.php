@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">

            <strong>Editing User:</strong> {{ $user->name }}

            <a href="/users/{{$user->id}}" class="btn btn-primary btn-xs pull-right" style="margin-left: 1em;">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
             Back  <span class="hidden-xs">to User</span>
            </a>

            <a href="/users" class="btn btn-info btn-xs pull-right">
              <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
              <span class="hidden-xs">Back to </span>Users
            </a>

          </div>


            <div class="panel-body">

              <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                <div class="col-md-9">
                  <div class="input-group">
                    <label class="input-group-addon" for="name"><i class="fa fa-fw fa-user }}" aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                <div class="col-md-9">
                  <div class="input-group">
                    <label class="input-group-addon" for="email"><i class="fa fa-fw fa-envelope " aria-hidden="true"></i></label>
                  </div>
                </div>
              </div>






              <div class="pw-change-container">
                <div class="form-group has-feedback row">
                  <div class="col-md-9">
                    <div class="input-group">
                      <label class="input-group-addon" for="password"><i class="fa fa-fw {{ trans('forms.create_user_icon_password') }}" aria-hidden="true"></i></label>
                    </div>
                  </div>
                </div>

                <div class="form-group has-feedback row">
                  <div class="col-md-9">
                    <div class="input-group">
                      <label class="input-group-addon" for="password_confirmation"><i class="fa fa-fw {{ trans('forms.create_user_icon_pw_confirmation') }}" aria-hidden="true"></i></label>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="panel-footer">

              <div class="row">

                <div class="col-xs-6">
                  <a href="#" class="btn btn-default btn-block margin-bottom-1 btn-change-pw" title="Change Password">
                    <i class="fa fa-fw fa-lock" aria-hidden="true"></i>
                    <span></span> Change Password
                  </a>
                </div>
                <div class="col-xs-6">
                </div>
              </div>
            </div>


        </div>
      </div>
    </div>
  </div>



@endsection
