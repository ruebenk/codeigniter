<?php
/**
 * Includes the User_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**

 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Project_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/
	private $_id;
	function __construct()
	{
		parent::__construct();
	}

	public function getanswers($qid)
	{
		$sql="SELECT A_id,Q_Id,Answer,Replied_on,Name,Answers.Id FROM `Answers` LEFT JOIN User ON Answers.Id=User.Id WHERE Answers.Q_Id='$qid'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getquestion($qid)
	{
		$query = $this->db->select('*')->from("Questions")->where("Q_Id",$qid)->where("Flag",1)->get();
		return $query->result();
	}

	public function answer($id,$ans,$qid)
	{
		 $data=array(
			 "Id" =>$id,
			 "Q_Id" =>$qid,
			 "Answer"=>$ans
		 );
		 $query=$this->db->insert('Answers', $data);
			 return $this->db->insert_id();
	}

  public function followques($data)
  {
		  $query = $this->db->select('*')->from("Follow_Ques")->where($data)->get();
			if ($query->num_rows() > 0){
				foreach($query->result() as $a)
				{
					if($a->Flag==1)
					{
						$sql="UPDATE Follow_Ques SET Flag=0 WHERE L_QId='$a->L_QId'";
						$query = $this->db->query($sql);
					}
					else {
						$sql="UPDATE Follow_Ques SET Flag=1 WHERE L_QId='$a->L_QId'";
						$query = $this->db->query($sql);
					}
				}
			}
			else {
				$query=$this->db->insert('Follow_Ques', $data);
				return $this->db->insert_id();
			}
  }
	public function followuser($data)
	 {
		$query = $this->db->select('*')->from("Follow_User")->where($data)->get();
		if ($query->num_rows() > 0){
			foreach($query->result() as $a)
			{
				if($a->Flag==1)
				{
					$sql="UPDATE Follow_User SET Flag=0 WHERE L_UId='$a->L_UId'";
					$query = $this->db->query($sql);
				}
				else {
					$sql="UPDATE Follow_User SET Flag=1 WHERE L_UId='$a->L_UId'";
					$query = $this->db->query($sql);
				}
			}
		}
		else {
		$query=$this->db->insert('Follow_User', $data);
		return $this->db->insert_id();
		}
	 }

	public function followtag($data)
	 {
		 $query = $this->db->select('*')->from("Interest")->where($data)->get();
		 if ($query->num_rows() > 0){
			 foreach($query->result() as $a)
			 {
				 if($a->Flag==1)
				 {
					 $sql="UPDATE Interest SET Flag=0 WHERE L_TId='$a->L_TId'";
					 $query = $this->db->query($sql);
				 }
				 else {
					 $sql="UPDATE Interest SET Flag=1 WHERE L_TId='$a->L_TId'";
					 $query = $this->db->query($sql);
				 }
			 }
		 }
		 else {
		 $query=$this->db->insert('Interest', $data);
		 return $this->db->insert_id();
		 }
	 }


  function tagexist($a)
  {
    	 $query = $this->db->select('T_Id')->from("Tags")->where("T_Name",$a)->get();
			 if($query->num_rows()>0)
			 foreach($query->result() as $row)
			 		return $row->T_Id;
			 return 0;
  }

  function linkques($data)
	{
		if($this->db->insert('QuesTag',$data))
			return 1;
		else
			return 0;
	}

	function inserttag($a)
	{
		if($this->db->insert('Tags',array("T_Name"=>$a)))
		return $this->db->insert_id();
	}

	function insertUser($data)
	{
				$email=$data["Email"];
				$name=$data["Name"];
				$mobile=$data["Mobile"];
				$password=$data["Password"];
				$photo=$data["Photo"];
				$query = $this->db->query("SELECT Verified from User WHERE Email='".$email."'");
				foreach ($query->result() as $row){
					if($row->Verified=="0"){
						$this->db->query("UPDATE User Set Name='$name',Mobile='$mobile',Password='$password',Photo='$photo' WHERE Email='".$email."'");
						return 1;
					}
				}
				if($this->db->insert('User', $data))
					return 1;
				else
					return 0;
  }

  function retrieveUser($data,$Password)
	{
        	$query = $this->db->select('*')->from("User")->where($data)->get();
        	if($query->num_rows()>0)
        	{
                  foreach($query->result() as $row)
                  {
										if(password_verify(md5($Password),$row->Password))
										{

											$data = array('id'=>$row->Id,'name'=>$row->Name,'photo'=>$row->Photo);
											return $data;
										}
									}
        	}
          return 0;
  }

	function updatevc($id,$nos)
	{
			$sql= "UPDATE User Set VerificationCode='$nos' WHERE Id='$id'";
			$query = $this->db->query($sql);
	}
	public function getId()
	{
		return $this->_id;
	}

	/**
	* @param int Integer to set this objects ID to
	*/
	public function setId($value)
	{
		$this->_id = $value;
	}

  public function getProfileDetails($id)
  {
    $query = $this->db->select('*')->from("User")->where("Id",$id)->where("Verified",1)->get();
    if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data=array("Id"=>$row->Id,"Name"=>$row->Name,"Email"=>$row->Email,"Mobile"=>$row->Mobile,"pic"=>$row->Photo);
			}
			$query = $this->db->select('*')->from("Follow_User")->where(array("U1_id"=>$id,"Flag"=>1))->get();
			$data["follows"]=$query->num_rows();
			$query = $this->db->select('*')->from("Follow_User")->where(array("U2_id"=>$id,"Flag"=>1))->get();
			$data["followers"]=$query->num_rows();
			$query = $this->db->select('*')->from("Interest")->where(array("Id"=>$id,"Flag"=>1))->get();
			$data["interest"]=$query->num_rows();
			$query = $this->db->select('*')->from("Questions")->where(array("Id"=>$id,"Flag"=>1))->get();
			$data["ques_posted"]=$query->num_rows();
			$query=$this->db->select('*')->from("Follow_Ques")->where(array("Id"=>$id,"Flag"=>1))->get();
			$data["ques_followed"]=$query->num_rows();
			return $data;
    }
  }

	public function insertques($data)
	{

		$query=$this->db->insert('Questions', $data);
		return $this->db->insert_id();
	}
	public function getquestionposted($uid,$id)
	{
		$sql=0;
		if($id!=0)
		{
		$sql="SELECT vs.Q_Id,vs.Title,vs.Description,vs.Posted_on,vs.Id,ans,COUNT(Follow_Ques.L_QId) as ans2 FROM Follow_Ques RIGHT JOIN
	(SELECT d.Q_Id,d.Title,d.Description,d.Posted_on,d.Id,COUNT(Answers.A_id)as ans
	    FROM (SELECT Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,Questions.Id FROM Questions WHERE Questions.Id='$uid' and Questions.Flag=1)as d
	    LEFT JOIN Answers
	    ON d.Q_Id=Answers.Q_Id
	    WHERE Answers.Flag IS NULL OR Answers.Flag=1
	    GROUP BY Q_Id
	    ORDER BY Posted_on DESC)
	    AS vs ON Follow_Ques.Q_Id=vs.Q_Id AND Follow_Ques.Id='$id' AND Follow_Ques.Flag=1 GROUP BY vs.Q_Id";
		//$sql="SELECT vs.Q_Id,vs.Title,vs.Description,vs.Posted_on,vs.Id,ans,COUNT(Follow_Ques.L_QId) as ans2 FROM Follow_Ques RIGHT JOIN (SELECT Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,Questions.Id,COUNT(Answers.A_id)as ans FROM `Questions` LEFT JOIN Answers ON Questions.Q_Id=Answers.Q_Id AND Answers.Flag=1 WHERE Questions.Flag=1 AND Answers.Flag IS NULL OR Answers.Flag=1 GROUP BY Q_Id ORDER BY Posted_on) AS vs ON Follow_Ques.Q_Id=vs.Q_Id AND Follow_Ques.Id='$id' AND Follow_Ques.Flag=1 GROUP BY vs.Q_Id ";
	  }
		else {
			$sql="SELECT d.Q_Id,d.Title,d.Description,d.Posted_on,d.Id,COUNT(Answers.A_id)as ans
			    FROM (SELECT Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,Questions.Id FROM Questions WHERE Questions.Id='$uid' and Questions.Flag=1)as d
			    LEFT JOIN Answers
			    ON d.Q_Id=Answers.Q_Id
			    WHERE Answers.Flag IS NULL OR Answers.Flag=1
			    GROUP BY Q_Id
			    ORDER BY Posted_on DESC";
		}
		$query = $this->db->query($sql);
		$ques=array();
	  if ($query->num_rows() > 0) {
		foreach ($query->result() as $row){
			$ques[]=$row;
		}
	}
	return $ques;
	}
	public function getinterest($id)
	{
		$query = $this->db->select('*')->from("Interest")->where(array("Id"=>$id,"Flag"=>1))->get();
		$interest= array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			     $query1= $this->db->select('*')->from("Tags")->where("T_Id",$row->T_id)->get();
					foreach ($query1->result() as $row1) {
					    $interest[] = $row1;
					}
			}
		}
		return $interest;
	}

	public function getfollowers($id)
	{
		$query = $this->db->select('U1_id')->from("Follow_User")->where(array("U2_id"=>$id,"Flag"=>1))->get();
		$followers = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			    $followers[] = $this->getProfileDetails($row->U1_id);
			}
		}
		return $followers;
	}

	public function getfollows($id)
	{
		$query = $this->db->select('U2_id')->from("Follow_User")->where(array("U1_id"=>$id,"Flag"=>1))->get();
		$follows = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			    $follows[] = $this->getProfileDetails($row->U2_id);
			}
		}
		return $follows;
	}

	public function follow($userid)
	{
		$das=array("U1_id"=>$this->_id,"U2_id"=>$userid);
		$query = $this->db->select('Flag')->from("Follow_User")->where($das)->get();
		$da=array("Flag"=>1);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row){
				if($row->Flag==1)
					echo "already followed";
				else
					$this->db->where($das)->update('Follow_User',$da);
			}
		}
		else
		{
			$data=array("U1_Id"=>$this->_id,"U2_Id"=>$userid,"Flag"=>1);
			$query=$this->db->insert('Follow_User', $data);
		}
	}

	function validateEmail($email)
	{
	  $query = $this->db->query("SELECT Email from User where Email='".$email."' and Verified='1'");
		if($this->db->affected_rows() > 0){
			 return "true";
		}
		else{
			 return "false";
		}
	}
	function validateMobile($mob)
	{
		$query = $this->db->query("SELECT Mobile from User where Mobile='".$mob."' and Verified='1'");
		if($this->db->affected_rows() > 0){
			 return "true";
		}
		else{
			 return "false";
		}
	}
	function validateLogin($email,$pwd)
	{
		$this->db->query("SELECT Email from User where Email='".$email."' ");
		if($this->db->affected_rows() <= 0){
			 return "emaildoesnotexist";
		}
		$this->db->query("SELECT Email from User where Email='".$email."'and Verified='1'");
		if($this->db->affected_rows() <= 0){
			 return "emailisinvalid";
		}
		$query = $this->db->query("SELECT * from User where Email='".$email."' and Verified='1'");
		if($query->num_rows()>0)
		{
						foreach($query->result() as $row)
						{
							if(password_verify(md5($pwd),$row->Password))
							{
									return "true";
							}
						}
		}
		return "invalidpassword";
	}
	public function getquesidfromtag($tagid)
	{
		$sql="SELECT Q_Id from QuesTag Where T_Id='$tagid'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getquesfromtag($tagid,$id)
	{
		if($id!=0)
		{
		$sql="SELECT vs.Q_Id,vs.Title,vs.Description,vs.Posted_on,vs.Id,ans,COUNT(Follow_Ques.L_QId) as ans2 FROM Follow_Ques RIGHT JOIN (SELECT t.Q_Id,t.Title,t.Description,t.Posted_on,t.Id,COUNT(Answers.A_id)as ans FROM (SELECT Questions.Id,Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,Questions.Flag FROM Questions RIGHT JOIN (SELECT QuesTag.Q_Id FROM QuesTag WHERE T_Id='$tagid')as v on Questions.Q_Id=v.Q_Id)as t LEFT JOIN Answers ON t.Q_Id=Answers.Q_Id AND Answers.Flag=1 WHERE t.Flag=1 AND Answers.Flag IS NULL OR Answers.Flag=1 GROUP BY t.Q_Id ORDER BY Posted_on DESC) AS vs ON Follow_Ques.Q_Id=vs.Q_Id AND Follow_Ques.Id='$id' AND Follow_Ques.Flag=1 GROUP BY vs.Q_Id ";
		}
		else {
			$sql="SELECT t.Q_Id,t.Title,t.Description,t.Posted_on,t.Id,COUNT(Answers.A_id)as ans FROM (SELECT Questions.Id,Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,Questions.Flag FROM Questions RIGHT JOIN (SELECT QuesTag.Q_Id FROM QuesTag WHERE T_Id='4')as v on Questions.Q_Id=v.Q_Id)as t LEFT JOIN Answers ON t.Q_Id=Answers.Q_Id AND Answers.Flag=1 WHERE t.Flag=1 AND Answers.Flag IS NULL OR Answers.Flag=1 GROUP BY t.Q_Id ORDER BY Posted_on DESC";
		}
	$query = $this->db->query($sql);
	$ques = array();
	if ($query->num_rows() > 0) {
	foreach ($query->result() as $row) {
	     $ques[]=$row;
	}
	}
	return $ques;
	}

	public function gettagfromques($qid)
	{
		$query = $this->db->select('T_Id')->from("QuesTag")->where("Q_Id",$qid)->get();
		$tag = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
			    $query1 = $this->db->select('*')->from("Tags")->where("T_Id",$row->T_Id)->get();
			    foreach ($query1->result() as $row1)
			    {
			     $tag[]=$row1;
			    }
			}
		}
		return $tag;
	}


	public function unfollow($userid)
	{
	$das=array("U1_id"=>$this->_id,"U2_id"=>$userid);
	$query = $this->db->select('Flag')->from("Follow_User")->where($das)->get();
	$da=array("Flag"=>0);
	if ($query->num_rows() > 0) {
	foreach ($query->result() as $row){
	if($row->Flag==0)
	echo "already unfollowed";
	else
	$this->db->where($das)->update('Follow_User',$da);
	}
	}
	}

	public function searchresult($qid,$id)
	{
		if($id!=0)
		{
		$sql="SELECT vs.Q_Id,vs.Title,vs.Description,vs.Posted_on,vs.Id,ans,COUNT(m.L_QId) as ans2
	FROM
	(
	    SELECT L_QId,Id,Flag,Q_Id FROM Follow_Ques WHERE Follow_Ques.Id='$id' AND Follow_Ques.Q_Id='$qid'
	)AS m
	RIGHT JOIN
	(
	    SELECT ko.Q_Id,ko.Title,ko.Description,ko.Posted_on,ko.Id,COUNT(Answers.A_id)as ans
	    FROM
	    (
	        SELECT Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,Questions.Id FROM Questions WHERE Q_Id='$qid' AND Questions.Flag=1
	    )as ko
	    LEFT JOIN Answers
	    ON ko.Q_Id=Answers.Q_Id
	    WHERE Answers.Flag IS NULL OR Answers.Flag=1
	    GROUP BY Q_Id
	) AS vs
	ON m.Q_Id=vs.Q_Id AND m.Flag=1
	GROUP BY vs.Q_Id ";
		}
		else {
			$sql="SELECT ko.Q_Id,ko.Title,ko.Description,ko.Posted_on,ko.Id,COUNT(Answers.A_id)as ans
	    FROM
	    (
	        SELECT Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,Questions.Id FROM Questions WHERE Q_Id='$qid' AND Questions.Flag=1
	    )as ko
	    LEFT JOIN Answers
	    ON ko.Q_Id=Answers.Q_Id
	    WHERE Answers.Flag IS NULL OR Answers.Flag=1
	    GROUP BY Q_Id";
		}
	$query = $this->db->query($sql);
	$ques = array();
	if ($query->num_rows() > 0) {
	foreach ($query->result() as $row) {
			 $ques[]=$row;
	}
	}
	return $ques;
	}

	public function isquesfollowed($qid,$id)
	{
		$sql="SELECT 'L_QId' FROM Follow_Ques WHERE Q_ID='$qid' AND Id='$id' AND Flag=1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result as $a) {
			return $a->L_QId;
		}
	  }
		else {
			return 0;
		}
	}

  public function getrecentans($qid)
	{
		$sql="SELECT V.A_id,V.Id,V.Q_Id,V.Answer,V.Replied_on,User.Name,User.Photo FROM User RIGHT JOIN (SELECT * FROM `Answers` WHERE Q_Id='$qid' AND Flag=1 ORDER BY Replied_on DESC LIMIT 1)AS V ON User.Id=V.Id";
		$query=$this->db->query($sql);
	  if ($query->num_rows() > 0) {
		foreach ($query->result() as $row){
			return $row;
		}
	}
	return 0;
	}


	public function getquestions($id)
	{
		$sql=0;
		if($id!=0)
		{
		$sql="SELECT vs.Q_Id,vs.Title,vs.Description,vs.Posted_on,vs.Id,ans,
			COUNT(Follow_Ques.L_QId) as ans2 FROM Follow_Ques RIGHT JOIN
			(SELECT Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,
			Questions.Id,COUNT(Answers.A_id)as ans FROM `Questions` LEFT JOIN Answers ON
			Questions.Q_Id=Answers.Q_Id AND Answers.Flag=1 WHERE Questions.Flag=1 AND Answers.Flag
			IS NULL OR Answers.Flag=1 GROUP BY Q_Id) AS vs ON
			Follow_Ques.Q_Id=vs.Q_Id AND Follow_Ques.Id='$id' AND Follow_Ques.Flag=1 GROUP BY
			vs.Q_Id ORDER BY vs.Posted_on DESC";
	  }
		else {
			$sql="SELECT Questions.Q_Id,Questions.Title,Questions.Description,Questions.Posted_on,
			Questions.Id,COUNT(Answers.A_id)as ans FROM `Questions` LEFT JOIN Answers ON
			Questions.Q_Id=Answers.Q_Id AND Answers.Flag=1 WHERE Questions.Flag=1 AND Answers.Flag
			IS NULL OR Answers.Flag=1 GROUP BY Q_Id ORDER BY Posted_on DESC";
		}
		$query = $this->db->query($sql);
		$ques=array();
	  if ($query->num_rows() > 0) {
		foreach ($query->result() as $row){
			$ques[]=$row;
		}
	}
	return $ques;
	}

	public function getquestionfollowing($uid,$id)
	{
		$sql="SELECT Q_Id FROM Follow_Ques WHERE Id='$uid'";
		$query=$this->db->query($sql);
		$data=array();
	  foreach($query->result() as $a)
	  {
	    $data[]=$this->searchresult($a->Q_Id,$id);
	  }
		return $data;
	}

	public function function1()
	{
		$query = "SELECT T_Id as id, T_Name as name from Tags WHERE T_Name LIKE '%o%' ";
		$res = $this->db->query($query)->result_array();
		return $res;
	}

}
