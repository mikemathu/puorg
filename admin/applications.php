<?php include('includes/header.php');?>



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
            <!-- <div class="box-header with-border">
              <a href="#add_member" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Member</a>
            </div> -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  
                  
                  <th>Username</th>
                  <th>Email</th>
                  
                  <th>Date Joined</th>
                  <th>Department</th>
                  <th>status</th>
                  <th>Actions</th>
                 
                </thead>
                <tbody>
                  <?php
                    try{                  
                        $sql = 'SELECT                                      
                                      *, m.username AS username,
                                      m.email AS email,
                                      m.id AS id
                                  FROM                                   
                                  dptmntsapplications
                                  LEFT JOIN                                  
                                  members m ON member_id=m.id';                               
                          $stmt = $pdo->prepare($sql);
                          $stmt->execute();
                        $stmt = $pdo->prepare($sql);
                          $stmt->execute();
          if($stmt->rowCount() > 0){
            foreach($stmt as $result){            
                ?>  
                                        <tr>            
                                            <td><?php echo $result['username'] ;?></td>
                                            <td><?php echo $result['email'];?></td>
                                            <td><?php echo $result['PostingDate'];?></td>
                                            <td><?php echo $stats=$result['department'];?>
                                            <td><?php $stats=$result['Status'];
if($stats==1){
                                             ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2)  { ?>
                                                <span style="color: red">Not Approved</span>
                                                 <?php } if($stats==0)  { ?>
 <span style="color: blue">waiting for approval</span>
 <?php } ?>


                                             </td>
                                             <script>

function goDoSomething(d){
    var ids=d.getAttribute('data-id');
    document.cookie = 'ids='+ids;
    //  alert(d.getAttribute('data-id'));
}

</script>

<?php 
echo"          
<td>
<a  href='user_profile.php?member=".$result['id']."' role='button' class='btn btn-primary btn-sm application btn-flat' data-id=".$result['id']." onclick='goDoSomething(this);'><i class='fa fa-eye'></i> View Profile</a>                                
<button class='btn btn-info btn-sm delete btn-flat' data-id=".$result['Id']." onclick='goDoSomething(this);' data-toggle='modal' '><i class='fa fa-save'></i>Take Action</button>                                             
</td>                              

                                    </tr>
                                   " ?>                                  
                                     <?php
              }          
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


 
    


<?php include('includes/applications_modal.php'); ?>

<?php //include('./applications.php');?>

  <?php include('includes/footer.php');?>


  



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