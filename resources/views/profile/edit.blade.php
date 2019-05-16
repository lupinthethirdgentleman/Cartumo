@extends('layouts.app')

@section("title", "Profile")



@section('content')


    <!-- page content -->
    <div class="right_col" role="main">

        <div class="page-title">
            <div class="title_left">
                <h2 class="dashboard-page-title"><i class="fa fa-user"></i> User Profile</h2>
            </div>
        </div>

        <div class="row clearfix">

            <div class="col-md-8">
                <div class="x_panel">
                    <div class="x_content">
                        {!! Form::open(array('route' => 'profile.store', 'data-parsley-required' => '', 'class' => 'form-horizontal form-label-left input_mask')) !!}

                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label("first_name", "First Name:") }}
                                {{ Form::text('first_name', explode(' ', Auth::user()->name)[0], array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'autofocus' => '', 'placeholder' => 'First Name')) }}
                                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                            </div>


                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label("last_name", "Last Name:") }}
                                {{ Form::text('last_name', (!empty(explode(' ', Auth::user()->name)[1])) ? explode(' ', Auth::user()->name)[1] : '', array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Last Name')) }}
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label("email", "Email Address:") }}
                                {{ Form::email('email', Auth::user()->email, array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Email')) }}
                                <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label("phone", "Phone:") }}
                                {{ Form::text('phone', (!empty($data['profile']->phone)) ? $data['profile']->phone : '', array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Phone Number')) }}
                                <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-xs-12 form-group has-feedback">
                              {{ Form::label("password", "Password:") }}
                              {{ Form::password('password', array('class' => 'form-control has-feedback-right', 'maxlength' => 255, 'placeholder' => 'Password')) }}
                              <span class="fa fa-lock form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-xs-12 form-group has-feedback">
                                {{ Form::label("address", "Address:") }}
                                {{ Form::textarea('address', (!empty($data['profile']->street_address)) ? $data['profile']->street_address : '', array('class' => 'form-control', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Address')) }}
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label("city", "City:") }}
                                {{ Form::text('city', (!empty($data['profile']->city)) ? $data['profile']->city : '', array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'placeholder' => 'City')) }}
                                <span class="fa fa-address-card form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label("country", "Country:") }}
                                {{ Form::text('country', (!empty($data['profile']->country)) ? $data['profile']->country : '', array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Country')) }}
                                <span class="fa fa-address-card form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label("state", "State:") }}
                                {{ Form::text('state', (!empty($data['profile']->state)) ? $data['profile']->state : '', array('class' => 'form-control has-feedback-left', 'required' => '', 'maxlength' => 255, 'placeholder' => 'State')) }}
                                <span class="fa fa-address-card form-control-feedback left" aria-hidden="true"></span>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                {{ Form::label("zip", "ZIP:") }}
                                {{ Form::text('zip', (!empty($data['profile']->zip)) ? $data['profile']->zip : '', array('class' => 'form-control has-feedback-right', 'required' => '', 'maxlength' => 255, 'placeholder' => 'Zip')) }}
                                <span class="fa fa-address-card form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3 text-right">
                                <!--<button type="button" class="btn btn-danger">Cancel</button>
                                <button class="btn btn-warning" type="reset">Reset</button>-->
                                <button type="submit" class="btn btn-success"> Save</button>
                            </div>
                        </div>


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-xs-4">
                <div class="x_panel">
                    <div class="x_content">
                        <ul class="profile-sidebar">
                            <li>
                                <strong>{{ Auth::user()->name }}</strong>
                                <p style="margin: 0px;">{{ Auth::user()->email }}</p>
                            </li>

                            <li class="pull-right">
                                <img src="{{ asset('global/img/profile-avatar.png') }}"/>
                            </li>
                        </ul>

                        <div class="profile-content">
                            <table>
                                <tr>
                                    <th>PLAN</th>
                                    <td>
                                        @if ( (!empty(Auth::user()->secret)) )
                                            @if ( Auth::user()->secret == env('REGISTER_CODE_MONTHLY') )
                                                (${{ env('MONTHLY_PLAN') }} / MONTH)
                                            @elseif ( Auth::user()->secret == env('REGISTER_CODE_YEARLY') )
                                                (${{ env('YEARLY_PLAN') }} / YEAR)
                                            @elseif ( Auth::user()->secret == env('REGISTER_CODE_LIFETIME_PROMO') )
                                                <b style="color:#45b39c; text-transform: none">7 days free trial</b>
                                            @else
                                                <b style="color:#45b39c; text-transform: none">Lifetime</b>
                                            @endif
                                        @else
                                            @if ( Auth::user()->subscription('main')->onTrial() )
                                                <b style="color:#45b39c; text-transform: none">You are on Trial period</b>
                                            @endif
                                            @if ( Auth::user()->subscribedToPlan('monthly', 'main') )
                                                (${{ env('MONTHLY_PLAN') }} / MONTH)
                                            @else
                                                (${{ env('YEARLY_PLAN') }} / YEAR)
                                            @endif
                                        @endif
                                    </td>
                                    </th>
                                </tr>


                                <tr>
                                    <th>SALES</th>
                                    <td>${{ number_format($data['total_sales'], 2) }}</td>
                                </tr>
                                <tr>
                                    <th>FUNNELS</th>
                                    <td>{{ $data['total_funnels'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
<!-- js placed at the end of the document so the pages load faster -->

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>
@endsection
