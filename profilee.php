<?php include('includes/header.php');?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Profile</li>
      </ol>
    </section>
    <div class="box box-solid">
	        			<div class="box-body">
	        				<div class="col-sm-3">
                  
	        					<img src="<?php echo (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/profile.jpg'; ?>" width="100%">
	        				</div>
	        				<div class="col-sm-9">
	        					<div class="row">
	        						<div class="col-sm-3">
	        							<h4>Userame:</h4>
	        							<h4>Email:</h4>
												<h4>Cource</h4>
												<h4>Year of study</h4>                                        
	        							<h4>Skills</h4>
	        							<h4>Note</h4>
	        							<h4>Member Since:</h4>
	        						</div>
	        						<div class="col-sm-9">
	        							<h4><?php echo $row['username']; ?>
	        								<span class="pull-right">
	        									<a href="#profile" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
	        								</span>
	        							</h4>
	        							<h4><?php echo $row['email']; ?></h4>
												<h4><?php echo $row['course'] ?></h4>
												<h4><?php echo $row['year_of_study'] ?></h4>
	        							<h4><?php echo $row['skills']; ?></h4>	        							
												<h4><?php echo $row['notes']; ?></h4>
												<h4><?php echo date('M d, Y', strtotime($row['username'])) ?></h4>
	        						</div>
	        					</div>
	        				</div>
	        			</div>
	        		</div>
                <div class="box box-solid">
	        			<div class="box-header with-border">
	        				<h4 class="box-title"><i class="fa fa-calendar"></i> <b>Post History</b></h4>
	        			</div>
	        			<div class="box-body">	        				
	        					<?php       		
												try{
														$sql ='SELECT * FROM members';
														$stmt = $pdo->prepare($sql);
														$stmt->execute();

													foreach($stmt as $row){
														$sql ='SELECT * FROM members';
														$stmt2 = $pdo->prepare($sql);
														$stmt2->execute();
														$total = 0;

													foreach($stmt2 as $row2){
															$subtotal ='price';
															$total  = 'subtotal';
													}
														echo "
														
													     	";
													}
												}
												catch(PDOException $e){
													echo "There is some problem in connection: " . $e->getMessage();
									 	    }	        					
	        					 ?>	        				
	        			</div>
	        		</div>
  </div>

  <?php include('includes/profile_modal.php'); ?>
	
  <?php include('includes/footer.php');?>

<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'category_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.catid').val(response.id);
      $('#edit_name').val(response.name);
      $('.catname').html(response.name);
    }
  });
}
</script>
