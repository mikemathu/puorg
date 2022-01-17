<?php 
    include('includes/header.php');  
 
    $_SESSION['id'] = $_GET['member'];
    $id = $_SESSION['id'];
    // $id = 26;
    // $id=$_COOKIE['ids'];
    // echo $id;
    
    try{  
        $sql ="SELECT
                  *, m.username AS username 
              FROM
                profile
              LEFT JOIN 
                members m ON profile.member_id=m.id 
               WHERE
              member_id=:id";                
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id'=>$id]);

        foreach($stmt as $row){
          $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';
          $username = $row['username'] ;
          $course = $row['course'] ;
          $year = $row['year_of_study'] ;
          $skills = $row['skills'] ;
          $notes = $row['notes'] ;
          }
        }
        catch(PDOException $e){
          echo "There is some problem in connection: " . $e->getMessage();
        }           
?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php echo $row['username'].'`s Profile' ?>      
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>User Profile</li>
      </ol>
    </section>
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

            <?php
              echo "                        
                  <img class='profile-user-img img-responsive img-circle' src='".$image."' alt='User profile picture'>
                  ";
            ?> 
                <h3 class="profile-username text-center">
                    <?php echo $username; ?>            
                </h3>
                <p class="text-muted text-center">
                
            <?php
                try{
                    $sql = "SELECT
                              d.name AS name
                            FROM
                                members 
                            LEFT JOIN
                                departments d ON members.department_id=d.id
                            WHERE
                            department_id=:id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['id'=>$id]);
                    $row = $stmt->fetch();
                    $departmentt= $row['name'];



                    if(($departmentt) ==0 ){

echo 'dfbg';
                    } else {
                      echo $departmentt;
                    }
                    
                   
                  }
                  
                  catch(PDOException $e){
                    echo "There is some problem in connection: " . $e->getMessage();
                  }
        	    ?>
              
                </p>
                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Course</strong>
              <p class="text-muted">
                <?php echo $course; ?>
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Year of study</strong>
              <p class="text-muted">
                 <?php echo $year; ?>
              </p>
              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
              <p>               
                <span class="label label-warning">
                <?php echo $skills; ?>
                </span>              
              </p>
              <hr>
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
              <p> 
                <?php echo $notes; ?>
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
      </div>

        <div class="col-md-9">
          <div class="nav-tabs-custom">
          <div class="box-header with-border">
              <a href="members.php" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-arrow-left"></i> Members</a>
            </div>
            <ul class="nav nav-tabs">            
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#mail" data-toggle="tab">Mail</a></li>              
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">         
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
              <!-- /.tab-pane -->
                 
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
  </div> 
  </div>
  
<?php include('includes/footer.php');?>
