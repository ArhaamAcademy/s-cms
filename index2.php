<?php

if(!isset($_REQUEST['id'])){
	header ("location: index.php");
}
else {
	
	$id = $_REQUEST['id'];	
}

include ("config.php");

?>
<?php 

if(isset($_POST['form1'])){
	
	try{
		
		if(empty($_POST['c_message'])){
		
			throw new Exception("Message cannot be empty");	
			
		}
		
		if(empty($_POST['c_name'])){
		
			throw new Exception("Name cannot be empty");	
			
		}
		
		if(empty($_POST['c_email'])){
		
			throw new Exception("Email cannot be empty");	
			
		}
		
		if(!(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['c_email']))) {
			throw new Exception("Please enter a valid email address.");
		}
		
		if(empty($_POST['c_message'])){
		
			throw new Exception("Message cannot be empty");	
			
		}
		
		$c_date = date('Y-m-d');
		$active = 0;
		
		$statement = $db->prepare("INSERT INTO tbl_comment (c_message, c_name, c_email, c_url, c_date, post_id, active) VALUES(?,?,?,?,?,?,?)");
		$statement->execute(array($_POST['c_message'],$_POST['c_name'],$_POST['c_email'],$_POST['c_url'],$c_date,$id,$active));

		
		$success_message = "Your comment has been sent. It'll be published after admin approoved...!";
		
	}
	catch(Exception $e){
	
		$error_message = $e->getMessage();	
		
	}
		
}

?>
<?php include("header.php"); ?>

<div class="col-md-9 col-sm-9 col-xs-9" style="border-right:1px dotted #ddd">
  <h4>Details Post</h4>
  <hr>
  <?php
				
				$statement = $db->prepare("SELECT * FROM tbl_post WHERE post_id=?");
				$statement->execute(array($_REQUEST['id']));
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row){
				
				?>
  <h3><?php echo $row['post_title']; ?></h3>
  
  <!--Showing date--> 
  <span class="text-danger">
  <?php
  	$post_date = $row['post_date'];
	$day = substr($post_date,8,2);
	$month = substr($post_date,5,2);
	
	if($month == '01') {$month = "Jan"; }
	if($month == '02') {$month = "Feb"; }
	if($month == '03') {$month = "Mar"; }
	if($month == '04') {$month = "Apr"; }
	if($month == '05') {$month = "May"; }
	if($month == '06') {$month = "Jun"; }
	if($month == '07') {$month = "Jul"; }
	if($month == '08') {$month = "Aug"; }
	if($month == '09') {$month = "Sep"; }
	if($month == '10') {$month = "Oct"; }
	if($month == '11') {$month = "Nov"; }
	if($month == '12') {$month = "Dec"; }
	
	echo $day.' '.$month;
  ?>
  </span> <span class="text-muted">&nbsp;Tags:&nbsp;
  <?php
		$arr = explode(",",$row['tag_id']);
		$count_arr = count(explode(",",$row['tag_id']));
		$k=0;
		for($j=0;$j<$count_arr;$j++)
		{
			
			$statement1 = $db->prepare("SELECT * FROM tbl_tag WHERE tag_id=?");
			$statement1->execute(array($arr[$j]));
			$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
			foreach($result1 as $row1)
			{
				$arr1[$k] = $row1['tag_name'];
			}
			$k++;
		}
		$tag_names = implode(",",$arr1);
		echo $tag_names;
	?>
  </span>
  <p></p>
  <a class="fancybox-effects-a" href="uploads/<?php echo $row['post_image']; ?>" title="<?php echo $row['post_title']; ?>"> <img src="uploads/<?php echo $row['post_image']; ?>" alt="" width="300" style="float:left; margin-right:15px;"/> </a> <?php echo $row['post_description']; ?>
  <?php
				}
				?>
  <div class="row">
    <div class="col-md-12">
      <h4>User Comments</h4>
      <hr/>
    </div>
  </div>
  <?php 
    
    
				$statement = $db->prepare("SELECT * FROM tbl_comment WHERE active=1 AND post_id=?");
				$statement->execute(array($id));
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row){
				?>
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-2"> 
        
        <!--Graving Image from Gravatar-->
        <?php

								$gravatarMD5 = md5($row['c_email']);
								//$gravatarMD5 = ""; | // when no gravatar is found
						
							?>
        <img src = "http://www.gravatar.com/avatar/<?php echo $gravatarMD5?>" alt = "" width = "80" height="80px"> 
        <!--Graving Image end--> 
        
        <!--<img src="images/3569.jpg" alt="Graveter Image" width="80px" height="80px" />-->
        <p class="text-danger"><?php 
								if(empty($row['c_url']))
								{
								echo $row['c_name'];
								}
								else
								{
									echo "<a href='".$row['c_url']."' target='_blank'>";
									echo $row['c_name'];
									echo "</a>";	
								}
								
								?></p>
        <?php 
							$c_year = substr($row['c_date'],0,4);
							$c_month = substr($row['c_date'],5,2);
							$c_day = substr($row['c_date'],8,2);
							
							
							if($c_month == '01') { $c_month = "Jan"; }
							if($c_month == '02') { $c_month = "Feb"; }
							if($c_month == '03') { $c_month = "Mar"; }
							if($c_month == '04') { $c_month = "Apr"; }
							if($c_month == '05') { $c_month = "May"; }
							if($c_month == '06') { $c_month = "Jun"; }
							if($c_month == '07') { $c_month = "Jul"; }
							if($c_month == '08') { $c_month = "Aug"; }
							if($c_month == '09') { $c_month = "Sep"; }
							if($c_month == '10') { $c_month = "Oct"; }
							if($c_month == '11') { $c_month = "Nov"; }
							if($c_month == '12') { $c_month = "Dec"; }
							
							?>
        <p class="text-muted"><?php echo $c_day." ".$c_month.", ".$c_year; ?></p>
      </div>
      <div class="col-md-10">
        <p><?php echo $row['c_message']?></p>
      </div>
      <hr/>
    </div>
  </div>
  <?php	
                
            }
   
    ?>
  
  <!--Add your comments-->
  <div class="row">
    <div class="col-md-12">
      <h4>Add Your Comments</h4>
      <hr/>
    </div>
  </div>
  
  <!--Comment Form-->
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-2"> <img src="images/3569.jpg" alt="Graveter Image" width="80px" height="80px" />
        <p class="text-danger">Name User</p>
        <p class="text-muted">April 12</p>
      </div>
      <div class="col-md-10">
        <?php 
						if(isset($error_message)){
							echo "<div class='text-danger message'>".$error_message."</div>";
						}
						
						if(isset($success_message)){
							echo "<div class='text-success message'>".$success_message."</div>";
						}
					?>
        <form class="col-md-12" action="" method="post" enctype="multipart/form-data">
          <br>
          <textarea class="ckeditor form-control" name="c_message" cols="10" rows="4" placeholder="Your Message" ></textarea>
          <br/>
          <input type="text" class="form-control" name="c_name" placeholder="Name"/>
          <br/>
          <input type="text" class="form-control" name="c_email" placeholder="Email"/>
          <br/>
          <input type="text" class="form-control" name="c_url" placeholder="URL (Optional)"/>
          <br/>
          <input type="submit" class="btn btn-success" value="Add Comment" name="form1"/>
        </form>
      </div>
    </div>
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
<?php include("footer.php"); ?>
