<?php include('includes/header.php');?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Access Logs
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Access Logs</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">           
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Photo</th>
                  <th>Email</th>
                  <th>Name</th>
                  <th>Date Added</th>
                  <th>Login Time</th>
                </thead>
                <tbody>
                  <?php
                    try{
                          $sql ='SELECT * FROM members';
                          $stmt = $pdo->prepare($sql);
                          $stmt->execute();

                          foreach($stmt as $row){
                            $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
                            $status = ($row['status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">not verified</span>';
                            $active = (!$row['status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$row['id'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                            echo "
                              <tr>
                                <td>
                                  <img src='".$image."' height='30px' width='30px'>                          
                                </td>
                                <td>".$row['email']."</td>
                                <td>".$row['username'].' '.$row['username']."</td>
                                <td>".date('M d, Y', strtotime($row['username']))."</td>
                                <td>".date('M d, Y', strtotime($row['username']))."</td>
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

<?php include('includes/footer.php');?>
