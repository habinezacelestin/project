<?php
require_once("initialize.php");
require_login();
$id= $_GET["idt"] ?? $_SESSION['user_id'];
$group=find_group_by_id($id);

$users=find_group_users($id);
// In case There is no matching id , then simply , display logged in user
if(empty($group)){
    $group=find_group_by_id($_SESSION['user_id']);
}
        $result='';
    // Display All Contacts  
        
        $result.="<div class='contactdtls animate__animated animate__fadeInRight'>
                        <img src='assets/images/avatar/".$group["avatar"]."' class='profilep'>
                        <div class='calicn text-light text-center row justify-content-around'>
                        <div class='col'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='16' fill='currentColor'
                                class='bi bi-telephone-fill' viewBox='0 0 16 16'>
                                <path fill-rule='evenodd'
                                    d='M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z' />
                            </svg>
                        </div>
                        <div class='col'>
                                            <i class='zmdi zmdi-email'></i>

                        </div>
                    </div>
                    <hr>
                    <ul class=''>
                        
                        <li><span>(".$group['members'].") Members</span>
                        <div class='owl-carousel secondone owl-theme'>
                        ";

                            while($data=mysqli_fetch_assoc($users)){
                                
                               $result.="<div class='item cursor-pointer' onclick=\"user_description('".$data['id']."');keepfindingtext('".$data['id']."')\">
                                        <img src='assets/images/avatar/".$data['avatar']."'>
                                        <h4 class='text-center' style='text-align:center;font-size: 10px;'>".$data['username']."</h4>
                                    </div>";
                            }
                            mysqli_free_result($users);

                        $result.="</div>
                            
                        </li>
                        <li><span>Admin</span>
                            <p>@".$group["username"]."</p>
                        </li>
                        <li><span>Group Name</span>
                            <p class='text-truncate'>".$group["group_name"]."</p>
                        </li>
                        <hr>
                        <li>
                           

                        </li>
                        <li>


                        ";
                        
                           if($group["username"]==$_SESSION['username']){
                            $result.="<p style='color: red; text-shadow: 1px 1px 1px rgb(29, 29, 29);' onclick=\"delete_group('".$group['groupid']."');\"> <svg
                            xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor'
                            class='bi bi-x-circle-fill' viewBox='0 0 16 16'>
                            <path
                                d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z' />
                        </svg> DeLete Group </p>";
                           }else{
                            $result.="<p class='text-danger  font-weight-bold' onclick=\"leave_group('".$group['groupid']."');\"> 
                            <i class='mr-4 zmdi zmdi-close-circle zmdi-hc-2x'></i> Leave Group </p>";
                           }
                        $result.="</li>
                    </ul>
                    <div>
                    </div>
                </div>
               ";
 
            echo $result;
?>