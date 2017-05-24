<div class="col-md-12 p-all-0 p-l-10">
	<div class="col-md-12 m-b-1 p-t-20">
		<div class="col-md-12 b-all-gray b-t-blue1 radius-3 p-all-0">
			<div class="col-md-12 bg-3">	
				<span class="ln-title">Rooms</span>			
			</div>


			<div class="col-md-12 p-all-0">
				<div class="col-md-6 bg-1">
					<table class="p-l-0 m-t-10 rm-content" id="rm-content">
					<?php					
					echo $this->rooms['html1'];
					?>
					</table>
				</div>
				<div class="col-md-6 bg-1">
					<table class="p-l-0 m-t-10 rm-content" id="rm-content">
					<?php
					echo $this->rooms['html2'];
					?>
					</table>
				
				</div>
				<div class="col-md-12 bg-1">
					<table class="p-l-0 m-t-10 rm-content" id="rm-content">
					<?php
					echo $this->rooms['pagination'];
					?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
