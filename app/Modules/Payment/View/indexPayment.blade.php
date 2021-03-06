@extends('backend.MasterPage.Layout')
@section('title', TitlePage('تراکنش ها'))
@section('style')
	<link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
	<style>
		#ToolTables_DataTables_Table_0_0 {
			display: none;
		}
		
		.img-advertising {
			width: 20%;
			transition: 0.5s;
		}
		
		.img-advertising:hover {
			width: 40%;
			transition: 0.5s;
		}
		
		.border-red {
			border: 1px solid #f17676;
			background: #fff7f7;
		}
		
		.border-green {
			border: 1px solid #2ece31;
			background: #f7fff7;
		}
		
		.border-blue {
			border: 1px solid #2ececc;
			background: #f3fdff;
		}
		li.li-payment {
			background: #ffe9cf;
		}
		.row-account {
			background: #f9f9f9;
			margin: 10px;
			padding: 10px;
			border: 1px solid #d2d2d2;
			border-radius: 5px;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			@include('message.Message')
			@include('message.ErrorReporting')
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">تراکنش های بانکی</h3>
				</div>
				<div class="panel-body">
					
					
					<ul id="myTab" class="nav nav-tabs">
						<li class="active"><a href="#payment_tab" data-toggle="tab"><i class="fa fa-home"></i> تراکنش ها</a>
						</li>
						<li class=""><a href="#settings_tab" data-toggle="tab"><i class="fa fa-gears"></i> اطلاعات حساب</a>
						</li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="payment_tab">
							@if(count($paymentModel) == 0)
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-warning">
											<p>گزارشی در سیستم ثبت نشده است.</p>
										</div>
									</div>
								</div>
							@else
								<table cellpadding="0" cellspacing="0" border="0"
								       class="table table-striped table-bordered editable-datatable">
									<thead>
									<tr>
										{{--<th scope="col">ردیف</th>--}}
										<th scope="col">نوع تراکنش</th>
										<th scope="col">شماره رزرو</th>
										<th scope="col">تاریخ</th>
										<th scope="col">شماره حساب</th>
										<th scope="col">مبلغ</th>
										<th scope="col">توضیحات</th>
									</tr>
									</thead>
									<tbody>
									@foreach($paymentModel as $key => $value)
										<tr class="@if($value->status == 1) text-success @else text-danger @endif">
											{{--<td>--}}
												{{--{{ $key+1 }}--}}
											{{--</td>--}}
											<td>
												رزرو اقامتگاه
											</td>
											<td>
												100005
											</td>
											<td>
												<label>{{ \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d') }}</label>
											</td>
											<td>
												ثبت نشده
											</td>
											<td>
												{{ $value->price }}
											</td>
											<td>
												<button class="btn btn-default btn-description" data-toggle="modal" data-target="#myModal" data-description="{{$value->description}}" data-id="{{$value->id}}">توضیحات</button>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							@endif
						</div>

						<script>
							$('.btn-description').click(function () {
								$('#InputPaymentId').val($(this).attr('data-id'));
								$('#PDescription').text($(this).attr('data-description'));
                            });
						</script>
						
						
						<div class="tab-pane fade" id="settings_tab">
							<form action="{{route('StoreAccount')}}" method="post">
								{{csrf_field()}}
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputFullName">نام ونام خانوادگی صاحب حساب</label>
											<input type="text" value="{{auth()->user()->account_name}}" name="full_name" id="InputFullName" class="form-control" placeholder="نام و نام خانوادگی صاحب حساب">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputNumberCard">شماره کارت</label>
											<input type="text" value="{{auth()->user()->card_bank_number}}" name="number_card" id="InputNumberCard" class="form-control" placeholder="شماره کارت">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputShaba">شماره شبا</label>
											<input type="text" value="{{auth()->user()->shaba_number}}" name="shaba" id="InputShaba" class="form-control" placeholder="شماره شبا">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<button class="btn btn-success">ثبت حساب</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">توضیحات تراکنش</h4>
				</div>
				<div class="modal-body">
					@if(auth()->user()->role_id == 1)
						<form action="{{route('StoreDescriptionPayment')}}" method="post">
							<input type="hidden" id="InputPaymentId" name="payment_id" value="">
							{{csrf_field()}}
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="TextAreaDescription">توضیحات</label>
										<textarea id="TextAreaDescription" class="form-control" name="description" placeholder="توضیحات مربوطه"></textarea>
									</div>

								</div>
								<div class="col-md-6">
									<div class="form-group text-left">
										<button type="submit" class="btn btn-success btn-block">
											ثبت توضیحات
										</button>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group text-left">
										<button type="button" class="btn btn-default btn-block" data-dismiss="modal">بستن</button>
									</div>
								</div>
							</div>
						</form>
					@else
						<p id="PDescription"></p>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
		
		
@section('script')
	<script src="{{asset('frontend/js/script.js')}}" type="text/javascript"></script>
	<script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>
	<script>
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $input = $( "#InputCardBankNumber" );

                $input.on( "keyup", function( event ) {


                    // When user select text in the document, also abort.
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }

                    // When the arrow keys are pressed, abort.
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                        return;
                    }

                    var $this = $(this);
                    var input = $this.val();
                    input = input.replace(/[\W\s\._\-]+/g, '');

                    var split = 4;
                    var chunk = [];

                    for (var i = 0, len = input.length; i < len; i += split) {
                        split = ( i >= 8 && i <= 16 ) ? 4 : 4;
                        chunk.push( input.substr( i, split ) );
                    }

                    $this.val(function() {
                        return chunk.join(" - ").toUpperCase();
                    });

                } );

                /**
                 * ==================================
                 * When Form Submitted
                 * ==================================
                 */
                $form.on( "submit", function( event ) {

                    var $this = $( this );
                    var arr = $this.serializeArray();

                    for (var i = 0; i < arr.length; i++) {
                        arr[i].value = arr[i].value.replace(/[($)\s\._\-]+/g, ''); // Sanitize the values.
                    };

                    console.log( arr );

                    event.preventDefault();
                });

            });
        })(jQuery);
        
        
        
        
        // $(function () {
        //     $('#InputCardBankNumber').on('keyup', function () {
        //         var culture = $(this).val();
        //         var formattedNumber = formatNumber(2132, culture);
        //         $("#txtNum").val(formattedNumber);
        //     });
        // });
		//
        // function formatNumber(num, currentculture) {
        //     Globalize.culture(currentculture);
        //     if (isNaN(num))
        //         return('Number not valid');
        //     return (Globalize.format(num, "n2"));
        // }
	</script>
@endsection