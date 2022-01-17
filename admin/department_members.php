<?php 
  include('includes/header.php');  
 
  $_SESSION['id'] = $_GET['department'];

  $id = $_SESSION['id'];

  $sql ='SELECT * FROM departments WHERE id = :id ';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['id'=>$id]);
  $departmentname = $stmt->fetch();
?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $departmentname['name'].'`s Members' ?>
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
              <a href="departments.php" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-arrow-left"></i> Departments</a>
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
                                  profile p ON members.id=p.member_id
                              WHERE 
                                  department_id = :id';                        
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['id'=>$id]);

                        foreach($stmt as $user){
                          $image = (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg';                        
                          $status = (!$user['status']) ? '<a <a href="#block"  data-toggle="modal" class="btn btn-danger btn-xs">Block</a>' : '<a<a href="#unblock"  data-toggle="modal" class="btn btn-warning btn-xs">Unblock</a>';
                          echo "
                              <tr>
                                <td>
                                  <img src='".$image."' height='30px' width='30px'>
                                  <span class='pull-right'><a href='#edit_photo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                                </td>
                                <td>".$user['email']."</td>
                                <td>".$user['username'].' '.$user['username']."</td>
                                <td>
                                  <a class='data-id'".$row['id']."'> ".$status."</a>
                                </td>
                                <td>".date('M d, Y', strtotime($user['username']))."</td>
                                <td>
                                   <button class='btn btn-success btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                                  <a role='button' href='user_profile.php?member=".$user['id']."' class='btn btn-primary btn-sm btn-flat' data-id='".$row['id']."'><i class='fa fa-eye'></i> View Profile</a>
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

