 
 	<?php if($error_msg) {  ?>
		<div class='error justify-content-center mx-auto'>
			 <div class='error_msg justify-content-center mx-auto'>
				<?php
					foreach ($error_msg as $error) {
						echo $error . NEWLINE;
					 }
				?>
			</div>
		</div>
	<?php  } ?>
	
    <?php if($query_msg) {  ?>
    <div class='query justify-content-center mx-auto'>
         <div class='query_msg justify-content-center mx-auto'>
            <?php
                foreach ($query_msg as $query) {
                    echo $query . NEWLINE;
                 }
            ?>
        </div>
    </div>
	<?php } ?>