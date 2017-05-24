<div class="col-md-12 p-all-0 p-t-20">
	<div class="col-md-12 p-all-0 p-l-10">
		<div class="col-md-2 p-l-0 m-b-1">
			<div class="col-md-12 b-all-gray rm-status hotel radius-3">
				<div class="col-md-12 color-9">
					<p class="f-bold size-48 m-b-0" id="ctr-ready"><?php echo sprintf("%02d", $this->counter['ready'])?></p>
					<p class="size-14">Room Ready</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 p-l-0 m-b-1">
			<div class="col-md-12 b-all-gray rm-status hourglass-half radius-3">
				<div class="col-md-12 color-3">
					<p class="f-bold size-48 m-b-0" id="ctr-waiting"><?php echo sprintf("%02d", $this->counter['waiting'])?></p>
					<p class="size-14">Patient Waiting</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 p-l-0 m-b-1">
			<div class="col-md-12 b-all-gray rm-status heart radius-3">
				<div class="col-md-12 color-4">
					<p class="f-bold size-48 m-b-0" id="ctr-ongoing"><?php echo sprintf("%02d", $this->counter['ongoing'])?></p>
					<p class="size-14">On Going</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 p-l-0 m-b-1">
			<div class="col-md-12 b-all-gray rm-status hand-paper radius-3">
				<div class="col-md-12 color-6">
					<p class="f-bold size-48 m-b-0" id="ctr-toclean"><?php echo sprintf("%02d", $this->counter['toclean'])?></p>
					<p class="size-14">To Be Cleaned</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 p-l-0 m-b-1">
			<div class="col-md-12 b-all-gray rm-status cogs radius-3">
				<div class="col-md-12 color-10">
					<p class="f-bold size-48 m-b-0" id="ctr-maintenance"><?php echo sprintf("%02d", $this->counter['maintenance'])?></p>
					<p class="size-14">Maintenance</p>
				</div>
			</div>
		</div>
		<div class="col-md-2 p-l-0">
			<div class="col-md-12 b-all-gray rm-status video-camera radius-3">
				<div class="col-md-12 color-5">
					<p class="f-bold size-48 m-b-0" id="ctr-video"><?php echo sprintf("%02d", $this->counter['video'])?></p>
					<p class="size-14">Video</p>
				</div>
			</div>
		</div>
	</div>

	<div class="line m-t-20"></div>

	<div class="col-md-12 p-all-0 p-l-10 m-t-20" id="rooms">
		<?php echo $this->rooms;?>
		
		<!--
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="1">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-green">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 1
					<font class="pull-right bg-4 color-1 size-11 rm-mark radius-3">Ready</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 hotel">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="2">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm b-t-blue2">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 2
					<font class="pull-right bg-5 color-1 size-11 rm-mark radius-3">Waiting</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 size-13">
					<div class="col-md-12 p-all-0">
						<font class="f-bold">PATIENT</font> : <font class="">Doe, J.</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">DOCTOR</font> : <font class="">Dr. Strange</font> <font class="pull-right color-3">00:00:59</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">NURSE</font> : <font class="">Joy</font> <font class="pull-right color-3">00:00:07</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">M.A</font> : <font class="">Theresa</font> <font class="pull-right color-3">00:00:02</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">NOTES</font> : ---
					</div>
				</div>
				<div class="col-md-12 bg-3 rm-bottom p-t-10 p-b-10 b-t-gray size-11">
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">WAITING TIME</font> : <font class="">06:10:22</font>
					</div>
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">START TIME</font> : <font class="">07:20:12</font>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="3">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-green">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 3
					<font class="pull-right bg-4 color-1 size-11 rm-mark radius-3">Ready</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 hotel">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-10 room" data-id="4">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-green">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 4
					<font class="pull-right bg-4 color-1 size-11 rm-mark radius-3">Ready</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 hotel">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15  room" data-id="5">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-blue1">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 5
					<font class="pull-right bg-6 color-1 size-11 rm-mark radius-3">On Going</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 size-13">
					<div class="col-md-12 p-all-0">
						<font class="f-bold">PATIENT</font> : <font class="">Doe, J.</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">DOCTOR</font> : <font class="">Dr. Strange</font> <font class="pull-right color-4">00:00:59</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">NURSE</font> : <font class="">Joy</font> <font class="pull-right color-4">00:00:07</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">M.A</font> : <font class="">Theresa</font> <font class="pull-right color-4">00:00:02</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">NOTES</font> : ---
					</div>
				</div>
				<div class="col-md-12 bg-3 rm-bottom p-t-10 p-b-10 b-t-gray size-11">
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">WAITING TIME</font> : <font class="">06:10:22</font>
					</div>
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">START TIME</font> : <font class="">07:20:12</font>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="6">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-blue1">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 6
					<font class="pull-right bg-6 color-1 size-11 rm-mark radius-3">On Going</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 size-13">
					<div class="col-md-12 p-all-0">
						<font class="f-bold">PATIENT</font> : <font class="">Doe, J.</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">DOCTOR</font> : <font class="">Dr. Strange</font> <font class="pull-right color-4">00:00:59</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">NURSE</font> : <font class="">Joy</font> <font class="pull-right color-4">00:00:07</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">M.A</font> : <font class="">Theresa</font> <font class="pull-right color-4">00:00:02</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">NOTES</font> : ---
					</div>
				</div>
				<div class="col-md-12 bg-3 rm-bottom p-t-10 p-b-10 b-t-gray size-11">
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">WAITING TIME</font> : <font class="">06:10:22</font>
					</div>
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">START TIME</font> : <font class="">07:20:12</font>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="7">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-green">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 7
					<font class="pull-right bg-4 color-1 size-11 rm-mark radius-3">Ready</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 hotel">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="8">
			<div class="col-md-12 p-all-0 b-all-red radius-3 rm">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 8
					<font class="pull-right bg-7 color-1 size-11 rm-mark radius-3">Waiting</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 size-13">
					<div class="col-md-12 p-all-0">
						<font class="f-bold">PATIENT</font> : <font class="">Doe, J.</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">DOCTOR</font> : <font class="">Dr. Strange</font> <font class="pull-right color-8">00:00:59</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">NURSE</font> : <font class="">Joy</font> <font class="pull-right color-8">00:00:07</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">M.A</font> : <font class="">Theresa</font> <font class="pull-right color-8">00:00:02</font>
					</div>
					<div class="col-md-12 p-all-0">
						<font class="f-bold">NOTES</font> : ---
					</div>
				</div>
				<div class="col-md-12 bg-7 rm-bottom p-t-10 p-b-10 b-t-gray size-11 color-1">
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">WAITING TIME</font> : <font class="">06:10:22</font>
					</div>
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">START TIME</font> : <font class="">07:20:12</font>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="9">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-green">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 9
					<font class="pull-right bg-4 color-1 size-11 rm-mark radius-3">Ready</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 hotel">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="10">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-green">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 10
					<font class="pull-right bg-4 color-1 size-11 rm-mark radius-3">Ready</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 hotel">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="11">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-green">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 11
					<font class="pull-right bg-4 color-1 size-11 rm-mark radius-3">Ready</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 hotel">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="12">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-green">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 12
					<font class="pull-right bg-4 color-1 size-11 rm-mark radius-3">Ready</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 hotel">
					&nbsp;
				</div>
			</div>
		</div>
		<div class="col-md-5ths p-l-0 m-b-15 room" data-id="13">
			<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm b-t-gray2">
				<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
					Exam Room 13
					<font class="pull-right bg-8 color-1 size-11 rm-mark radius-3">Maintenance</font>
				</div>
				<div class="col-md-12 rm-mid p-t-10 cogs">
					&nbsp;
				</div>
			</div>
		</div>
		-->
	</div>
</div>

