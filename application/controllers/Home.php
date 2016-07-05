<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper(array('form','url'));
    $this->load->database();
    $this->load->model('Project_model');
    $this->load->model('Emailmodel');
    $this->load->library("Projectfactory");
    $this->load->driver('session');
  }
  public function issession()
  {
    if($this->session->userdata('user_id'))
       return 1;
    else
       return 0;
  }
  public function index()
  {
    $data=array("ques"=>$this->Project_model->getquestions($this->getid()));
    $data["ans"]=array(0,count($data["ques"]),0);
    $o=0;
    $data["tags"]=array();
    foreach($data["ques"] as $q)
    {
      $data["ans"][$o]=$this->Project_model->getrecentans($q->Q_Id);
      $o=$o+1;
      $data["tags"][$q->Q_Id]=$this->Project_model->gettagfromques($q->Q_Id);
    }
    $data["sess"]=$this->issession();
    $this->load->view("Project/index",$data);
  }
  public function yo()
  {

  	$res = 	$this->Project_model->function1();
  	$json_response = json_encode($res);

  	/*# Optionally: Wrap the response in a callback function for JSONP cross-domain support
  	if($_GET["callback"]) {
  	    $json_response = $_GET["callback"] . "(" . $json_response . ")";
  	}
  	*/
  	# Return the response
  	echo $json_response;
  }

  public function tagdetail($tid,$tname)
  {
    $data["T_Id"]=$tid;
    $data["T_Name"]=$tname;
    $data["ques"]=$this->Project_model->getquesfromtag($tid,$this->getid());
    $data["sess"]=$this->getid();
    if($this->issession())
      $data["followed"]=$this->Project_model->istagfollowed($tid,$this->getid());
    else
      $data["followed"]=-1;
    $o=0;
    $data["tags"]=array();
    foreach($data["ques"] as $q)
    {
      $data["ans"][$o]=$this->Project_model->getrecentans($q->Q_Id);
      $o=$o+1;
      $data["tags"][$q->Q_Id]=$this->Project_model->gettagfromques($q->Q_Id);
    }
    $this->load->view("Project/tagdetail",$data);
  }
  public function quesdetail($qid)
  {
    $data=array("ques"=>$this->Project_model->getquestion($qid));
    $data["ans"]=$this->Project_model->getanswers($qid);
    $data["no_ans"]=$this->Project_model->getnoanswers($qid);
    if(!$this->issession())
      $data["followed"]=-1;
    else
      $data["followed"]=$this->Project_model->isfollowed($qid,$this->getid());
    $data["tags"]=$this->Project_model->gettagfromques($qid);
    $data["sess"]=$this->issession();
    $this->load->view("Project/quesdetail",$data);
  }
  public function setsession($userid,$name,$pic)
  {
    $this->session->set_userdata('user_id', $userid);
    $this->session->set_userdata('name', $name);
    $this->session->set_userdata('pic', $pic);
  }

  public function getid()
  {
    if($this->issession())
    {
      $userid= $this->session->userdata('user_id');
      return $userid;
    }
    return 0;
  }
  public function followques()
  {
    $qid=$this->input->post('qid');
    if($this->issession())
    {
     $data=array(
      "Id"=> $this->getid(),
      "Q_Id"=>$qid
     );
     $this->Project_model->followques($data);
    }
  }

  public function followuser()
  {
    $uid=$this->input->post('uid');
    if($this->issession())
    {
     $data=array(
      "U1_id"=> $this->getid(),
      "U2_id"=>$uid
     );
     $this->Project_model->followuser($data);

    }
  }
  public function followtag($tid)
  {$tid=$this->input->post('tid');
    if($this->issession())
    {
     $data=array(
      "Id"=> $this->getid(),
      "T_Id"=>$tid
     );
     $this->Project_model->followtag($data);

    }
  }
  public function destroysession()
  {
    $this->load->driver('session');
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('name');
    $this->session->unset_userdata('pic');
    $this->session->sess_destroy();
  }
  public function verify($id,$txt)
  {
    return $this->Emailmodel->verifyEmailAddress($id,$txt);
  }

  function signup()
  {
  				 $config['upload_path']   = './uploads/';
  				 $config['allowed_types'] = 'gif|jpg|png';
  				 $config['max_size']      = 100;
  				 $config['max_width']     = 1024;
  				 $config['max_height']    = 768;
           $options = ['cost' => 12,'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)];
  				 $this->load->library('upload', $config);
  				 if ( !$this->upload->do_upload('Photo')) {
  						$error = array('error' => " Picture was not uploaded Successfully!");
  						$this->load->view('Project/index',$error);
  				 }
  				 else {
  						$data = array('upload_data' => $this->upload->data());
  				 }
  				 $upload_data = $this->upload->data();
  				 $file_name = $upload_data['file_name'];
  				 $data = array(
  					 'Name'    =>  $this->input->post('Name'),
  					 'Email'   =>  $this->input->post('Email'),
  					 'Mobile'  =>  $this->input->post('Mobile'),
  					 'Password'=>  password_hash(md5($this->input->post('Password')), PASSWORD_DEFAULT, $options),
  					 'Photo'   =>  $file_name,
  					 );
  				$sd=$this->Project_model->insertUser($data);
          $data1 = array(
           'Email'   =>  $this->input->post('Email'),
           );
          if($sd==1)
          {
            $nos=rand(10000,99999);
            $id=$this->Project_model->retrieveUser($data1,$this->input->post('Password'));
            if($this->Emailmodel->sendVerificationEmail($this->input->post('Email'),$id['id'],$nos))
            {
              $this->Project_model->updatevc($id['id'],$nos);
              redirect("");
            }
            else
            {
              echo "Verification mail can not be sent";
            }
          }
  }

  public function logout()
  {
    if($this->issession())
    {
      $this->destroysession();
      redirect("");
      return 1;
    }
    return 0;
  }

  public function followers($id)
  {
    $data=array("user" => $this->Project_model->getfollowers($id));
    $data["sess"]=$this->issession();
    $this->load->view("Project/profilefollowersview",$data);
  }

  public function follows($id)
  {
    $data=array("user" => $this->Project_model->getfollows($id));
    $data["sess"]=$this->issession();
    $this->load->view("Project/profilefollowersview",$data);
  }
  public function tags($id)
  {
    $data=array("tag" => $this->Project_model->getinterest($id));
    $data["sess"]=$this->issession();
    $this->load->view("Project/listtags",$data);
  }

  public function quesposted($id)
  {
    $data=array("ques" => $this->Project_model->getquestionposted($id,$this->getid()));
    $data["ans"]=array(0,count($data["ques"]),0);
    $o=0;
    $data["tags"]=array();
    foreach($data["ques"] as $q)
    {
      $data["ans"][$o]=$this->Project_model->getrecentans($q->Q_Id);
      $o=$o+1;
      $data["tags"][$q->Q_Id]=$this->Project_model->gettagfromques($q->Q_Id);
    }
    $data["sess"]=$this->issession();
    $this->load->view("Project/index",$data);
  }


  public function quesfollowing($id)
  {
    $data=array("ques" => $this->Project_model->getquestionfollowing($id,$this->getid()));
    $data["ans"]=array(0,COUNT($data["ques"]),0);
    $o=0;
    $data["tags"]=array();
    foreach($data["ques"] as $b)
    {
      foreach($b as $a)
      {
      $data[]=$this->Project_model->searchresult($a->Q_Id,$this->getid());
      $data["ans"][$o]=$this->Project_model->getrecentans($a->Q_Id);
      $data["tags"][$a->Q_Id]=$this->Project_model->gettagfromques($a->Q_Id);
      $o=$o+1;
    }
    }
    $data["sess"]=$this->issession();
    $this->load->view("Project/searchresult",$data);
  }

  public function email_validate()
  {
    $email = $this->input->post('Email');
    $result = $this->Project_model->validateEmail($email);
  	echo $result;
  }

  public function login()
  {

  		      $this->load->database();
  		      $this->load->model('Project_model');
            $data = array(
            'Email'   =>  $this->input->post('Email'),
            'Verified'=>1
            );
            $id=$this->Project_model->retrieveUser($data,$this->input->post('Password'));
            if(! $id["id"]==0)
            {
              $this->setsession($id["id"],$id["name"],$id["photo"]);
              redirect("");
            }
  }

  public function profileviewload($id)
  {
    $data2=array("obj"=>$this->Project_model->getProfileDetails($id));
    $data2["sess"]=$this->issession();
    $data2["isfollowed"]=-1;
    if($this->issession())
    {
      if($id==$this->getid())
        $data2["isfollowed"]=-1;
      else
        $data2["isfollowed"]=$this->Project_model->isuserfollowed($id,$this->getid());
    }
    $this->load->view("Project/profileview",$data2);
  }

  public function isquesfollowed($qid)
  {
    return $this->Project_model->isquesfollowed($qid,$this->getid());
  }

  public function insertques()
  {
    if($this->issession())
    {
       $data = array(
        'Title'    =>  $this->input->post('Title'),
        'Description'   =>  $this->input->post('Description'),
        'Id'=> $this->getid()
        );

        $idq=$this->Project_model->insertques($data);
        $Tags=array_unique(explode(";",$this->input->post('Tags')));

        foreach($Tags as $a)
        {
           $a=strtolower($a);

           $tid=$this->Project_model->tagexist($a);

           if($tid==0)
           {
             $tid=$this->Project_model->inserttag($a);
           }
           $data=array("Q_Id"=>$idq,"T_Id"=>$tid);
           $this->Project_model->linkques($data);

        }
        echo "true";
    }
    else {
       echo "false";
    }
  }

  public function searchques()
  {
    $ques=$this->input->get('Question');
    $Tokens=explode(" ",$ques);
    $qid=array();
    foreach($Tokens as $a)
    {
      $a=strtolower($a);
      $tid=$this->Project_model->tagexist($a);
      if(! $tid==0)
      {
        $qid2=$this->Project_model->getquesfromtag($tid,$this->getid());
        foreach($qid2 as $ba)
        {
          if(array_key_exists("$ba->Q_Id",$qid))
            $qid[strval($ba->Q_Id)]=$qid[strval($ba->Q_Id)]+1;
          else
            $qid[strval($ba->Q_Id)]=1;
        }
      }
    }
    arsort($qid);
    $qid=array_keys($qid);
    $data=array();
    $data1["ans"]=array(0,COUNT($qid),0);
    $o=0;
    $data1["tags"]=array();
    foreach($qid as $a)
    {
      $data[]=$this->Project_model->searchresult($a,$this->getid());
      $data1["ans"][$o]=$this->Project_model->getrecentans($a);
      $data1["tags"][$a]=$this->Project_model->gettagfromques($a);
      $o=$o+1;
    }
    $data1["ques"]=$data;
    $data1["sess"]=$this->issession();
    $this->load->view("Project/searchresult",$data1);
  }


  public function answer()
  {
    $qid=$this->input->post('qid');
    if($this->issession())
    {
       $ans=$this->input->post('Answer');
       $this->Project_model->answer($this->getid(),$ans,$qid);
       redirect("");
    }
  }

}
?>
