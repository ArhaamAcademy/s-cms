<div class="col-md-3 col-sm-3 col-xs-3">

				<!--Category-->
				<h4>Category</h4>
				<ul>
				
				<?php
		
				$statement = $db->prepare("SELECT * FROM tbl_category");
				$statement->execute();
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row){
				
				?>
				
					<li><a href="category.php?id=<?php echo $row['cat_id'];?>"><?php echo $row['cat_name']; ?></a></li>
					
				<?php
				
					}
				?>
				</ul>
                
                <!--Tags-->
				<h4>Tags</h4>
				<ul>
				
				<?php
		
				$statement = $db->prepare("SELECT * FROM tbl_tag");
				$statement->execute();
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row){
				
				?>
				
					<li><a href="tags.php?id=<?php echo $row['tag_id']; ?>"><?php echo $row['tag_name']; ?></a></li>
					
				<?php
				
					}
				?>
				</ul>
                
                <!--Archive-->
				<h4>Archive</h4>
                
                
                <?php
					$j=0;
					$statement = $db->prepare("SELECT distinct(post_date) FROM tbl_post ORDER BY post_date DESC");
					$statement->execute();
					$result = $statement->fetchAll(PDO::FETCH_ASSOC);
					foreach($result as $row){
					
						$ym = substr($row['post_date'],0,7);
						$arr_date[$j] = $ym;
						$j++;
					}
					
					$result = array_unique($arr_date);
					$final_val = implode(",",$result);
					$final_arr_date = explode(",",$final_val);
					$final_arr_date_count = count(explode(",",$final_val));
					
				?>
              
				<ul>
                
                <?php 
					for($j=0;$j<$final_arr_date_count;$j++)
					{
						
						$year = substr($final_arr_date[$j],0,4);
						$month = substr($final_arr_date[$j],5,2);
						
						if($month == '01') {$month_full = "January"; }
						if($month == '02') {$month_full = "February"; }
						if($month == '03') {$month_full = "March"; }
						if($month == '04') {$month_full = "April"; }
						if($month == '05') {$month_full = "May"; }
						if($month == '06') {$month_full = "June"; }
						if($month == '07') {$month_full = "July"; }
						if($month == '08') {$month_full = "August"; }
						if($month == '09') {$month_full = "September"; }
						if($month == '10') {$month_full = "October"; }
						if($month == '11') {$month_full = "November"; }
						if($month == '12') {$month_full = "December"; }
						?>
						<li>
                        	<a href="archive.php?date=<?php echo $final_arr_date[$j]; ?>"><?php echo $month_full.' '.$year; ?>
                            </a>
                        </li>
						<?php
					}
				?>
					
				</ul>
			</div>
		</div>
	</div>	
	<!--Content For Post End-->
	
	<!--Footer-->
    <div class="container-fluid well">
        <div class="row co">
            <div class="col-md-12 text-center">
                <?php
                
                    
                    $statement = $db->prepare("SELECT * FROM tbl_footertext WHERE id=1");
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result as $row){
                        
                        $description = $row['description'];
                    }
                
                
                ?>
            
                    <p><?php echo $description; ?><a href="#">Solutions</a></p>
            </div>
        </div>
    </div>
	<!--Footer End-->
    
    <script type="text/javascript">
    $(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});
	</script>		

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
