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


    public function get_html_page(){


?>

<link rel="stylesheet" href="<?php echo site_url()."/wp-content/plugins/shnoContacUs/admin/css/style.css"?>">

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
          foreach($this->get_data() as $item){
            ?>
            <li class="table-row">
            <div class="col col-1" data-label="شناسه"><?php echo $item->Id?></div>
            <div class="col col-2" data-label="نام"> <?php echo $item->Name ?></div>
            <div class="col col-3" data-label="ایمیل"><?php echo $item->Email ?></div>
            <div class="col col-3" data-label="شماره موبایل"><?php echo $item->Mobile ?></div>
            <div class="col col-1" data-label="موضوع"><?php echo $item->Topic ?></div>
            <div class="col col-1" data-label="وضعیت"><?php echo $item->Is_see ?></div>
            <div class="col col-1" data-label="عملیات">حذف</div>
            <div class="col col-1" data-label="عملیات">مشاهده</div>
          </li>
<?php } ?>
        </ul>
      </div>'

      <?php


    }



    public function get_data(){

      require_once(SHNO_CONFIG);
      $shno_config=new config();
      return $shno_config->getMessage();
    }




}


