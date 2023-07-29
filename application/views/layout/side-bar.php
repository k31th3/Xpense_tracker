  
  <?php 
      $attr = "class='nav-link hstack gap-2'";  
      
      foreach($this->page->get_all_page() as $row)
      {
        $access_emp = explode(', ', $row->access_emp);
        $access_role = explode(', ', $row->access_role);
        
        // if (in_array($this->session->user_id, $access_emp) && $row->access_role == 0)
        if(in_array($this->session->user_id, $access_emp)) 
        {
          $page = anchor($row->page_url, "<i class='{$row->icon}'></i>".ucwords($row->page_name), $attr);    
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
            $page = anchor($row->page_url, "<i class='{$row->icon}'></i>".ucwords($row->page_name), $attr);
          }
        }

        $list[] = $page; 
      }

      echo ul($list, ['class' => 'nav xt-nav']);
  ?>

  <hr class="my-3">

  <ul class="nav flex-column mb-auto">
    <li class="nav-item">
      <a class="nav-link hstack gap-2" href="#">
        <i class="ri-settings-3-fill"></i>  Settings
      </a>
    </li>
    <li class="nav-item">
      <?=anchor("sign-out", "<i class='ri-logout-box-fill '></i> Sign out", $attr)?>
    </li>
  </ul>