<?php
// Funeral Details Page - Individual funeral detail display from MuchLoved widget
require_once 'includes/admin-config.php';

// Load page content
$content = loadContent('funeral-details');

// Set page meta from JSON or use defaults
$page_title = $content['meta']['title'] ?? 'Funeral Details | Barringtons Funeral Services';
$page_description = $content['meta']['description'] ?? '';
$page_keywords = $content['meta']['keywords'] ?? '';

// Include header
require_once 'includes/header.php';
?>

    <section class="page-hero">
        <div class="hero-image editable-hero-bg" data-field="hero.image" data-page="funeral-details" style="background-image: url('<?php echo $content['hero']['image'] ?? 'assets/images/hero-bg.jpg'; ?>');">
        <?php if (IS_ADMIN): ?>
            <div class="hero-edit-overlay" onclick="editHeroImage(this)" style="position: absolute; top: 70%; left: 50%; transform: translate(-50%, -50%); background: rgba(37, 99, 235, 0.9); color: white; padding: 15px 30px; border-radius: 8px; cursor: pointer; font-weight: 500; display: none; z-index: 100;">
                📷 Click to Change Hero Image
            </div>
        <?php endif; ?>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content-single">
            <h1><?php echo $content['hero']['title'] ?? 'Funeral Details'; ?></h1>
        </div>
    </section>

    <section class="content-section">
        <div class="container">
            <!--BEGIN MUCHLOVED WIDGETS-->

            <style type="text/css">

              .ml-details-widget-container p{
                margin    : 10px 0 14px 0;
                text-align: left;
              }

              .ml-details-widget-container h3{
                margin: 0;
              }

              p.ml-fundraisinginfo-target{
                padding-bottom: 0 !important;
              }


              .ml-widget-tr-mainnotice,
              .ml-widget-tr-donationgallery,
              .ml-widget-tr-thoughtgallery,
              .ml-widget-tr-funeralnotice,
              .ml-widget-tr-imagegallery,
              .ml-widget-tr-fundraisinginfo{
                margin-top: 40px;
              }

              .ml-widget-tr-mainnotice{
                border    : none;
                margin-top: 0;
              }

              .ml-widget-tr-donationgallery,
              .ml-widget-tr-thoughtgallery{
                border: none;
              }

              .ml-widget-tr-mainnotice:empty,
              .ml-widget-tr-donationgallery:empty,
              .ml-widget-tr-thoughtgallery:empty,
              .ml-widget-tr-funeralnotice:empty,
              .ml-widget-tr-imagegallery:empty,
              .ml-widget-tr-fundraisinginfo:empty{
                border : none;
                margin : 0;
                padding: 0;
              }

              h2.ml-heading{
                margin-bottom: 10px;
              }

              .ml-tribute-subtitle{
                text-align: left;
              }

              .ml-tribute-thumb{
                display: none;
              }

              .ml-fundraisinginfo-raisedsofar{
               margin-bottom: 40px;
              }

              .ml-fundraisinginfo{
                display: table-row;
                width  : 100%;
              }

              .ml-fundraisinginfo-charity{
                margin-bottom: 20px;
                margin-right : 20px;
                text-align   : middle;
                float        : left;
              }

              .ml-fundraisinginfo-charity-details{
                min-height   : 56px;
                margin-bottom: 10px;
                text-align   : center;
              }

              .ml-fundraisinginfo-charity img{
                display: block;
                margin : auto;
                padding: 0;
                border : none;
              }

              ul.ml-action-list{
                margin-top  : 20px;
                margin-left : 0;
                padding-left: 0;
                list-style  : none;
                font-size   : 0;
              }

              ul.ml-action-list li{
                display      : inline-block;
                padding-right: 20px;
              }

              a.ml-button{
                color           : #FFF;
                font-size       : 16px;
                border-radius   : 5px;
                background-color: #747886;
                border          : 1px solid #747886;
                padding         : 9px;
              }

              a.ml-fundraisinginfo-donatelink{
                background-color: #36A139;
                border          : 1px solid #36A139;
              }

              ul.bxslider{
                margin-left: 0;
              }

              .ml-widget-tr-loading{
                background-image: url(//www.muchloved.com/client/widgets/img/loader.gif);
                height          :24px;
                width           :24px;
                margin-top      :20px;
              }

              .ml-donation,
              .ml-thought{
                padding      : 10px;
                box-shadow   : 0 0 5px #ccc;
                border       : 5px solid #fff;
                margin-bottom:15px;
                margin-top   : 30px;
                position     : relative;
              }

              .ml-donation-message,
              .ml-thought-message{
                margin-bottom: 10px;
              }

              .ml-donation-byline,
              .ml-thought-byline{
                font-style: italic;
              }

              a.ml-clickable-div{
                text-decoration: none;
                color          : #3D4247;
              }

              a.ml-clickable-div:hover{
                text-decoration: none;
                color          : #3D4247;
              }

              .ml-location-address{
                white-space: pre-wrap;
              }

              .ml-thought-type-candle .ml-thought-byline{
                background-image   : url(//www.muchloved.com/client/tribute/img/widget-candle-icon.png);
                background-repeat  : no-repeat;
                background-position: left center;
                padding-left       :20px;
              }


              .ml-footer{
                padding         : 10px;
                color           : #FFF;
                background-color: #2D3540;
                margin-bottom   : 50px;
                margin-top      : 30px;
              }

              .ml-footer a{
                color          : #fff;
                text-decoration: underline;
              }

              .ml-error{
                margin-top: 10px;
              }

              /* Style buttons to match site theme */
              a.ml-button {
                background: linear-gradient(to bottom, #e05d22 0%, #de3280 100%);
                border: none;
                border-bottom: 3px solid #b93207;
              }

              a.ml-button:hover {
                opacity: 0.9;
              }

              /* Mobile responsive styles */
              @media (max-width: 768px) {
                .ml-details-widget-container {
                  padding: 0 10px;
                }

                ul.ml-action-list li {
                  display: block;
                  padding-right: 0;
                  padding-bottom: 10px;
                }

                .ml-fundraisinginfo-charity {
                  float: none;
                  margin-right: 0;
                  text-align: center;
                }
              }

            </style>

            <div class="ml-details-widget-container">
              <h1 class="ml-widget-tr-title page-title"></h1>
              <div class="line"></div>

              <div class="ml-widget-tr-mainnotice">
                <div class="ml-widget-tr-loading"></div>
              </div>

              <div class="ml-widget-tr-funeralnotice"></div>
              <div class="ml-widget-tr-branchdetails"></div>
              <div class="ml-widget-tr-fundraisinginfo"></div>
              <div class="ml-widget-tr-donationgallery"></div>
              <div class="ml-widget-tr-imagegallery"></div>
              <div class="ml-widget-tr-thoughtgallery"></div>
              <div class="ml-widget-tr-fundevents"></div>
              <div class="ml-widget-tr-footer"></div>
            </div>

            <script>
                !function (d, s, id,widgetId,options) {
                   var js,
                       fjs = d.getElementsByTagName(s)[0],
                       p = /^http:/.test(d.location) ? "http" : "https";

                   if (!d.getElementById(id)) {
                       js = d.createElement(s);
                       js.id = id;
                       js.setAttribute("data-widgetid",widgetId);
                       js["ml-widget-options"]=options || {};
                       js.src = p + "://www.muchloved.com/client/widgets/tribute.widget.min.js";
                       fjs.parentNode.insertBefore(js, fjs);
                      }
                }(document, "script", "muchloved-tribute-widget-js","338358309");
            </script>

            <!--END MUCHLOVED WIDGETS-->

            <div class="back-link" style="margin-top: 30px;">
                <a href="muchloved-tributes" class="btn btn-secondary">&larr; Back to All Tributes</a>
            </div>
        </div>
    </section>

<?php
// Include footer
require_once 'includes/footer.php';
?>
