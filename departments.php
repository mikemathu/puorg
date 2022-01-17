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
                          $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/profile.jpg';
                          $membership = ($row['id']) ? '<a href="#join" data-toggle="modal" class="btn btn-info btn-sm jooin btn-flat" data-id='.$row['id'].' onclick="goDoSomething(this);"><i class="fa fa-send"></i> Join</a> ' : '<a href="#leave" class="btn btn-warning btn-sm join btn-flat"  data-toggle="modal" data-id='.$row['id'].' onclick="goDoSomething(this);"><i class="fa fa-send"></i>Leave</a>';
                          echo "
                            <tr>
                              <td>".$row['name']."</td>
                              <td>
                                <img src='".$image."' height='30px' width='30px'>
                              </td>
                              <td>

                              <script>

                              function goDoSomething(d){
                                  var ids=d.getAttribute('data-id');
                                  document.cookie = 'ids='+ids;
                                  //  alert(d.getAttribute('data-id'));
                              }
                          
                          </script>

                                <a data-id='".$row['id']."'> ".$membership."</a>                              
                                <a href='department_members.php?department=".$row['id']."' role='button' class='btn btn-primary btn-sm  btn-flat' data-id='".$row['id']."' onclick='goDoSomething(this);'><i class='fa fa-search'></i> View Members</button>
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