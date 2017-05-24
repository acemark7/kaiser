<div class="col-md-12 p-all-0 p-l-10">
	<div class="col-md-3 m-b-1 p-t-20 bg-1">
		<div class="col-md-12 p-all-0">
			<div class="col-md-12 p-all-0 src-body">
				<div class="input-group src-form p-all-5 bg-3">
				  <input type="text" class="form-control bg-3 color-6 size-13" placeholder="Search Patient" aria-describedby="src-input" id="search-patient">
				  <span class="input-group-addon bg-3 pointer" id="src-input">
					<i class="fa fa-search color-4 size-18" aria-hidden="true"></i>
				  </span>
				</div>
			</div>
			<div class="col-md-12 src-result bg-1 b-all-gray m-t-5 hide">
				<ul class="p-l-0 m-t-10" id="patient-src">
					<li class="p-all-5 b-t-gray pointer">No results found</li>
				</ul>
			</div>
		</div>
		<div class="col-md-12 p-all-0" id="patient-record">
			<div class="col-md-12 center no-p-record p-all-20">
				<img src="resources/images/Icons/icon-searchpatient.png">
			</div>
		</div>
	</div>
	<div class="col-md-9 m-b-1 p-t-20">
		<div class="col-md-12 b-all-gray b-t-blue1 radius-3 p-all-0">
			<div class="col-md-12 bg-3">
				<div class="col-md-6 p-all-0">
				
					<span class="ln-title">Rooms</span>
					
					<div class="btn-group m-t-5 m-b-5 dd-body pull-right">
					  <button type="button" class="btn btn-default size-13 b-all-0">Show All</button>
					  <button type="button" class="btn btn-default dropdown-toggle size-13 b-all-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-angle-down color-4" aria-hidden="true"></i>
					  </button>
					  <ul class="dropdown-menu" id="select-status">
						<li class="pointer"><a data-status="">Show All</a></li>
						<li class="pointer"><a data-status="ready">Room Ready</a></li>
						<li class="pointer"><a data-status="waiting">Patient Waiting</a></li>
						<li class="pointer"><a data-status="ongoing">On Going</a></li>
						<li class="pointer"><a data-status="toclean">To Be Cleaned</a></li>
						<li class="pointer"><a data-status="video">Video</a></li>
						<li class="pointer"><a data-status="maintenance">Maintenance</a></li>
					  </ul>
					</div>
				</div>
			</div>
			<div class="col-md-12 p-all-0">
				<div class="col-md-6 bg-1">
					<table class="p-l-0 m-t-10 rm-content" id="rm-content">
					<?php
					echo $this->room_content;
					?>
					</table>
				</div>
				<div class="col-md-6">
				Right
				</div>
			</div>
		</div>
	</div>
</div>
