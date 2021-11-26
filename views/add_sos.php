<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="handlers/assets/fonts/montserrat-cufonfonts-webfont/style.css"/>
  <link rel="stylesheet" href="handlers/assets/fonts/inter-cufonfonts-webfont/style.css"/>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="handlers/css/bootstrap.min.css">
    <link rel="stylesheet" href="handlers/css/style_eb.css">
    <link rel="stylesheet" href="handlers/css/query_eb.css">
    <link rel="stylesheet" href="handlers/css/jmobile_class.css">

    <title>Add SOS</title>
</head>
<body>
        <!--Header-->
        <input type="hidden" id="user_key">
    <form action="" id="frmReportEmergency" method="post" class="container needs-validation frmReportEmergency" novalidate style="position: relative;" >
        <div class="fixed-header-notification_incident">
            <a href="index.php" class="mt-3 ">
            <img src="handlers/assets/images/previous-icon.svg" alt="previous-icon" />
            </a>
        
            <div class="mt-3">
            <h5>New Contact</h5>
            </div>
            <button type="button" onclick="postReport()" name="btn_add_sos" id="btn_add_sos" class="btn btn-sm btn-dark fontBold loading">
                <!-- <i class="fa fa-plus fontSmally"></i>   -->Add
           </button>
        </div>
    <!-- <div class="section"> -->
        <div class="container">
                <h2 class="text-white text-center py-4 incident">&nbsp;</h2>
                <div class="relativeinput fontRegular">
                    <input type="text" name="post_name_sos" id="post_name_sos" required class="form-control fontRegular mb-3 p-3" style="background-color: rgba(37, 37, 37, 0.1); height: 20%; color: #fff;" placeholder="Full Name" onfocus="this.placeholder=''" onblur="this.placeholder='Full Name'">
                    <input type="tel" name="post_phone_sos" id="post_phone_sos" required class="form-control fontRegular mb-3 p-3" style="background-color: rgba(37, 37, 37, 0.1); height: 20%; color: #fff;" placeholder="Phone Number" onfocus="this.placeholder=''" onblur="this.placeholder='Phone Number'">
                    <input type="email" name="post_email_sos" id="post_email_sos" required class="form-control fontRegular mb-3 p-3" style="background-color: rgba(37, 37, 37, 0.1); height: 20%; color: #fff;" placeholder="Email Address" onfocus="this.placeholder=''" onblur="this.placeholder='Email Address'">
                    <textarea class="form-control p-3 fontRegular" required rows="7" style="background-color: rgba(37, 37, 37, 0.1); height: 20%; color: #fff;" id="postMessage" name="postAbout_sos" placeholder="Tell us about this person briefly" onfocus="this.placeholder=''" onblur="this.placeholder='Tell us about this person briefly'"></textarea>
                    <input type="hidden" name="file_list" id="file_list" value="" required>
                   <input type="hidden" name="currCoords" id="currCoords" value="">
                   <input type="hidden" name="locationName" id="locationName" value="">
                </div>
               <!--  <p class="text-center fontRegular mt-4 justify-content-center p-2 alert-info progress_bar" style="padding: 0px; display: none;">
                    <span class="fileCount"></span>file(s) uploaded
                </p> -->
                <!-- <div class="row mt-4 justify-content-center ">
                    <div class="badge badge-primary">
                        No Media Yet
                    </div>
                </div> -->
                
                <div class="row mt-4 justify-content-center previewFile mb-5 ">
                    <!-- <div class="col">
                        <img style="justify-self: center;" src="handlers/assets/images/slide 1.png" class="img-fluid">
                    </div>
                    <div class="col">
                        <div class="ratio ratio-4x3">
                            <iframe src="https://www.youtube.com/embed/bsthKhTHguI" title="YouTube video"></iframe>
                            <video src="" ></video>
                        </div>
                    </div>
                    -->
                    
                
                </div>
        </div>
    </form>
        
        <!--Footer-->
        <div class="fixed-navigation-tab">
            <a href="index.php" class="fixed-navigation-link">
              <div class="text-center mt-2">
                <svg
                  width="14"
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
              <a href="#" class="report-emergency-button d-flex btn btn-danger rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#reportType" 
              >
                <img
                  src="handlers/assets/images/speaker-icon.png"
                  class="mt-1 me-2"
                  alt="speaker-icon"
                /><span class="report-emergency-button-text">Report Emergency</span>
                </a>
            </div>
            <a href="profile.html" class="fixed-navigation-link">
              <div class="text-center mt-2">
                <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="6.91396" cy="4.72841" r="3.72841" fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M1.00001 13.6423C0.999011 13.3802 1.05763 13.1213 1.17143 12.8852C1.52856 12.1709 2.53566 11.7924 3.37134 11.6209C3.97403 11.4923 4.58505 11.4064 5.19984 11.3638C6.33807 11.2638 7.48288 11.2638 8.62112 11.3638C9.23586 11.4069 9.84684 11.4928 10.4496 11.6209C11.2853 11.7924 12.2924 12.1352 12.6495 12.8852C12.8784 13.3665 12.8784 13.9252 12.6495 14.4065C12.2924 15.1565 11.2853 15.4993 10.4496 15.6636C9.84763 15.7976 9.23639 15.8859 8.62112 15.9279C7.69469 16.0064 6.76393 16.0208 5.83552 15.9708C5.62125 15.9708 5.41411 15.9708 5.19984 15.9279C4.58686 15.8864 3.97797 15.7981 3.37848 15.6636C2.53566 15.4993 1.5357 15.1565 1.17143 14.4065C1.05821 14.1677 0.99965 13.9066 1.00001 13.6423Z" fill="white" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                <p>Account</p>
              </div>
            </a>
          </div>
    <!-- </div> -->
 
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
                <button type="button" class="btn btn-danger fs-1"><i class="fa fa-envelope"></i> Send SOS</button>
                <button type="button" class="btn btn-outline-primary"><small><i class="fa fa-eye"></i> Eye Witness</small></button>
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

  <script src="handlers/css/bootstrap.min.js"></script>  
  <script src="../dependencies/js/node_modules/cloudinary-jquery-file-upload/js/jquery.ui.widget.js" type="text/javascript"></script>
        <script src="../dependencies/js/node_modules/blueimp-load-image/js/load-image.all.min.js"></script>
        <script src="../dependencies/js/node_modules/blueimp-canvas-to-blob/js/canvas-to-blob.min.js"></script>
        <script src="../dependencies/js/node_modules/blueimp-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
        <script src="../dependencies/js/node_modules/blueimp-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
        <script src="../dependencies/js/node_modules/blueimp-file-upload/js/jquery.fileupload-process.js"></script>
        <script src="../dependencies/js/node_modules/blueimp-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
        <script src="../dependencies/js/node_modules/blueimp-file-upload/js/jquery.fileupload-validate.js"></script>
        <script src="../dependencies/js/node_modules/cloudinary-jquery-file-upload/cloudinary-jquery-file-upload.js" type="text/javascript"></script>
 <!-- <script src="handlers/js/all.js"></script> -->
 <script src="handlers/js/report_incident.js"></script>
 <script src="handlers/js/requests_all.js"></script> 
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7su9_A0NPfpZ0YN37NxiM97Y2TJM1hBA"></script>
</body>
</html>