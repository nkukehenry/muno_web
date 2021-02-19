	
		<div class="card">
		<div class="content">
		<div class="contentBody w500">
			<!-- <div class="contentTitle">Loan Result</div> -->
			<div class="clearFix"></div>
	        <div class="midcontentBody">
	        	<?php echo $result; ?>
	        </div>
	        <div class="clearFix"></div>

	        <?php 
        		if($request->status=="0"): ?>
	        	<div class="row pt-2">
		            <div class="col-md-3 offset-9">
		        	   <form method="post" action="<?php echo base_url(); ?>borrower/approval">
			               <input type="hidden" name="id" value="<?php echo $request->id; ?>">
			                <button class="btn btn-primary" name="submit_borrower" type="submit">Approve Request <button>
		              </form>
		            </div>
	            </div>

	          <?php endif ?>
		</div>
		</div>
		</div>
	