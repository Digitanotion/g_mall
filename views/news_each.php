<?php 
require_once("../services/ems/report_emergency.php");
require_once("../services/aud_s/audit.php");
$secure_ob= new SecurityService_SEC_S();
$dbHandler=new InitDB(DB_OPTIONS[2], DB_OPTIONS[0],DB_OPTIONS[1],DB_OPTIONS[3]);
$report_emergency_ob=new Report_Emergency();
$user_key="Anonymous";
$audit_ob=new AuditService();
if (!isset($_GET['post_link'])||$_GET['post_enabled']!='true'){
    header("location: index.php?error=true&&error_msg=Something is not normal");
}
$postHash=$secure_ob->sanitizeInputs($_GET['post_link']);
if (isset($_POST['btn_publish_comment'])){
    $post_hash=$secure_ob->sanitizeInputs($_POST['post_hash_comment']);
    $post_comment=$secure_ob->sanitizeInputs($_POST['comment_msg']);
    $comment_stmt=$report_emergency_ob->add_user_comment($user_key,$postHash,$post_comment);
    if ($comment_stmt){
        $sys_msg="Comment Added";
    }
    else{
        $sys_msg="Error adding comment";
    }
}
$posts_get=$report_emergency_ob->getIncidentPosts($postHash);
$comments_get=$report_emergency_ob->getPostComments($postHash);
$getPostsAll = $posts_get->fetch();
$getCommentsAll = $comments_get->fetchAll(PDO::FETCH_ASSOC);
$post_city=explode(",",$getPostsAll['post_location']);
$post_city=explode(" ", $post_city[1]);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="handlers/assets/fonts/montserrat-cufonfonts-webfont/style.css"/>
    <link rel="stylesheet" href="handlers/assets/fonts/inter-cufonfonts-webfont/style.css"/>
    <link rel="stylesheet" href="handlers/css/bootstrap.min.css">
    <link rel="stylesheet" href="handlers/css/bootstrap.min.css" />
    <link rel="stylesheet" href="handlers/css/index.css" /> 
    <link rel="stylesheet" href="handlers/css/jmobile_class.css">
    <link rel="stylesheet" href="handlers/css/style_eb.css">
    <link rel="stylesheet" href="handlers/css/query_eb.css">

    <title>record details</title>
