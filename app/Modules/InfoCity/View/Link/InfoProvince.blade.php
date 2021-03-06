<?php
$infoProvinceModel = \App\Modules\InfoCity\Controllers\InfoCityController::GetInfoProvince();
//dd($infoProvinceModel);
?>
<style>
	a.province-link {
		padding: 3px 9px;
		margin: 0px 5px;
		color: #eee !important;
		transition: .5s;
		font-size: 10px;
		margin-bottom: 5px;
	}
	.box-info-city {
		border: 1px solid #e8e8e85c;
		float: right;
		width: 100%;
		margin-bottom: 9px;
		border-top-left-radius: 8px;
		border-bottom-right-radius: 8px;
		padding: 2px 0px;
		background: #ffffff21;
		cursor: pointer;
		transition: .5s;
	}
	.box-info-city:hover {
		background: #ffffff51;
		transition: .5s;
	}
	a.province-link:hover {
		color: #ddd !important;
		transition: .5s;
	}
</style>

@foreach($infoProvinceModel as $key => $value)
	<div class="col-md-3 col-xs-6 text-center p-0">
		<div class="box-info-city">
			<a class="province-link" style="" href="{{route('DetailProvince', ['id' => $value->id])}}">{{$value->getProvince->name}}</a>
		</div>
	</div>
@endforeach
