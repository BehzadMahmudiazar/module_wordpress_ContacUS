<?php
class admin
{



  public function page()
  {

    echo $this->get_html_page();

  }

  public function fnAdminMenu()
  {

    add_menu_page(
      "ارتباط با ما",
      "ارتباط با ما",
      "manage_options",
      "ContacUS",
      array($this, 'page')
    );


 

  }

  public function load()
  {

    add_action("admin_menu", array($this, 'fnAdminMenu'));
  }


  public function get_html_page()
  {


    ?>

    <link rel="stylesheet" href="<?php echo site_url() . "/wp-content/plugins/shnoContacUs/admin/css/style.css" ?>">

    <div class="container">
      <h2> لیست ورودی ها</h2>
      <ul class="responsive-table">
        <li class="table-header">
          <div class="col col-1">شناسه</div>
          <div class="col col-2">نام</div>
          <div class="col col-3">ایمیل</div>
          <div class="col col-3">شماره موبایل</div>
          <div class="col col-1">موضوع</div>
          <div class="col col-1">وضعیت</div>
          <div class="col col-1">عملیات</div>
          <div class="col col-1"></div>

        </li>
        <?php
        foreach ($this->get_data() as $item) {
          ?>
          <li class="table-row">
            <div class="col col-1" data-label="شناسه"><?php echo $item->Id ?></div>
            <div class="col col-2" data-label="نام"> <?php echo $item->Name ?></div>
            <div class="col col-3" data-label="ایمیل"><?php echo $item->Email ?></div>
            <div class="col col-3" data-label="شماره موبایل"><?php echo $item->Mobile ?></div>
            <div class="col col-1" data-label="موضوع"><?php echo $this->getTranslateTopic($item->Topic) ?></div>
            <div class="col col-1" data-label="وضعیت"><?php echo $this->getTranslateStatus($item->Is_see); ?></div>
            <div class="col col-1" data-label="عملیات"><a
                href="<?php echo site_url() . "/wp-json/ShnoContacUS/delete?id=" . $item->Id ?>">حذف</a></div>
            <div class="col col-1" data-label="عملیات">مشاهده</div>
          </li>
        <?php } ?>
      </ul>
    </div>



    <html>

    <head>
      <title>A Simple Popup</title>
      <style>
        #overlay {
          display: none;
          position: absolute;
          top: 0;
          bottom: 0;
          background: #999;
          width: 100%;
          height: 100%;
          opacity: 0.8;
          z-index: 100;
        }

        #popup {
          display: none;
          position: absolute;
          top: 50%;
          left: 50%;
          background: #fff;
          width: 500px;
          height: 500px;
          margin-left: -250px;
          /*Half the value of width to center div*/
          margin-top: -250px;
          /*Half the value of height to center div*/
          z-index: 200;
        }

        #popupclose {
          float: right;
          padding: 10px;
          cursor: pointer;
        }

        .popupcontent {
          padding: 10px;
        }

        #button {
          cursor: pointer;
        }
      </style>
    </head>

    <body>
      <div id="maincontent">
        <h1>Page Content<h2>
            <button id="button">Show Popup</button>
      </div>
      <div id="overlay"></div>
      <div id="popup">
        <div class="popupcontrols">
          <span id="popupclose">X</span>
        </div>
        <div class="popupcontent">
          <h1>Some Popup Content</h1>
        </div>
      </div>
      <script type="text/javascript">
        // Initialize Variables
        var closePopup = document.getElementById("popupclose");
        var overlay = document.getElementById("overlay");
        var popup = document.getElementById("popup");
        var button = document.getElementById("button");
        // Close Popup Event
        closePopup.onclick = function () {
          overlay.style.display = 'none';
          popup.style.display = 'none';
        };
        // Show Overlay and Popup
        button.onclick = function () {
          overlay.style.display = 'block';
          popup.style.display = 'block';
        }
      </script>
    </body>

    </html>

    <?php


  }


  public function getTranslateTopic($word)
  {

    if ($word == "support") {
      return "پشتیبانی";
    } else if ($word == "technical") {
      return "فنی";

    } else {
      return "سایر";

    }
  }

  public function getTranslateStatus($word)
  {
    if ($word == "0") {
      return "مشاهده نشده";
    } else {
      return "مشاهده شده";

    }
  }



  public function get_data()
  {

    require_once (SHNO_CONFIG);
    $shno_config = new config();
    return $shno_config->getMessage();
  }




}


