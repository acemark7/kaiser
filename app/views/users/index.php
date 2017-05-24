<div class="col-md-12 p-all-0 p-l-10" id="user-all">
	<div class="col-md-12 m-b-1 p-t-20">
		<div class="col-md-12 b-all-gray b-t-blue1 radius-3 p-all-0">
			<div class="col-md-12 bg-3">
				<div class="col-md-9 bg-3">			
					<span class="ln-title">Users</span>	
				</div>
				<div class="col-md-3 bg-3 input-group src-form p-all-5">
				  <input type="text" class="form-control color-6 size-13" placeholder="Search" aria-describedby="src-input" id="search-user">
				  <span class="input-group-addon bg-1 pointer" id="src-user-input">
					<i class="fa fa-search color-6 bg-3 size-18" aria-hidden="true"></i>
				  </span>
				</div>				
			</div>


			<div class="col-md-12 p-all-0">
				<div class="col-md-12 bg-1" >
					<table class="p-l-0 m-t-10 rm-content usertbl" id="user-content">
					<tr class="rm-item-room b-b-gray">
					<td>
					<p class="m-l-10 f-bold">NAME <i class="fa fa-sort-desc pointer descend-user sort" aria-hidden="true"></i></p>
					</td>
					<td>
					<p class="m-l-10 f-bold">USERNAME</p>
					</td>
					<td>
					<p class="m-l-10 f-bold">PASSWORD</p>
					</td>
					<td>
					<p class="m-l-10 f-bold">USER TYPE</p>
					</td>
					<td align="right">
					<p class="m-b-0 m-l-10 color-3 size-13 pointer add-user-form"><i class="fa fa-medkit m-b-0 m-r-5 pointer color-3 add-user-form" aria-hidden="true" ></i>Click to Add New User</p>
					</td>
					</tr>
					</table>
					<table class="p-l-0 m-t-10 rm-content-user usertbl" id="user-content2">
					<?php					
					echo $this->user;
					?>
					</table>
				</div>	
			</div>
		</div>
	</div>
</div>
