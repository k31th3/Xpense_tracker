  
  <!-- logo -->

  <div class="col-12 py-4 d-flex" style="max-height: 150px; height: 150px;">
    <?php 

      $r_setting =  $this->setting->get_logo_data();
      
      $details = (object)json_decode(preg_replace('/[\r\n]/',' ', $r_setting->setting_details), true);

      $attr = array(
        'src' => $details->url,
        'class' => 'img-fluid',
        'width' => '100%',
        'height' => '100%'
      );

      echo img($attr);
    ?>
  </div>

  <?php 
      foreach($this->page->get_all_page() as $row)
      {
        $access_emp = explode(', ', $row->access_emp);
        $access_role = explode(', ', $row->access_role);

        $page = str_replace(' ', '_', strtolower($row->page_name));
        $attr = "class='nav-link hstack gap-2' id='{$page}'";   

        // if (in_array($this->session->user_id, $access_emp) && $row->access_role == 0)
        if(in_array($this->session->user_id, $access_emp)) 
        {
          $page = anchor($row->page_url, "<i class='{$row->icon}'></i>".$row->page_name, $attr);    
        }
        // else if (in_array($this->session->role_id, $access_role) && $row->access_emp == 0) 
        // {
        //   $page = anchor($row->url, "<i class='{$row->icon}'></i>".ucwords($row->page_name), $attr); 
        // }
        else
        {
          $page = null;
          // if ($row->access_emp == 0 && $row->access_role == 0)
          if ($row->access_emp == 0) 
          {
            $page = anchor($row->page_url, "<i class='{$row->icon}'></i>".$row->page_name, $attr);
          }
        }

        $list[] = $page; 
      }

      echo ul($list, ['class' => 'nav xt-nav']);
  ?>

  <!-- <hr class="my-3"> -->

  <ul class="nav flex-column mb-auto xt-nav">
    <li class="nav-item">
      <a class="nav-link hstack gap-2" href="#">
        <i class="ri-settings-3-fill"></i> Settings
      </a>
    </li>
    <li class="nav-item">
      <?=anchor("sign-out", "<i class='ri-logout-box-fill '></i> Sign out", "class='nav-link hstack gap-2'")?>
    </li>
  </ul>