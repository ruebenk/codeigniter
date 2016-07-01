<?php
class EmailModel extends CI_Model {

 function __construct(){
  parent::__construct();
  $this->load->library('email');
 }

 function verify($verificationText=NULL){
  $noRecords = $this->Homemodel->verifyEmailAddress($verificationText);
  if ($noRecords > 0){
   $error = array( 'success' => "Email Verified Successfully!");
  }else{
   $error = array( 'error' => "Sorry Unable to Verify Your Email!");
  }
  $data['errormsg'] = $error;
  $this->load->view('index.php', $data);
 }

function sendVerificationEmail($email,$id,$verificationText){
$config['useragent']    = 'CodeIgniter';
$config['protocol']     = 'smtp';
$config['smtp_host']    = 'ssl://smtp.googlemail.com';
$config['smtp_user']    = 'quopro.team@gmail.com'; // Your gmail id
$config['smtp_pass']    = 'quopro123'; // Your gmail Password
$config['smtp_port']    = 465;
$config['wordwrap']     = TRUE;
$config['wrapchars']    = 76;
$config['mailtype']     = 'html';
$config['charset']      = 'iso-8859-1';
$config['validate']     = FALSE;
$config['priority']     = 3;
$config['newline']      = "\r\n";
$config['crlf']         = "\r\n";
$this->load->library('email');
$this->email->initialize($config);
$this->email->set_newline("\r\n");
$this->email->from('quopro.team@gmail.com', "Admin Team");
$this->email->to($email);
$this->email->subject("Email Verification");
$this->email->message("Dear User, <br> Please click on below URL to verify your Email Address<br>http://www.quopro.com/Home/"."verify/".$id."/".$verificationText."\n"."<br><br>Thanks,<br> Admin Team");
if($this->email->send())
{
    echo 'We have sent a verification link to your email address.';
    return 1;
}
else{
    echo $this->email->print_debugger();
    return 0;
}

}

public function verifyEmailAddress($id,$verificationcode){
  $sql="SELECT VerificationCode From User WHERE Id='$id'";
  $s=$this->db->query($sql);
  if ($s->num_rows() > 0)
  {
    foreach ($s->result() as $row)
    {
      $vc=$row->VerificationCode;
      if($vc==$verificationcode)
      {
        $sql= "UPDATE User Set Verified=1 WHERE Id='$id'";
        $df = $this->db->query($sql);
        redirect("");
      }
    }
  }
 }

}
?>
