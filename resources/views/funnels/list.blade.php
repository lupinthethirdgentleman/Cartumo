@extends('layouts.app')

@section("title", "Funnel List")

@section('styles')
    <style>
        .inline-content > div {
            display: inline-block;
            padding: 0px 15px;
            text-align: center;
        }

        .inline-content > div strong {
            display: block;
            font-size: 18px;
        }

        .inline-content > div i {
            cursor: pointer;
            font-size: 18px;
        }

        ul.bar_tabs > li a {
            font-weight: bold;
            font-size: 14px;
        }

        .dashboard_graph {
            border: 1px solid #e9e9e9 !important;
            -webkit-box-shadow: 0 5px 5px -5px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 5px 5px -5px rgba(0, 0, 0, 0.1);
            box-shadow: 0 5px 5px -5px rgba(0, 0, 0, 0.1);
        }

        .funnel-lists .funnel-list-item li > h3 > a, .funnel-lists .funnel-list-item li > h3 > strong {
            color: #3E474F;
            max-width: 350px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            font-weight: bold;
            color: #3E474F;
            font-size: 16px;
            line-height: 21px;
            font-family: Arial !important;
        }
    </style>
@endsection

@section('content')


    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <!-- /top tiles -->

        <br/>

        <div class="row clearfix">
            <div class="col-md-8 col-xs-8">
                <div class="row">
                    <div class="dashboard-search">
                        <form action="{{ route('funnels.search') }}" method="post">
                            <div class="form-group col-sm-12 col-md-9 col-xs-12">
                                <input type="text" name="search" id="search_funnels" class="form-control"
                                       placeholder="Search funnels ..."/>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xs-12">

                                <button type="button" class="btn special-button-primary btn-block" data-toggle="modal"
                                        data-target="#startAutoCreateFunnel">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New Funnel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="dashboard_graph">

                            <div class="col-xs-12 bg-white dashboard-funnels" style="padding-top: 15px">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#tab_content11" id="pannels-tabb" role="tab" data-toggle="tab"
                                               aria-controls="funnels" aria-expanded="true">
                                                <i class="fa fa-bars" aria-hidden="true"></i> All Funnels
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#tab_content12" id="pannels-tabb2" role="tab" data-toggle="tab"
                                               aria-controls="funnels">
                                                <i class="fa fa-calendar-o"></i> Recent
                                            </a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content22" role="tab"
                                                                            id="archived-tabb"
                                                                            data-toggle="tab" aria-controls="archived"
                                                                            aria-expanded="false"><i
                                                        class="fa fa-archive"></i> Archived</a>
                                        </li>
                                        <li role="presentation"><a href="#tab_content33" role="tab"
                                                                   id="marketplace-tabb3"
                                                                   data-toggle="tab" aria-controls="marketplace"
                                                                   aria-expanded="false"><i
                                                        class="fa fa-shopping-cart"></i> Marketplace</a></li>
                                    </ul>

                                    <div id="myTabContent2" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11"
                                             aria-labelledby="home-tab">
                                            <div class="funnel-lists">
                                                <ul>


                                                    @if ( count($funnels) > 0 )
                                                        @foreach ($funnels as $key => $funnel)
                                                            <li>
                                                                <ul class="funnel-list-item">
                                                                    <li>
                                                                        @if ( $funnel->type == 'manual' )
                                                                            <div class="funnel-demo-icon">
                                                                                <span class="glyphicon glyphicon-filter"></span>
                                                                            </div>
                                                                        @else
                                                                            <div class="funnel-demo-icons">
                                                                                <img src="{{ asset('global/img/shopify.png') }}"
                                                                                     style="width: 52px"/>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        <h3>
                                                                            <a href="{{ route('funnels.show', $funnel->id) }}">{{ $funnel->name }}</a>
                                                                        </h3>
                                                                        <p>
                                                                            <span>{{ date('d M, Y h:i a', strtotime($funnel->updated_at)) }}</span>
                                                                        </p>
                                                                    </li>
                                                                    <li class="inline-content">
                                                                        <div>
                                                                            <strong>{{ $funnel->steps->count() }}</strong>
                                                                            STEPS
                                                                        </div>
                                                                        <div><i class="fa fa-star-o" aria-hidden="true"
                                                                                title="Bookmark"></i><br/></div>

                                                                        <div>
                                                                            <a href="{{ route('funnels.edit', $funnel->id) }}"
                                                                               class="btn btn-warning" title="Edit"><i
                                                                                        class="fa fa-pencil"
                                                                                        aria-hidden="true"></i></a>
                                                                            <button class="btn btn-danger funnel_remove"
                                                                                    data-funnel-id="{{ $funnel->id }}"
                                                                                    title="Remove"><i
                                                                                        class="fa fa-trash"
                                                                                        aria-hidden="true"></i></button>
                                                                            <br/>
                                                                        </div>

                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                    <!--<button class="btn btn-lg btn-block btn-success" data-toggle="modal"
                                                                data-target="#newFunnelModal">START NEW FUNNEL
                                                        </button>-->
                                                        <p>No
                                                            <link rel="shortcut icon" href=".ico">
                                                            Funnels
                                                        </p>
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane fade" id="tab_content12"
                                             aria-labelledby="home-tab">
                                            <div class="funnel-lists">
                                                <ul>


                                                    @if ( count($recentFunnels) > 0 )
                                                        @foreach ($recentFunnels as $key => $funnel)
                                                            <li>
                                                                <ul class="funnel-list-item">
                                                                    <li>
                                                                        @if ( $funnel->type == 'manual' )
                                                                            <div class="funnel-demo-icon">
                                                                                <span class="glyphicon glyphicon-filter"></span>
                                                                            </div>
                                                                        @else
                                                                            <div class="funnel-demo-icons">
                                                                                <img src="{{ asset('global/img/shopify.png') }}"
                                                                                     style="width: 52px"/>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        <h3>
                                                                            <a href="{{ route('funnels.show', $funnel->id) }}">{{ $funnel->name }}</a>
                                                                        </h3>
                                                                        <p>
                                                                            <span>{{ date('d M, Y h:i a', strtotime($funnel->updated_at)) }}</span>
                                                                        </p>
                                                                    </li>
                                                                    <li class="inline-content">
                                                                        <div>
                                                                            <strong>{{ $funnel->steps->count() }}</strong>
                                                                            STEPS
                                                                        </div>
                                                                        <div><i class="fa fa-star-o" aria-hidden="true"
                                                                                title="Bookmark"></i><br/></div>

                                                                        <div>
                                                                            <a href="{{ route('funnels.edit', $funnel->id) }}"
                                                                               class="btn btn-warning" title="Edit"><i
                                                                                        class="fa fa-pencil"
                                                                                        aria-hidden="true"></i></a>
                                                                            <button class="btn btn-danger funnel_remove"
                                                                                    data-funnel-id="{{ $funnel->id }}"
                                                                                    title="Remove"><i
                                                                                        class="fa fa-trash"
                                                                                        aria-hidden="true"></i></button>
                                                                            <br/>
                                                                        </div>

                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                    <!--<button class="btn btn-lg btn-block btn-success" data-toggle="modal"
                                                                data-target="#newFunnelModal">START NEW FUNNEL
                                                        </button>-->
                                                        <p>No Funnels</p>
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane fade" id="tab_content22"
                                             aria-labelledby="profile-tab">
                                            @if ( $archivedFunnels->count() > 0 )
                                                <div class="funnel-lists">
                                                    <ul>
                                                        @foreach ( $archivedFunnels as $funnel )
                                                            <li>
                                                                <ul class="funnel-list-item">
                                                                    <li>
                                                                        @if ( $funnel->type == 'manual' )
                                                                            <div class="funnel-demo-icon">
                                                                                <span class="glyphicon glyphicon-filter"></span>
                                                                            </div>
                                                                        @else
                                                                            <div class="funnel-demo-icons">
                                                                                <img src="{{ asset('global/img/shopify.png') }}"
                                                                                     style="width: 52px"/>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        <h3>
                                                                            <a href="{{ route('funnels.show', $funnel->id) }}">{{ $funnel->name }}</a>
                                                                        </h3>
                                                                        <p>
                                                                            <span>{{ date('d M, Y h:i a', strtotime($funnel->created_at)) }}</span>
                                                                        </p>
                                                                    </li>
                                                                    <li class="inline-content">
                                                                        <div>
                                                                            <strong>{{ $funnel->steps->count() }}</strong>
                                                                            STEPS
                                                                        </div>
                                                                        <div><i class="fa fa-star-o" aria-hidden="true"
                                                                                title="Bookmark"></i><br/></div>

                                                                        <div>
                                                                            <button
                                                                                    class="btn btn-restore-archive"
                                                                                    title="Restore"
                                                                                    data-archive-id="{{ $funnel->id }}">
                                                                                <i class="fa fa-chevron-left"
                                                                                   aria-hidden="true"></i></button>
                                                                            <button class="btn btn-danger funnel_remove"
                                                                                    data-funnel-id="{{ $funnel->id }}"
                                                                                    title="Remove"><i
                                                                                        class="fa fa-trash"
                                                                                        aria-hidden="true"></i></button>
                                                                            <br/>
                                                                        </div>

                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @else
                                                <p>No Archived Funnels</p>
                                            @endif
                                        </div>

                                        <div role="tabpanel" class="tab-pane fade" id="tab_content33"
                                             aria-labelledby="profile-tab">
                                            @if ( $marketPlaceFunnels->count() > 0 )
                                                <div class="funnel-lists">
                                                    <ul>
                                                        @foreach ( $marketPlaceFunnels as $funnel )
                                                            <li>
                                                                <ul class="funnel-list-item">
                                                                    <li>
                                                                        @if ( $funnel->type == 'manual' )
                                                                            <div class="funnel-demo-icon">
                                                                                <span class="glyphicon glyphicon-filter"></span>
                                                                            </div>
                                                                        @else
                                                                            <div class="funnel-demo-icons">
                                                                                <img src="{{ asset('global/img/shopify.png') }}"
                                                                                     style="width: 52px"/>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        <h3>
                                                                            <strong href="javascript:void(0)">{{ $funnel->name }}</strong>
                                                                        </h3>
                                                                        <p>
                                                                            <span>{{ date('d M, Y h:i a', strtotime($funnel->created_at)) }}</span>
                                                                        </p>
                                                                    </li>
                                                                    <li class="inline-content">
                                                                        <div>
                                                                            <strong>{{ $funnel->steps->count() }}</strong>
                                                                            STEPS
                                                                        </div>
                                                                        <div><i class="fa fa-star-o" aria-hidden="true"
                                                                                title="Bookmark"></i><br/></div>

                                                                        <div>
                                                                        <!--<button
                                                                               class="btn btn-restore-archive" title="Restore" data-archive-id="{{ $funnel->id }}">
                                                                               <i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                                                                            <button class="btn btn-danger funnel_remove"
                                                                                    data-funnel-id="{{ $funnel->id }}"
                                                                                    title="Remove"><i
                                                                                        class="fa fa-trash"
                                                                                        aria-hidden="true"></i></button>-->
                                                                            <button class="btn btn-success download_funnel_from_marketplace"
                                                                                    data-funnel-id="{{ $funnel->id }}"
                                                                                    title="Remove"
                                                                                    data-funnel-url="{{ route('funnel.clone', $funnel->id) }}">
                                                                                <i class="fa fa-download"
                                                                                   aria-hidden="true"></i></button>

                                                                            <a href="{{ route('funnel.view', $funnel->slug) }}"
                                                                               class="btn btn-warning preview_funnel_from_marketplace"
                                                                               data-funnel-id="{{ $funnel->id }}"
                                                                               title="Preview Funnel"><i
                                                                                        class="fa fa-eye"
                                                                                        aria-hidden="true"></i></a>
                                                                            <br/>
                                                                        </div>

                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @else
                                                <p>No Funnels in Marketplace</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-4 col-xs-4">
                <div class="x_panel">
                    <div class="x_content">
                        <ul class="profile-sidebar">
                            <li>
                                <strong>{{ $profile->user->name }}</strong>
                                <p style="margin: 0px;">{{ $profile->user->email }}</p>
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


        <br/>


        <!-- START FUNNEL STEPS -->
        <div id="startAutoCreateFunnel" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <form id="frm_build_funnel" action="{{ route('funnels.store') }}" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Build a new engaging email list ?</h4>
                        </div>

                        <div class="modal-body --extra-padding-50">


                            <div class="new-funnel-steps step-1">
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <div class="choose-step">
                                            <ul>
                                                <li><img src="{{ asset('images/manual-product.png') }}"/></li>
                                                <li>Manual Product Funnel</li>
                                            </ul>
                                            <p>Add manual products with Cartumo funnel builder with upsells and downsells.</p>
                                            <button type="button" class="btn special-button-primary"><i
                                                        class="fa fa-plus" aria-hidden="true"></i> Choose
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="choose-step">
                                            <ul>
                                                <li><img src="{{ asset('images/shopify-product.png') }}"/></li>
                                                <li>Shopify Product Funnel</li>
                                            </ul>
                                            <p>Add products from Shopify using Cartumo funnel builder adding upsells downsells.</p>
                                            <button type="button" class="btn special-button-primary"><i
                                                        class="fa fa-plus" aria-hidden="true"></i> Choose
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="new-funnel-steps step-2">
                                <div class="form-group">
                                    <label for="funnel_name">Funnel Name</label>
                                    <input type="text" name="funnel_name" id="funnel_name" class="form-control"
                                           placeholder="give funnel a name" required/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="payment_gateway" value="both"/>
                                </div>
                            <!--<div class="form-group gateway-box">
                                    <label for="funnel_name">Payment Gateway</label>
                                    <select class="form-control" id="payment_gateway" name="payment_gateway">
                                        <option value="both">Both</option>
                                        @foreach ( $paymentGateways as $key=>$paymentGateway )
                                <option value="{{ $paymentGateway->id }}">{{ json_decode($paymentGateway->details)->title }}</option>
                                        @endforeach
                                    </select>
                                </div>-->
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn special-button-default pull-left back-step"
                                    style="display: none">
                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                Back
                            </button>

                            <button type="submit" class="btn special-button-success submit-step" style="display: none">
                                <i class="fa fa-floppy-o"
                                   aria-hidden="true"></i>
                                Start Funnel
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
<!-- js placed at the end of the document so the pages load faster -->


