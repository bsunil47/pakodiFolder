<?php

$config = array(
    //adminprofile
            'adminprofile' => array(
               array(
                     'field'   => 'name', 
                     'label'   => 'Name', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'msisdn', 
                     'label'   => 'Mobile Number', 
                     'rules'   => 'required|trim|regex_match[/^[0-9]{6,16}+$/]'
                  )
             ),
    //category
            'category' => array(
               array(
                     'field'   => 'category', 
                     'label'   => 'category', 
                     'rules'   => 'required|trim'
                  )
             ),
    //addadminuser
            'addadminuser' => array(
               array(
                     'field'   => 'name', 
                     'label'   => 'Name', 
                     'rules'   => 'required|trim|min_length[3]|max_length[40]'
                  ),
               array(
                     'field'   => 'email', 
                     'label'   => 'EmailId', 
                     'rules'   => 'required|trim|valid_email|is_unique[tbl_users.email]'
                  ),
                array(
                     'field'   => 'msisdn', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim|min_length[3]|max_length[32]'
                  )
             ),
    //updateadminuser
            'updateadminuser' => array(
               array(
                     'field'   => 'name', 
                     'label'   => 'Name', 
                     'rules'   => 'required|trim|min_length[3]|max_length[40]'
                  ),
               array(
                     'field'   => 'email', 
                     'label'   => 'EmailId', 
                     'rules'   => 'required|trim|valid_email'
                  ),
                array(
                     'field'   => 'msisdn', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim|min_length[3]|max_length[32]'
                  )
             ),
    //addmoderator
            'addmoderator' => array(
               array(
                     'field'   => 'name', 
                     'label'   => 'Name', 
                     'rules'   => 'required|trim|min_length[3]|max_length[40]'
                  ),
               array(
                     'field'   => 'email', 
                     'label'   => 'EmailId', 
                     'rules'   => 'required|trim|valid_email|is_unique[tbl_users.email]'
                  ),
                array(
                     'field'   => 'msisdn', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim|min_length[3]|max_length[32]'
                  )
             ),
    //updatemoderator
            'updatemoderator' => array(
               array(
                     'field'   => 'name', 
                     'label'   => 'Name', 
                     'rules'   => 'required|trim|min_length[3]|max_length[40]'
                  ),
               array(
                     'field'   => 'email', 
                     'label'   => 'EmailId', 
                     'rules'   => 'required|trim|valid_email'
                  ),
                array(
                     'field'   => 'msisdn', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim|min_length[3]|max_length[32]'
                  )
             ),
    //addcontentowner
            'addcontentowner' => array(
               array(
                     'field'   => 'name', 
                     'label'   => 'Name', 
                     'rules'   => 'required|trim|min_length[3]|max_length[40]'
                  ),
               array(
                     'field'   => 'email', 
                     'label'   => 'EmailId', 
                     'rules'   => 'required|trim|valid_email|is_unique[tbl_users.email]'
                  ),
                array(
                     'field'   => 'msisdn', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim|min_length[3]|max_length[32]'
                  )
             ),
    //updatecontentowner
            'updatecontentowner' => array(
               array(
                     'field'   => 'name', 
                     'label'   => 'Name', 
                     'rules'   => 'required|trim|min_length[3]|max_length[40]'
                  ),
               array(
                     'field'   => 'email', 
                     'label'   => 'EmailId', 
                     'rules'   => 'required|trim|valid_email'
                  ),
                array(
                     'field'   => 'msisdn', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required|trim|min_length[3]|max_length[32]'
                  )
             ),
    //addcontent
            'addcontent' => array(
                array(
                     'field'   => 'category_id', 
                     'label'   => 'Category', 
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'language_id', 
                     'label'   => 'Language', 
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'parental_advisory', 
                     'label'   => 'Parental Advisory', 
                     'rules'   => 'required'
                  ),
                /*array(
                     'field'   => 'unique_code', 
                     'label'   => 'Unique Code', 
                     'rules'   => 'required|trim'
                  ),*/
                /*array(
                     'field'   => 'contentowner_id', 
                     'label'   => 'Content Owner Id', 
                     'rules'   => 'required|trim|is_natural_no_zero'
                  ),*/
                array(
                     'field'   => 'title', 
                     'label'   => 'Title', 
                     'rules'   => 'required|trim|max_length[75]'
                  ),
                array(
                     'field'   => 'short_desc', 
                     'label'   => 'Short Description', 
                     'rules'   => 'required|trim|max_length[150]'
                  ),
                array(
                     'field'   => 'movie_name', 
                     'label'   => 'Movie Name', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'main_artist', 
                     'label'   => 'Main Artist', 
                     'rules'   => 'required|trim'
                  ),                
                /*array(
                     'field'   => 'content_activationdate', 
                     'label'   => 'content activation date', 
                     'rules'   => 'required|trim'
                  ),*/
                array(
                     'field'   => 'content_type', 
                     'label'   => 'Content Type', 
                     'rules'   => 'required|trim'
                  )
                
             ),
    //updatecontent
            'updatecontent' => array(
                array(
                     'field'   => 'category_id', 
                     'label'   => 'Category', 
                     'rules'   => 'required'
                  ),
                array(
                     'field'   => 'language_id', 
                     'label'   => 'Language', 
                     'rules'   => 'required'
                  ),
               /* array(
                     'field'   => 'recommend_type', 
                     'label'   => 'Recommend Type', 
                     'rules'   => 'required'
                  ),*/
                array(
                     'field'   => 'parental_advisory', 
                     'label'   => 'Parental Advisory', 
                     'rules'   => 'required'
                  ),
                /*array(
                     'field'   => 'unique_code', 
                     'label'   => 'Unique Code', 
                     'rules'   => 'required|trim'
                  ),*/
                /*array(
                     'field'   => 'contentowner_id', 
                     'label'   => 'Content Owner Id', 
                     'rules'   => 'required|trim|is_natural_no_zero'
                  ),*/
                array(
                     'field'   => 'title0', 
                     'label'   => 'Title', 
                     'rules'   => 'required|trim|max_length[75]'
                  ),
                array(
                     'field'   => 'short_desc0', 
                     'label'   => 'Short Description', 
                     'rules'   => 'required|trim'
                  ),//|max_length[150]
                array(
                     'field'   => 'movie_name0', 
                     'label'   => 'Movie Name', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'main_artist0', 
                     'label'   => 'Main Artist', 
                     'rules'   => 'required|trim'
                  ),  
                array(
                     'field'   => 'title1', 
                     'label'   => 'Title', 
                     'rules'   => 'required|trim|max_length[75]'
                  ),
                array(
                     'field'   => 'short_desc1', 
                     'label'   => 'Short Description', 
                     'rules'   => 'required|trim'
                  ),//|max_length[150]
                array(
                     'field'   => 'movie_name1', 
                     'label'   => 'Movie Name', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'main_artist1', 
                     'label'   => 'Main Artist', 
                     'rules'   => 'required|trim'
                  ),           
                /*array(
                     'field'   => 'content_activationdate', 
                     'label'   => 'content activation date', 
                     'rules'   => 'required|trim'
                  ),*/
                array(
                     'field'   => 'content_type', 
                     'label'   => 'Content Type', 
                     'rules'   => 'required|trim'
                  )
                
             ),
    //languages
             'languages' => array(
               array(
                     'field'   => 'language', 
                     'label'   => 'Language', 
                     'rules'   => 'required|trim'
                  )
             ),
    //updaterecommend
             'updaterecommend' => array(
               array(
                     'field'   => 'recommend_value', 
                     'label'   => 'Recommend', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'trending_value', 
                     'label'   => 'Trending', 
                     'rules'   => 'required|trim'
                  )
             ),
    //sendmail
            'sendmail' => array(
               array(
                     'field'   => 'message', 
                     'label'   => 'Message', 
                     'rules'   => 'required|trim'
                  )
             ),
	//movedubs&moverecords
            'movedubs' => array(
               array(
                     'field'   => 'dubclip_title', 
                     'label'   => 'Dubclip title', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'clip_length', 
                     'label'   => 'Clip length', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'category_id', 
                     'label'   => 'Category', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'parental_advisory', 
                     'label'   => 'Parental-advisory', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'language_id', 
                     'label'   => 'Language', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'movie_name', 
                     'label'   => 'Movie Name', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'main_artist', 
                     'label'   => 'Main Artist', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'content_type', 
                     'label'   => 'Content Type', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'short_desc', 
                     'label'   => 'short description', 
                     'rules'   => 'required|trim'
                  )
             ),
			 
			 //forgotpassword-changepassword
            'forgottochange' => array(
                array(
                     'field'   => 'password', 
                     'label'   => 'password', 
                     'rules'   => 'required|trim'
                  ),
                array(
                     'field'   => 'c_password', 
                     'label'   => 'confirm password', 
                     'rules'   => 'required|trim|matches[password]'
                  )
             )
	
    
              
    );//main
?>
