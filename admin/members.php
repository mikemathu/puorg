<?php include('includes/header.php');?>

<?php

                      ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">

   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Members
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Members</li>
        <li class="active">Members</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <!-- <a href="#add_member" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Member</a> -->
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Photo</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>status</th>
                  <th>Date Joined</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  <?php
                    try{
                          $sql = 'SELECT 
                                      *, p.photo AS photo 
                                  FROM 
                                      members 
                                  LEFT JOIN
                                      profile p ON members.id=p.member_id';
                          $stmt = $pdo->prepare($sql);
                          $stmt->execute();
                          
                          foreach($stmt as $user){
                            $image = (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg';

                            if($user['status'] != 0 ) {

                              $status = '<a href="#block" data-toggle="modal"  data-id='.$user['id'].' onclick="goDoSomething(this);" class="btn btn-danger block btn-xs">Block</a>';
                             
                            } else{
                             

                              $status = '<a href="#unblock"   data-toggle="modal" data-id='.$user['id'].' onclick="goDoSomething(this);"  class="btn btn-warning block btn-xs" >UnBlock</a>';

                            }
                            
                            // $status = (!$user['status']) ? '<a href="#unblock"   data-toggle="modal" data-id='.$user['id'].' onclick="goDoSomething(this);"  class="btn btn-warning block btn-xs" >UnBlock</a>' : '<a href="#block" data-toggle="modal"  data-id='.$user['id'].' onclick="goDoSomething(this);" class="btn btn-danger block btn-xs">Block</a>';
                            echo "
                              <tr>
                                  <td>
                                    <img src='".$image."' height='30px' width='30px'>
                                    




                              
                                  </td>
                                  <td>".$user['email']."</td>
                                  <td>".$user['username'].' '.$user['username']."</td>
                                  <td>

                               
                                    <a href='' data-id='".$row['id']."' onclick='goDoSomething(this);'  data-toggle='modal' '> ".$status."</a>

                                    
                                    

                                  </td>
                                  <td>".date('M d, Y', strtotime($user['username']))."</td>
                                  <td>

                                  <script>

                                    function goDoSomething(d){
                                        var ids=d.getAttribute('data-id');
                                        document.cookie = 'ids='+ids;
                                         alert(d.getAttribute('data-id'));
                                    }
                                
                                </script>

                                  <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$user['id']."' onclick='goDoSomething(this);' data-toggle='modal' '><i class='fa fa-trash'></i> Delete</button>  


                                    <a role='button' href='user_profile.php?member=".$user['id']."' class='btn btn-primary btn-sm btn-flat' data-id='".$user['id']."' onclick='goDoSomething(this);' ><i class='fa fa-eye'></i> View Profile</a>  

                              
                                                 
                                  </td>
                              </tr>
                            ";
                          } 
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }  
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>

  <?php include('includes/member_modal.php'); ?>

  <?php include('includes/footer.php');?>



  <!-- <style>
   @media(max-width:768px){
	.table-bordered thead th:(first-child){
		display:none;
		}
	}

    </style> -->

  <script src="..js/index.js"></script>	
  
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

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.status', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'users_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.userid').val(response.id);
      $('#edit_email').val(response.email);
      $('#edit_password').val(response.password);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#edit_contact').val(response.contact_info);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>