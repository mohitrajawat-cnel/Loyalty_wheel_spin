 <style>
        .popup-overlay {
        	position: fixed;
        	z-index: 10000;
        	top: 0;
        	left: 0;
        	overflow: hidden;
        	width: 100%;
        	height: 100%;
        	opacity: .8;
        	background: #2d2d32;
        	filter: alpha(opacity=80);
        }
        .modal-dialog-centered
        {
            z-index: 10000 !important;
        }
        .modal-dialog
        {
            margin:auto !important;
            position: relative;
            width: auto;
        }
        .modal
        {
            top: 25% !important;
            /*position : absolute !important;*/
            position: fixed;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1050;
            display: none;
            overflow: hidden;
            -webkit-overflow-scrolling: touch;
            outline: 0;
        
        }
        .modal-open .modal {
          overflow-x: hidden;
          overflow-y: auto;
        }
        
        .modal-content {
        	position: relative;
        	background-color: #fff;
        	background-clip: padding-box;
        	border: 1px solid rgba(0,0,0,.2);
        	border-radius: 6px;
        	-webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);
        	box-shadow: 0 3px 9px rgba(0,0,0,.5);
        	outline: 0;
        }
        
        .modal-header {
        	padding: 15px;
        	border-bottom: 1px solid #e5e5e5;
        }
        
        .modal-body {
        	position: relative;
        	padding: 15px;
        }
        
        .text-center {
        	text-align: center;
        }
        
        .h4{
        	margin-top: 10px;
        	margin-bottom: 10px;
        }
        
        .form-group {
        	margin-bottom: 15px;
        }
        
        .row {
        	margin-right: -15px;
        	margin-left: -15px;
        }
        
        .form-control
        {
            display: block;
            height: 34px;
            /*padding: 6px 12px;*/
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        }
        @media only screen and (min-width:768px)
        {
            .modal-dialog {
            	width: 600px !important;
            	margin: 30px auto;
            }
            .modal-content {
              -webkit-box-shadow: 0 5px 15px rgba(0,0,0,.5) !important;
              box-shadow: 0 5px 15px rgba(0,0,0,.5) !important;
            }
            .col-sm-4 {
                width: 33.33333333% !important;
            }
            .col-sm-6 {
              width: 50% !important;
              padding-right: 15px !important;
              padding-left: 15px !important;
            }
        }
        .modal_footer
        {
            justify-content: center;
            display: flex;
            background: linear-gradient(40deg, #45cafc, #303f9f);
            color: #ffffff;
            padding: 15px;
            text-align: right;
            border-top: 1px solid #e5e5e5;
        }
        .design_password
        {
            border-radius: 5px;
            border: 2px solid #45cafc;
        }
        .login_form_style
        {
            text-align: right;padding: 20px;color: #ef8318;
        }
        .btn-block {
        	display: block;
        	width: 100%;
        }
        .btn-info {
        	color: #fff;
        	background-color: #5bc0de;
        	border-color: #46b8da;
        }
        .btn {
        	display: inline-block;
        	margin-bottom: 0;
        	font-weight: 400;
        	text-align: center;
        	white-space: nowrap;
        	vertical-align: middle;
        	-ms-touch-action: manipulation;
        	touch-action: manipulation;
        	cursor: pointer;
        	background-image: none;
        	border: 1px solid transparent;
        	padding: 6px 12px;
        	font-size: 14px;
        	line-height: 1.42857143;
        	border-radius: 4px;
        	-webkit-user-select: none;
        	-moz-user-select: none;
        	-ms-user-select: none;
        	user-select: none;
        }
        @media only screen and (max-width:590px)
        {
            .show_in_center_mobile
            {
                justify-content: center;
            }
            .custom_add_margin_user
            {
                margin-left: 16px;
            }
        }
        .show_in_center_mobile
        {
            display: flex;
        }
        #popup-customer-email .inactive 
        {
            pointer-events: none;
        }
    
        .custom_login_button_user
        {
            position: absolute;
            top: 8px;
            font-size: 32px;
            color: #fff;
       
            cursor:pointer;
            text-align: left;
        }
        
        @media only screen and (max-width:767px)
        {
            .custom_login_button_user
            {
             
                text-align: left !important;
                
            }
      
        }
        #save_user_login
        {
            background-image: linear-gradient(to right, #f5ce62, #e43603, #fa7199, #e85a19);
            box-shadow: 0 4px 15px 0 rgba(229, 66, 10, 0.75);
            text-transform: uppercase;
            width: 120px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            margin: 5px;
            height: 55px;
            text-align: center;
            border: none;
            background-size: 300% 100%;
            border-radius: 50px;
        }
        
    </style>