@section("scripts")
    <script>
        $(".new-funnel-steps .choose-step button").click(function (e) {

            e.preventDefault();

            //alert(this);

            var pos = $(this).parent().parent().index();
            var choosed = "";

            //alert(pos);

            if ($(".new-funnel-steps").find("input[type='hidden']")) {
                $(".new-funnel-steps").find(":input[name='funnel_type']").remove();
            }

            if (pos == 0) {
                $(".new-funnel-steps").append("<input type='hidden' name='funnel_type' value='manual' />");
            } else {
                $(".new-funnel-steps").append("<input type='hidden' name='funnel_type' value='shopify' />");
            }

            /*if ( pos == 0 ) {
                $(".gateway-box").show();
            } else {
                $(".gateway-box").hide();
            }*/

            $(".step-1").hide();
            $(".step-2").show();

            $(".submit-step").show();
            $(".back-step").show();
        });

        $(".back-step").click(function (e) {

            e.preventDefault();

            $(".step-2").hide();
            $(".step-1").show();

            $(".submit-step").hide();
            $(".back-step").hide();
        });


        $("#frm_build_funnel").submit(function (e) {

            e.preventDefault();

            var form = $(this);

            //alert("hello");

            $.ajax({
                type: 'POST',
                url: "{{ route('funnels.store') }}",
                data: $(this).serialize(),
                success: function (response) {
                    console.log(response);
                    var json = JSON.parse(response);

                    //alert(response);

                    //if (json.status == "success") {
                    location.href = json.route;
                    //} else {
                    //alert(json.message);
                    //}
                },
                error: function (a, b) {
                    //document.write(a.responseText);
                    console.log(a.responseText);
                }
            });
        });


    </script>


    @if ( !empty($funnel) )
        <script>
            $(".btn-restore-archive").click(function (e) {

                e.preventDefault();

                //alert($(this).attr('data-archive-id'));

                //if ( confirm("Are you sure to archive this funnel?") ) {
                $.ajax({
                    type: 'POST',
                    //url: $("#csrf_token").val() + '/funnel/' + "{{ $funnel->id }}" + '/archive/' + $(this).attr('data-archive-id') + '/remove',
                    url: "{{ route('funnel.archive.remove', $funnel->id) }}",
                    data: '_token=' + "{{ csrf_token() }}&archive_id=" + $(this).attr('data-archive-id'),
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            location.href = json.url;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
                //}

            });


            $("#search_funnels").on('keyup', function (e) {

                var element = $(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('funnels.search', $funnel->id) }}",
                    data: '_token=' + "{{ csrf_token() }}&keyword=" + $(element).val(),
                    beforeSend: function () {
                        $(".funnel-lists").addClass('text-center');
                        $(".funnel-lists").html("<img src={{ asset('images/ajax-loader.gif') }} style='margin:auto;text-align:center' />");
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        $(".funnel-lists").removeClass('text-center');

                        if (json.status == 'success') {
                            $(".funnel-lists").html(json.html)
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            });


            //clone funnel
            $(".download_funnel_from_marketplace").click(function (e) {

                e.preventDefault();

                var menu = $(this);
                var data_url = $(this).attr('data-funnel-url');

                //alert(this);

                $.ajax({
                    type: 'POST',
                    url: data_url,
                    data: '_token=' + "{{ csrf_token() }}",
                    beforeSend: function () {
                        $(menu).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    },
                    success: function (response) {
                        console.log(response);

                        var json = JSON.parse(response);

                        if (json.status == 'success') {
                            location.href = json.url;
                        }
                    },
                    error: function (a, b) {
                        console.log(a.responseText);
                    }
                });
            });
        </script>
    @endif

@endsection