</head>
<body>
    <!-- <div class="section " style="border: 1px solid white;"> -->
        
        <div class="container-record">
            <div class="row">
                <div class="col-sm mt-4 top-record-container">
                    <!-- <img src="handlers/assets/images/Vector.png" class="py-4 ellipse" alt="previous-icon"> -->
                            <div class="mt-3">
                               <img src="handlers/assets/images/Ellipse 2.png" class="img-fluid top-record-left " alt="profile-picture">
                            </div>
                            <div class="top-record-right">
                                <span class="text-white fontBold"><?php echo $getPostsAll['user_key'];?></span>
                                <p class="">
                                   <img src="mysvg/map-light.svg" alt=""><span class="text-white px-2 fs-smally fontRegular"><?php echo $post_city[1]." ".$post_city[2];?></span> | <span class="text-white fs-smally fontRegular" style="margin-left:10px;">
                                   <?php echo $audit_ob->time_ago($getPostsAll['post_time']);?></span>
                                </p>
                                
                            </div> 
                            
                            
                            
                </div>
                
                <!-- <div class="col-sm top-record-container">
                    <div class="top-share-right">
                        <img src="mysvg/share.svg" alt="" style="margin-left: 60px;">
                        <p class="">
                            <span class="text-white fs-smally fontRegular" style="margin-left:15px;">
                            20mins ago</span>
                        </p>
                        
                    </div>
                    
                </div> -->
            
            </div><br><br><br>
            <!-- <div class="uploads text-center mt-6"  style="border: 1px solid white; border-radius: 5px;">
                <img src="images/slide 1.png" style="width:100%" alt="">
       
            </div> -->
            <div class="caro">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators mt-2">
                    <?php 
                        $countImage=1;
                        $countIndicators=0;
                            $images_ext_accepted=['.jpg','.jpeg','.png','gif'];
                            $videos_ext_accepted=['.mp4','.webm','.3pg'];
                            $files_db=explode("|",$getPostsAll['post_media']);
                            ?>
                            <?php 
                            foreach ($files_db as $dbFiles){
                        ?>
                        <button type="button" data-bs-target="#carouselsExampleIndicators" data-bs-slide-to="<?php echo $countIndicators; ?>" class="<?php if($countIndicators==0){echo 'active';}?>" aria-current="true" aria-label="up5kyoqlhyfii651kkqb"></button>
                                <?php $countIndicators++;
                            } ?>
                    </div>
    
                    <div class="carousel-inner mb-4">
                        <?php 
                            foreach ($files_db as $dbFiles){
                        ?>
                        
                        <div class="carousel-item <?php if($countImage==1){echo 'active';}?>">
                            <img src="https://res.cloudinary.com/digitanotion/image/upload/c_scale,dpr_auto,q_60,w_0.3/<?php echo  $files_db[$countImage];?>" class="d-block w-100" alt="">
                        </div>
                       

                 
                        <?php $countImage++;
                        }?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
    
                </div>
                
            </div>
           
            <br>

            <div class="De-incident mb-2" >
                <div class="tex" >
                    <h4 class="text-white" style="font-size: 16px; display: inline;font-weight: 500;"><?php echo $getPostsAll['post_message'];?></h4>
                </div>
               
                <!-- <span class="text-white fs-smally">20k views</span> -->

            </div>
            <span class="text-white " style="">Comments</span>
                <?php
                    if ($comments_get->rowCount()>0){
                        foreach ($getCommentsAll as $row){
                            
                ?>
                    <div class="comment mt-2">
                        <img src="handlers/assets/images/Ellipse 3.png" alt="">
                    
                        <span class="text-white text-light px-1 fs-small"><?php echo $row['user_comment']; ?></span>
                    </div>
                <?php }}
                else{?>
                    <div class="comment mt-2">
                    <span class="text-white fs-small" style="">No comment yet</span>
                    </div>
                <?php }?>
            <br>
            <div class="">
                <form action="" method="post" class="input-group form-outline px-2 pb-4 mb-5">
                    <input type="hidden" name="post_hash_comment" id="post_hash_comment" value="<?php echo $postHash; ?>">
                    <textarea class="form-control bg-dark text-light" id="comment_msg" name="comment_msg" placeholder="Add a comment" style="border: 1px solid #006CB4;"></textarea>
                    <button class="btn btn-outline-secondary" type="submit" id="btn_publish_comment" name="btn_publish_comment">Publish</button>
                </form>
                
        
            </div>
           
               
            
           
        </div>
    <!-- </div> -->
    <footer class="footer  px-2">
        <div class="py-2">
           
            <img src="mysvg/home-icon.svg" alt="homeicon" class="home-icon px-2">
            <span class="text-white foot-text px-1">Home</span>
        </div>
        <div class="py-2">
            <button type="button" class="btn btn-danger rounded-pill ">
                <img src="mysvg/speaker-icon.png" alt="speaker-icon" class="speak-icon ">
                Report Emergency</button>
        </div>
       
        <div class="py-2">
            
            <img src="mysvg/profile-icon.svg" alt="profile-icon" class="prof-icon px-2">
            <span class="text-white foot-text">Account</span>
        </div>
        
    </footer>
    <!-- Toasts -->
    <?php if (isset($sys_msg)&&!empty($sys_msg)){?>
            <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 100px;min-width: 250px;">
                <div class="toast rounded bg-transparent d-flex justify-content-center align-items-center" style="position: absolute; bottom: 200px; right: 0; display: inline-block;" role="alert" id="allToasts" aria-live="assertive" aria-atomic="true">
                <div class="toast-body bg-dark text-white text-center rounded bottom-0" >
                    <span id="toast_body"><?php echo $sys_msg;?></span>
                </div>
                </div>
            </div>
    <?php }?>
</body>
<!-- <script src="bootstrap5/js/jquery.min.js"></script> -->
<script src="handlers/css/bootstrap.min.js"></script> 
<script>
    var myAlert =document.getElementById('allToasts');
    var bsAlert = new bootstrap.Toast(myAlert);//inizialize it toast_body
    bsAlert.show(); 
</script> 

</html>