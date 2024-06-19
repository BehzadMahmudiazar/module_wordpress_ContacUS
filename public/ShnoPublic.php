<?php
class ShnoPublic
{


    public function load()
    {
        ?>
        <link rel="stylesheet" href="<?php echo site_url() . "/wp-content/plugins/shnoContacUs/public/css/style.css" ?>">
        <div class="container">
            <form method="post" action="<?php echo site_url() . "/wp-json/" . "ShnoContacUS/register"?>">

                <label for="Name"> نام</label>
                <input type="text" id="Name" name="Name" placeholder="نام شما ..">

                <label for="Email">ایمیل</label>
                <input type="text" id="Email" name="Email" placeholder="ایمیل ..">
               
                <label for="Mobile"> موبایل</label>
                <input type="text" id="Mobile" name="Mobile" placeholder=" موبایل ..">

                <label for="Topic">موضوع</label>
                <select id="Topic" name="Topic">
                    <option value="technical">فنی</option>
                    <option value="support">پشتیبانی</option>
                    <option value="other">سایر</option>
                </select>

                <label for="discription">توضیحات</label>
                <textarea id="discription" name="discription" placeholder="توضیحات .." style="height:200px"></textarea>

                <input type="submit" value="ثبت">

            </form>
        </div>
        <?php

    }





}