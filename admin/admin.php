<?php
class admin
{



  public function page()
  {

    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "see" && $_REQUEST['id'])
      echo $this->ShowContac($_REQUEST['id']);
    else
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
            <div class="col col-1" data-label="عملیات"> 
            <a
                href="<?php echo  admin_url("admin.php?page=ContacUS&action=see&id={$item->Id}")  ?>">مشاهده</a>  
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>





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



  public function ShowContac($id)
  {
  

    require_once (SHNO_CONFIG);
    $shno_config = new config();
    $data = $shno_config->getMessageById($id);
    $data = $shno_config->updateSee($id);
    if (count($data))
      $data = $data[0];

    ?>
    <link rel="stylesheet" href="<?php echo site_url() . "/wp-content/plugins/shnoContacUs/public/css/style.css" ?>">
    <div class="container">
      <form>

        <label for="Name"> نام</label>
        <input type="text" disabled value="<?php echo $data->Name?>">

        <label for="Email">ایمیل</label>
        <input type="text" id="Email" name="Email" disabled value="<?php echo $data->Email?>">

        <label for="Mobile"> موبایل</label>
        <input type="text" id="Mobile" name="Mobile" disabled value="<?php echo $data->Name?>">

        <label for="Topic">موضوع</label>
        <select disabled id="Topic" name="Topic">
          <option ><?php echo $this->getTranslateTopic($data->Topic) ?></option>
        </select><br>

        <label for="discription">توضیحات</label>
        <textarea id="discription" name="discription" disabled style="height:200px"><?php echo $data->discription?></textarea>
      </form>
    </div>
    <?php


  }



}


