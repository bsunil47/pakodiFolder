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
    //addbalert
    'addbalert' => array(
        array(
            'field' => 'language_id',
            'label' => 'Select Language',
            'rules' => 'required'
        ),
        array(
            'field' => 'msg',
            'label' =>'Enter Your Message',
            'rules' => 'required|trim'
        )
    ),
    //addalert
    'addalert' => array(
        array(
            'field' => 'dtype',
            'label' => 'Select Device Type',
            'rules' => 'required'
            ),
        array(
            'field' => 'msg',
            'label' =>'Enter Your Message',
            'rules' => 'required|trim'
            )
    ),
    //editbalert
     'editbalert' => array(
            array(
            'field' => 'msg',
            'label' =>'Enter Your Message',
            'rules' => 'required|trim'
            )
    ),
    //addcuser
      'addcuser' => array(
        array(
            'field' => 'name',
            'label' => 'Enter Name',
            'rules' => 'required'
            ),
        array(
            'field' => 'clip',
            'label' =>'Upload Content Clip',
            'rules' => 'required'
            )
    ),
    //adduserclips excel
    'addecuser' => array( 
        array(
            'field' => 'zip',
            'label' => 'Upload Zip File',
            'rules' => 'required'
            )
        ),
    //addartistclip
   'addauser' => array(
        array(
            'field' => 'name',
            'label' => 'Enter Name',
            'rules' => 'required'
            ),
        array(
            'field' => 'clip',
            'label' =>'Upload Content Clip',
            'rules' => 'required'
            )
    ),
    //add carousal
    'addcarousal' =>array(
        array(
            'field' => 'file_type',
            'label' => 'Please Select File Type',
            'rules' => 'required'
        ),
        array(
            'field' => 'file',
            'label' => 'Please Upload Image',
            'rules' => 'required'
        ),
        array(
            'field' => 'filen',
            'label' => 'Please Upload Image',
            'rules' => 'required'
        ),
        array(
            'field' => 'file1',
            'label' => 'Please Upload Image',
            'rules' => 'required'
        ),
        array(
            'field' => 'expdate',
            'label' => 'Select Expiry Date',
            'rules' => 'required'
        ),
    ),
   //addartist clips excel
   'addeauser' => array( 
        array(
            'field' => 'zip',
            'label' => 'Upload Zip File',
            'rules' => 'required'
            )
        ),
    //adduser
    'adduser' => array(
        array(
                     'field'   => 'user', 
                     'label'   => 'Select User Type', 
                     'rules'   => 'required'
                  ),
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
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim|min_length[6]|max_length[16]'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 		
                     'rules'   => 'required|regex_match[/^(?=.*?\pL)(?=.*?\pN)(?=.*[!@#$%^&*])/]|trim|min_length[5]|max_length[32]'
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
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim|min_length[6]|max_length[16]'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     //'rules'   => 'required|trim|min_length[3]|max_length[32]'
					 //for checkcing with one numeric and special character
					 'rules'   => 'regex_match[/^(?=.*?\pL)(?=.*?\pN)(?=.*[!@#$%^&*])/]|trim|min_length[5]|max_length[32]'
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
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim|min_length[6]|max_length[16]'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     //'rules'   => 'required|trim|min_length[3]|max_length[32]'
					 //for checkcing with one numeric and special character
					 'rules'   => 'regex_match[/^(?=.*?\pL)(?=.*?\pN)(?=.*[!@#$%^&*])/]|trim|min_length[5]|max_length[32]'
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
                     'rules'   => 'required|regex_match[/^[0-9]+$/]|trim|min_length[6]|max_length[16]'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     //'rules'   => 'required|trim|min_length[3]|max_length[32]'
					 'rules'   => 'regex_match[/^(?=.*?\pL)(?=.*?\pN)(?=.*[!@#$%^&*])/]|trim|min_length[5]|max_length[32]'
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
                     //'rules'   => 'required|trim'
					 'rules'   => 'required|regex_match[/^(?=.*?\pL)(?=.*?\pN)(?=.*[!@#$%^&*])/]|trim|min_length[5]|max_length[32]'
                  ),
                array(
                     'field'   => 'c_password', 
                     'label'   => 'confirm password', 
                     'rules'   => 'required|trim|matches[password]'
                  )
             )
	
    
              
    );//main
?>
