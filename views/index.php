<?php 
require_once("../services/ems/report_emergency.php");
require_once("../services/aud_s/audit.php");
$report_emergency_ob=new Report_Emergency();
$dbHandler=new InitDB(DB_OPTIONS[2], DB_OPTIONS[0],DB_OPTIONS[1],DB_OPTIONS[3]);
$audit_ob=new AuditService(DB_OPTIONS[2], DB_OPTIONS[0],DB_OPTIONS[1],DB_OPTIONS[3]);
$user_key="Anonymous";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to Watch App</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="handlers/assets/fonts/montserrat-cufonfonts-webfont/style.css"/>
    <link rel="stylesheet" href="handlers/assets/fonts/inter-cufonfonts-webfont/style.css"/>
    <link rel="stylesheet" href="handlers/css/bootstrap.min.css">
    <link rel="stylesheet" href="handlers/css/bootstrap.min.css" />
    <link rel="stylesheet" href="handlers/css/index.css" />
    
    
    <script type="text/javascript">

      $(document).ready(function() {
              var stickyHeaderTop = $('#greetingsMap').offset().top;
       
              $(window).scroll(function(){
                      if( $(window).scrollTop() > stickyHeaderTop ) {
                              $('#greetingsMap').css({position: 'fixed', background:'#111', top: '0px', padding:'20px', left:''});
                              //$('#sticky').css('display', 'block');
                      } else {
                              $('#greetingsMap').css({position: 'static',padding:'0px', top: '0px'});
                              //$('#sticky').css('display', 'none');
                      }
              });
        });
    </script>
  </head>
  <body>
    <!--Main body-->
    <div data-role="page" style="margin: 0px; text-shadow: none; background-color: black;">
      <main id="mobile-body" role="main" class="ui-conten" style="margin: 0%; left: 0px; top:0px; font-family: 'Inter', sans-serif; background-color: black;">
        <!--Notifications-->
        <a href="notifications.html" data-transition="slide">
          <div class="notification-container d-flex justify-content-center">
            <div class="align-self-center">
              <img src="handlers/assets/images/bell-icon.svg" alt="bell-icon" />
              <div class="notification-dot"></div>
            </div>
          </div>
        </a>
        <!--Map container-->
        <div id="map" class="map-container w-100"></div>

        <!--Greetings and current location-->
        <div class="d-flex justify-content-center pt-3 w-100" id="greetingsMap">
          <div class="greeting me-4">
            <p>Goodmorning <span>Anonymous,</span></p>
          </div>
          <div class="user-location mt-1">
            <img
              src="handlers/assets/images/location-marker.png"
              alt="location-marker-icon"
            />
            <span id="locationName">Loading...</span>
            <input type="hidden" id="currCoords">    
          </div>
        </div>

        

        <!--News section-->
        <section class="news-section">
        <?php 
                $posts_stmt=$dbHandler->run("SELECT * FROM posts_table ORDER BY user_id DESC");
                    $coords="";
                    $posts_result = $posts_stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($posts_result as $row){
                        $post_type="";
                        $userName=$user_key;
                        $post_title=$row['post_title'];
                        $post_city=explode(",",$row['post_location']);
                        $post_city=explode(" ", $post_city[1]);
                        ?>
          <div class="news-item d-flex justify-content-center pt-3">
            <div class="news-profile-image">
              <img class="me-3" src="handlers/assets/images/profile-pic-1.png" alt="" />
            </div>
            <div class="news-content pb-3">
              <a href="news_each.php?post_link=<?php echo $row['post_hash'];?>&post_enabled=true&media_support=true">
                <div class="news-text">
                  <p>
                    
                      <?php echo $row['post_message'];?>
                  </p>
                </div>
              </a>
              <div class="news-metadata">
                <div class="news-location">
                  <img
                    class="me-1"
                    src="handlers/assets/images/map-marker.png"
                    alt="map-marker-icon"
                  />
                  <span><?php echo $post_city[1]." ".$post_city[2];?></span>
                </div>
                <div class="news-comment">
                  <img
                    class="me-1"
                    src="handlers/assets/images/comment-bubble.png"
                    alt="map-marker-icon"
                  />
                  <span>0 comments</span>
                </div>
                <div class="news-posted-at">
                  <span><?php echo $audit_ob->time_ago($row['post_time']);?> </span>
                </div>
              </div>
            </div>
          </div>
                    <?php } ?>

        </section>

        <div class="fixed-navigation-tab">
          <a href="#" class="fixed-navigation-link">
            <div class="text-center mt-2">
              <svg
                class="home-icon"
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M5.86791 14.5786V12.2785C5.8679 11.6935 6.34484 11.2181 6.93576 11.2142H9.10032C9.69406 11.2142 10.1754 11.6907 10.1754 12.2785V14.5857C10.1752 15.0824 10.5757 15.4884 11.0773 15.5H12.5203C13.9588 15.5 15.125 14.3455 15.125 12.9214V6.37838C15.1173 5.81812 14.8516 5.29201 14.4035 4.94977L9.46829 1.01398C8.6037 0.328675 7.37465 0.328675 6.51006 1.01398L1.59652 4.95692C1.14669 5.29777 0.88054 5.82475 0.875 6.38552V12.9214C0.875 14.3455 2.04116 15.5 3.47968 15.5H4.92272C5.43677 15.5 5.85348 15.0875 5.85348 14.5786"
                  fill="#FFFFFF"
                />
              </svg>
              <p>Home</p>
            </div>
          </a>
          <div class="text-center report-emergency-button-container mt-2">
            <a class="report-emergency-button d-flex btn btn-danger rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#reportType"
            >
              <img
                src="handlers/assets/images/speaker-icon.png"
                class="mt-1 me-2"
                alt="speaker-icon"
              /><span class="report-emergency-button-text">Report Emergency</span>
          </a>
          </div>
          <a href="#" class="fixed-navigation-link">
            <div class="text-center mt-2">
              <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="6.91396" cy="4.72841" r="3.72841" fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.00001 13.6423C0.999011 13.3802 1.05763 13.1213 1.17143 12.8852C1.52856 12.1709 2.53566 11.7924 3.37134 11.6209C3.97403 11.4923 4.58505 11.4064 5.19984 11.3638C6.33807 11.2638 7.48288 11.2638 8.62112 11.3638C9.23586 11.4069 9.84684 11.4928 10.4496 11.6209C11.2853 11.7924 12.2924 12.1352 12.6495 12.8852C12.8784 13.3665 12.8784 13.9252 12.6495 14.4065C12.2924 15.1565 11.2853 15.4993 10.4496 15.6636C9.84763 15.7976 9.23639 15.8859 8.62112 15.9279C7.69469 16.0064 6.76393 16.0208 5.83552 15.9708C5.62125 15.9708 5.41411 15.9708 5.19984 15.9279C4.58686 15.8864 3.97797 15.7981 3.37848 15.6636C2.53566 15.4993 1.5357 15.1565 1.17143 14.4065C1.05821 14.1677 0.99965 13.9066 1.00001 13.6423Z" fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              <p>Account</p>
            </div>
          </a>
        </div>
      </main>
    </div>
      <!-- Select Report type modal -->
      <div class="modal" id="reportType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reportTypeLabel" aria-hidden="true">
            <div class="modal-dialog   modal-md modal-dialog-centered">
            <div class="modal-content text-light border">
                <div class="modal-header">
                <h5 class="modal-title fontBold" id="reportTypeLabel">Choose report type</h5>
                <button type="button" class="btn-close btn-close-white p-2" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body text-light fontRegular fs-1">
                Hello, we understand how you feel now, kindly tap the red button "send SOS", to send an emergency message to your SOS contacts, 
                or tap the blue button "Eye Witness" to report a situation happening around you.
                </div>
                <div class="modal-footer">
                <button type="button" onclick="showToast('Feature not available')" class="btn btn-danger fs-1 send_sos_btn"><i class="fa fa-envelope"></i> Send SOS</button>
                <a href="record_incident.html" class="btn btn-outline-primary"><small><i class="fa fa-eye"></i> Eye Witness</small></a>
                </div>
            </div>
            </div>
        </div>
        <div class="modal" id="loading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loadingLabel" aria-hidden="true">
            <div class="modal-dialog   modal-sm modal-dialog-centered justify-content-center">
            <div class="modal-content bg-transparent justify-content-center">
                <div class="modal-body bg-transparent text-light text-center justify-content-center fontRegular fs-1">
                    <div class="bg-dark rounded-pill mx-auto p-1" style="width:fit-content;"><img src="handlers/assets/images/loading_watchappbig4.gif" alt="Loading..." class="img-fluid"></div>
                </div>
            </div>
            </div>
        </div>
             <!-- Toasts -->
             <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 100px;min-width: 250px;">
                <div class="toast rounded bg-transparent d-flex justify-content-center align-items-center" style="position: absolute; bottom: 200px; right: 0; display: inline-block;" role="alert" id="allToasts" aria-live="assertive" aria-atomic="true">
                <div class="toast-body bg-dark text-white text-center rounded bottom-0" >
                    <span id="toast_body"></span>
                </div>
                </div>
            </div>
        <!-- Toasts -->
    <script src="handlers/js/popper.min.js"></script>
    <script src="handlers/js/bootstrap.min.js"></script>
    <script src="handlers/j/main.js"></script>
    <script type="text/javascript">
    //var user_key = $("#user_key").val();
    
      function initMap() {
        // User location options
        let options = {
          center: { lat: 6.2209, lng: 6.937 },
          zoom: 15,
          mapTypeId: 'roadmap',
          disableDefaultUI: true,
          clickableIcons: false,
          styles: [
            { elementType: 'geometry', stylers: [{ color: '#242f3e' }] },
            {
              elementType: 'labels.text.stroke',
              stylers: [{ color: '#242f3e' }],
            },
            {
              elementType: 'labels.text.fill',
              stylers: [{ color: '#746855' }],
            },
            {
              featureType: 'administrative.locality',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#d59563' }],
            },
            
            {
              featureType: 'poi',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#d59563' }],
            },
            {
              featureType: 'poi.park',
              elementType: 'geometry',
              stylers: [{ color: '#263c3f' }],
            },
            {
              featureType: 'poi.park',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#6b9a76' }],
            },
            {
              featureType: 'road',
              elementType: 'geometry',
              stylers: [{ color: '#38414e' }],
            },
            {
              featureType: 'road',
              elementType: 'geometry.stroke',
              stylers: [{ color: '#212a37' }],
            },
            {
              featureType: 'road',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#9ca5b3' }],
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry',
              stylers: [{ color: '#746855' }],
            },
            {
              featureType: 'road.highway',
              elementType: 'geometry.stroke',
              stylers: [{ color: '#1f2835' }],
            },
            {
              featureType: 'road.highway',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#f3d19c' }],
            },
            {
              featureType: 'transit',
              elementType: 'geometry',
              stylers: [{ color: '#2f3948' }],
            },
            {
              featureType: 'transit.station',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#d59563' }],
            },
            {
              featureType: 'water',
              elementType: 'geometry',
              stylers: [{ color: '#17263c' }],
            },
            {
              featureType: 'water',
              elementType: 'labels.text.fill',
              stylers: [{ color: '#515c6d' }],
            },
            {
              featureType: 'water',
              elementType: 'labels.text.stroke',
              stylers: [{ color: '#17263c' }],
            },
          ],
        }

        let map = new google.maps.Map(document.getElementById('map'), options)
        function addMarker(props) {
          let marker = new google.maps.Marker({
            position: props.coords,
            map: map,
          })
          if (props.iconImage) {
            marker.setIcon(props.iconImage)
          }
          if (props.content) {
            var infoWindow = new google.maps.InfoWindow({
              content: props.content,
            })
            marker.addListener('click', function () {
              infoWindow.open(map, marker)
            })
          }
        }
        
        
        
        let marks=[
            
                <?php 
                $stmt=$dbHandler->run("SELECT * FROM posts_table ORDER BY user_id DESC");
                    $coords="";
                    $arr_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($arr_result as $row){
                        $post_type="";
                        $userName=$user_key;
                        $post_title=$row['post_title'];
                        $post_location=explode(",",$row['post_coords']);
                        
                        $lo_lat=$post_location[0];
                        $lo_lng=$post_location[1];
                        if($lo_lat==""){
                            $lo_lat=6.2209;
                        }
                        if ($lo_lng==""){
                            $lo_lng=6.937;
                        }
                        //echo $lo_lat;
                        $post_icon="handlers/assets/images/map-marker-icon-blue.svg";
                        $user_image="handlers/assets/images/profile-pic-1.png";
                        if ($post_type=="sos"){
                            $post_icon="handlers/assets/images/marker_red.gif";
                        } ?>
        { 
            coords: { lat: <?php echo $lo_lat ?>, lng: <?php echo $lo_lng ?> },
            iconImage: 'handlers/assets/images/map-marker-icon-blue.svg',
            content: `
            <div style="display: grid; grid-template-columns: 1fr 2fr;">
                <div style="align-self: center;">
                <img src="handlers/assets/images/profile-pic-1.png" />
                </div>
                <div>
                <p style="margin-bottom: 2px; font-weight: bold">Emeka Offor</p>
                <p style="margin-bottom: 0; color: #16D76F;"><?php echo $post_title ?></p>
                </div>
            </div>
            `,
        },
            <?php }?>
    
        ]
        
        //alert(jsonmarkers.markers)

        for (let i = 0; i < marks.length; i++) {
            //alert(marks.length)
          addMarker(marks[i])
        }
      }
      //coordds=$('#currCoords').val();
    //alert(coordds)
    </script>
    <script src="handlers/js/all.js"></script>
    <script>
        window.onload = getLocation;
    </script>
async defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7su9_A0NPfpZ0YN37NxiM97Y2TJM1hBA&callback=initMap"
async defer></script>
  </body>
</html>
