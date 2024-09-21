
<?php //if($_settings->chk_flashdata('success')):
	////////////  كودعرض البيانات  في الرئيسي view////////////////////kimi/////////////
	/*echo "<img src='data:image/jpeg;base64,$image' alt='$name'>";
	
	echo "<img src='data:image/jpeg;base64,$image' alt='$name' width='100' height='100'>";
	$image = $row['image'];
	echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='الصورة المحملة'>";
	echo "<img src='data:image/jpeg;base64," . base64_encode($image) . "' alt='$name'>";


	    
    <label for="image">Image:</label>
    <input type="file" name="image" id="image" required><br><br>
    


	while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $name = $row['name'];
        $age = $row['age'];
        $image = $row['image'];

        echo "<img src='data:image/jpeg;base64," . base64_encode($image) . "' alt='$name'>";

        echo "<p>Name: $name</p>";
        echo "<p>Age: $age</p>";
    }


*/



        echo "</div>";


	////////////  كودعرض البيانات  في الرئيسي view////////////////////kimi//////////////













	 ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php //endif;?>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h1 class="card-title"><?php 
				
						$qry = $conn->query("SELECT * from `kimi` where id =126 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?><img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" width="150" height="90">
							WELCOME YUE KIMI </h1>
		
							
				                 
									<?php  if($_settings->userdata('type')>=0): ?>
				                   <?php  endif; ?>
				                  
							
					<?php endwhile; ?>
	


























		<?php //if($_settings->userdata('type') == 1): ?>
		<div class="card-tools">
		
		<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New-kimi</a>
		</div>
		<?php //endif; ?>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Created</th>
						<th>Name</th>
						<th>Status</th>
						<th>image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `kimi` where id >= 1 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['id'] ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['age'] ?></td>
							<td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>" width="150" height="90"></td>
							<?php
	//echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='الصورة المحملة' width='100' height='100'></td>";
	//echo "<td><img src='data:image/jpeg;base64,$image' alt='الصورة المحملة'  width='100' height='100'></td>";
	
	//echo "<td><img src='data:image/jpeg;base64,$image=". $row['image']." alt='الصورة المحملة' width='100' height='100'></td>";
	//$image = $row['image'];
	//echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='الصورة المحملة' width='100' height='100'></td>";
//echo "<td><img src='data:image/jpeg;base64," . base64_encode($image) . "' alt='الصورة المحملة' width='100' height='100'></td>";

							?>
							<td align="center">
								 <button type="button" class="btn btn-flat p-1 btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<?php  if($_settings->userdata('type')>=0): ?>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
									<?php  endif; ?>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Dorm permanently?","delete_kimi",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add New Dorm","kimis/manage_kimi.php")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-bars'></i> Dorm Details","kimis/view_kimi.php?id="+$(this).attr('data-id'))
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Update Dorm Details","kimis/manage_kimi.php?id="+$(this).attr('data-id'))
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [4] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_kimi($id){
		start_loader();
		$.ajax({
			url:_base_url_+"Master.php?f=delete_kimi",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>