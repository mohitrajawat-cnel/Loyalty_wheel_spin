<?php
session_start();
include 'admin_panel/pages/config.php';

if(isset($_SESSION['user_id']))
{
    $user_id_session = $_SESSION['user_id'];
}


if(isset($_REQUEST['ifreame']) && (isset($_REQUEST['ifuser_id']) && $_REQUEST['ifuser_id'] != ''))
{
$user_id = 1;
$_SESSION['user_id'] = $_REQUEST['ifuser_id'];
$user_id_session = $_REQUEST['ifuser_id'];
}

    if(isset($_POST['save_contact_data']))
    {
             $name = $_POST['name'];
             $email = $_POST['email'];
             $mobile_number = $_POST['mobile_number'];
             $description = $_POST['description'];
             $datetime = date("Y-m-d H:i:s");

            $insert = "INSERT into ".$table_prefix."contact_form set name='$name',description='$description',email='$email',mobile_number='$mobile_number',created='$datetime'";
         
            if(mysqli_query($conn,$insert))
            {

              echo '<div style="text-align:center;color:#000;">Form Submitted Successfully</div>';

            }
    }



?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title><?php echo $site_title_hwe; ?></title>
<meta name="description" content="" data-type="admin" />
  <meta name="keywords" content="" data-type="admin" />
  <meta name="author" content="Gafami">
  <meta property="fb:app_id" content="1701132369920968" data-type="admin" />
  <meta property="og:url" content="" data-type="admin" />
  <meta property="og:type" content="Website" data-type="admin" />
  <meta property="og:title" content="<?php echo $site_title_hwe; ?>" data-type="admin" />
  <meta property="og:description" content="<?php echo $site_description; ?>" data-type="admin" />
  <meta property="og:image" content="" data-type="admin" />
  <?php echo $header_script_tag; ?>
<div>
  <div class="contact-form-wrapper d-flex justify-content-center">
    <form method="post" class="contact-form">
      <h5 class="title">Contact us</h5>
      <p class="description">Feel free to contact us if you need any assistance, any help or another question.
      </p>
      <div>
        <input type="text" class="form-control rounded border-white mb-3 form-input" id="name" name="name" placeholder="Name" required>
      </div>
      <div>
        <input type="email" class="form-control rounded border-white mb-3 form-input" name="email" placeholder="Email">
      </div>
      <div>
        <input type="number" class="form-control rounded border-white mb-3 form-input" name="mobile_number" placeholder="Mobile Number">
      </div>
      <div>
        <textarea id="message" class="form-control rounded border-white mb-3 form-text-area" rows="5" cols="30" name="description" placeholder="Message" required></textarea>
      </div>
      <div class="submit-button-wrapper">
        <input type="submit" value="Send" name="save_contact_data">
      </div>
    </form>
  </div>
</div>
<?php
          include 'site_front_menu.php';
        ?>
<style>
body {
  background-color: #f5e0e5 !important;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.contact-form-wrapper {
  padding: 100px 0;
}

.contact-form {
  padding: 30px 40px;
  background-color: #ffffff;
  border-radius: 12px;
  max-width: 400px;
}

.contact-form textarea {
  resize: none;
}

.contact-form .form-input,
.form-text-area {
  background-color: #f0f4f5;
  height: 50px;
  padding-left: 16px;
}

.contact-form .form-text-area {
  background-color: #f0f4f5;
  height: auto;
  padding-left: 16px;
}

.contact-form .form-control::placeholder {
  color: #aeb4b9;
  font-weight: 500;
  opacity: 1;
}

.contact-form .form-control:-ms-input-placeholder {
  color: #aeb4b9;
  font-weight: 500;
}

.contact-form .form-control::-ms-input-placeholder {
  color: #aeb4b9;
  font-weight: 500;
}

.contact-form .form-control:focus {
  border-color: #f33fb0;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.07), 0 0 8px #f33fb0;
}

.contact-form .title {
  text-align: center;
  font-size: 24px;
  font-weight: 500;
}

.contact-form .description {
  color: #aeb4b9;
  font-size: 14px;
  text-align: center;
}

.contact-form .submit-button-wrapper {
  text-align: center;
}

.contact-form .submit-button-wrapper input {
  border: none;
  border-radius: 4px;
  background-color: #f23292;
  color: white;
  text-transform: uppercase;
  padding: 10px 60px;
  font-weight: 500;
  letter-spacing: 2px;
}

.contact-form .submit-button-wrapper input:hover {
  background-color: #d30069;
}

.menu_site
{
  height: 30px;
}
.img_set
{
  width: 57px !important;
  margin-top: -6px;
}

    </style>