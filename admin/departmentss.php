<?php include('includes/header.php');?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Departments
      </h1>
      <ol class="breadcrumb">
      <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="departments">Departments</a></li>
        <li class="active">Departments</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add Department</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th>Department Name</th>
                  <th>Department Logo</th>
                  <th>Actions</th>
                </thead>
                <tbody>
                  <?php
                    try{
                          $sql ='SELECT * FROM departments';
                          $stmt = $pdo->prepare($sql);
                          $stmt->execute();

                          foreach($stmt as $row){
                            $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                            echo "
                              <tr>
                                <td>".$row['name']."</td>
                                <td>
                                  <img src='".$image."' height='30px' width='30px'>
                                  <span class='pull-right'><a href='#edit_logo' class='photo' data-toggle='modal' data-id='".$row['id']."'><i class='fa fa-edit'></i></a></span>
                                </td>
                                <td> 
                                  <button  name='id' class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>   

                                                              
                                  <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                                  <a href='department_members.php?row=".$row['id']."' role='button' class='btn btn-primary btn-sm  btn-flat' data-id='".$row['id']."'><i class='fa fa-search'></i> View Members</button>
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

    <?php include('includes/departments_modal.php'); ?>

    <?php include('includes/footer.php');?>


<!-- EDIT MODAL -->
    <div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edittttttttttttttttttttt Department</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">

                    <div class="form-group">
                        <label for="Title">Department Name</label>
                        <input type="text" id="Title" name="dptmtNameU" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Choose Logo</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                    class="fa fa-close"></i> Close
                        </button>
                        
                        <input type="hidden" name="update_id"  value="<?php echo $row['id']; ?>">
            <input type="submit" name="edit" value="Submit" class="btn btn-primary btn-flat">

            <!-- <button type='submit'  class='btn btn-primary btn-flat' value='<?php echo $row['id']; ?>'  name='update_id'  data-id='".$row['id']."'><i class='fa fa-save'></i> Savee</button> -->
                        <!-- <button type="submit" class="btn btn-primary btn-flat" name="edit"><i class="fa fa-save"></i> Save -->
                        <!-- </button> -->
                        
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php
if (isset($_POST['edit'])) {
        $dptmtNameU=$_POST['dptmtNameU'];
        $update_id =$_POST['update_id'];
      //  $id = $_POST['id'];

        
        $stmt = $pdo->prepare("UPDATE departments SET name=:dptmtNameU WHERE id=:update_id");
    $stmt= $pdo->prepare($sql);
    $stmt->execute(['name' => $dptmtNameU,'id' => $update_id]);
}
?>

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