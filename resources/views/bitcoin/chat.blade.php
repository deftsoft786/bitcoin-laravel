  <div class="chat-person">
          <header>
            <h3>John Smith</h3>
            <a href="javascript:void(0)" class="close-chat">
              <div  style="left: -22px; padding: 15px; position: relative;"> 
                  </div>
            </a>
            <a href="javascript:void(0)" class="minimize-chat"><div  style="left: -22px; padding: 15px;"> 
                  </div></a>
          </header>
          <div class="messages">
            <div class="friend-message">
              <p>Hello Loretta</p>
              <span>16:33</span>
            </div>
            <div class="my-message">
              <p>Hello Loretta,<br/> How are you</p>
             <span>16:33</span>
            </div>
          </div>
          <footer>
            <input type="text" placeholder="Type Something" class="message-box">
            <button class="send"></button>
          </footer>
        </div>
        <div style="height:44%!important;" class="chat-online chat-person">
          <header>
            <h3>Active Users</h3>
                <a href="javascript:void(0)" class="close-chat"><div  style="left: -22px; padding: 15px; position: relative;"> 
                  </div></a>
              <a href="javascript:void(0)" class="minimize-chat"><div  style="left: -22px; padding: 15px; "> 
                  </div></a>
          </header>
          <div class="users">
<?php  foreach ($abc[0][3] as $key => $value) { ?>
            <div class="user">
                 <?php 

                   $image_get    = $value->image;
                   $fb_img       = $value->fb_img;

                    if(!empty($image_get)){

                   echo '<img  src="'.url('bitcoin/images/user/'.$image_get).'"/>';

                      }elseif(!empty($fb_img)){

                        echo '<img  src="'.$fb_img.'"/>';

                        

                      }else{

                        echo '<img alt="profile" src="'.url('bitcoin/images/propic.jpg').'"/>';

                      } ?>
              <div class="data">

                <h4><?php  echo $value->name; ?></h4>

                <p><span></span> Online</p>

              </div>

            </div>

         <?php }   ?>
          

           

           

         

          </div>

          <footer>

            <input type="text" placeholder="Search" class="message-box">

          </footer>

        </div>
