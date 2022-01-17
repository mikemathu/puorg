<?php

// code for action taken on leave
if(isset($_POST['save']))
{ 
  $id=$_COOKIE['ids'];
                          // echo $if;
$sql ='SELECT * FROM dptmntsapplications WHERE Id=?';
                          $stmt = $pdo->prepare($sql);
                          $stmt->execute([$id]);
                          

                          foreach($stmt as $result){

                            $isread=1;
                            $did= $result['Id']; 
                            // $leaveid= $result['Id'];
                            
                            // echo $leaveid;
                            date_default_timezone_set('Asia/Kolkata');
                            $admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
                            $sql="update dptmntsapplications set IsRead=:isread where id=:did";
                            $query = $pdo->prepare($sql);
                            $query->bindParam(':isread',$isread,PDO::PARAM_STR);
                            $query->bindParam(':did',$did,PDO::PARAM_STR);
                            $query->execute();
                            
                            
                            $did= $result['Id'];
                            // echo $did;
                            $description=$_POST['description'];
                            $status=$_POST['status'];   
                            date_default_timezone_set('Asia/Kolkata');
                            $admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
                            $sql="update dptmntsapplications set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where Id=:did";
                            
                            $query = $pdo->prepare($sql);
                            $query->bindParam(':description',$description,PDO::PARAM_STR);
                            $query->bindParam(':status',$status,PDO::PARAM_STR);
                            $query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
                            $query->bindParam(':did',$did,PDO::PARAM_STR);
                            $query->execute();
                            $msg="Leave updated Successfully";


                            


                            // uodate department_id on member table

                            $sql ='SELECT * FROM dptmntsapplications WHERE Id=?';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$id]);


                        
                        foreach($stmt as $row){
                          

                      $department = $row['department'];
                        $member_id=  $row['member_id'];

                        $stmt = $pdo->prepare("UPDATE members SET department_id=? WHERE id=?");
                        $stmt->execute([$department,$member_id]);

                      }                          
                         

                            
                            }

                       
                          
                          }


// // code for update the read notification status
// $isread=1;
// // $did=intval($_GET['leaveid']);  
// date_default_timezone_set('Asia/Kolkata');
// $admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
// $sql="update dptmntsapplications set IsRead=:isread where id=:did";
// $query = $pdo->prepare($sql);
// $query->bindParam(':isread',$isread,PDO::PARAM_STR);
// $query->bindParam(':did',$did,PDO::PARAM_STR);
// $query->execute();

// // code for action taken on leave
// if(isset($_POST['save']))
// { 
// // $did=intval($_GET['leaveid']);
// // $description=$_POST['description'];
// // $status=$_POST['status'];   
// date_default_timezone_set('Asia/Kolkata');
// $admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
// $sql="update dptmntsapplications set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:did";
// $query = $pdo->prepare($sql);
// $query->bindParam(':description',$description,PDO::PARAM_STR);
// $query->bindParam(':status',$status,PDO::PARAM_STR);
// $query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
// $query->bindParam(':did',$did,PDO::PARAM_STR);
// $query->execute();
// $msg="Leave updated Successfully";
// }
?>










<!-- DELETE MODAL -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Department Application Action</h4>
            </div>
            <div class="modal-body">
             

                <form method="POST" action="">

                    <div class="form-group">
                    
                    
                    <div class="modal-content" style="width:90%">
                 <p>   <select class="form-control" name="status" required="">
                                            <option  value=""><i>Chose your option</option>
                                            <option value="1">Approved</option>
                                            <option value="2">Not Approved</option>
                                        </select> </p>
                                        <p><textarea name="description" placeholder="Your Remark..." length="2" minlength="10" style="resize:none; width:100%;"  required ></textarea></p>
                                        
                                        </div>
                                        
                                            </div>
                  
                    </div>
  <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                            class="fa fa-close"></i> Close
                </button>
                <button type="submit" name="save" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save
                </button>
            </div>
            </div>
          
            </form>

    
            </div>

        </div>
        <!-- /.modal-content -->