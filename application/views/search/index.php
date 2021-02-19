		<div class="clearFix"></div>
		<div class="contentBody">
		
	        <div class="rightcontentBody">
    			<?php 
    				if (isset($_GET['s']) AND trim($_GET['s']) != '') {
    					if (is_numeric($_GET['s'])) {
							$loans = $this->Search_model->search(array('lend_borrower_loans.id' => $_GET['s']));
    					} else {
	    					$loans = $this->Search_model->search("concat(lend_borrower.fname,' ',lend_borrower.lname) LIKE \"%".$_GET['s']."%\"");
    					}
    				}
				?>
				
				
				<div class="frm_container">
	        		<div class="frm_heading"><span>Search Result</span></div>
	        		<div class="frm_inputs">
	        			<?php if (@$loans) : ?>
	        			<table class="search" cellspacing="1">
			        		<thead>
			        			<tr>
			        				<th>Loan #</th>
			        				<th>Loan Type</th>
			        				<th>Status</th>
			        				<th>Borrower</th>
			        				<th>Total Loan</th>
			        			</tr>
			        		</thead>
			        		<tbody>
			        			<?php foreach ($loans->result() as $loan) :?>
			        			<tr>
			        				<td><a href="<?php echo base_url(); ?>loan/view_info/?id=<?php echo $loan->borrower_loan_id;?>"><?php echo $loan->borrower_loan_id; ?></a></td>
			        				<td><?php echo $loan->loan_name; ?></td>
			        				<td><?php echo $loan->status; ?></td>
			        				<td><a href="<?php echo base_url(); ?>borrower/view/?id=<?php echo $loan->fborrower_id;?>"><?php echo $loan->lname.', '.$loan->fname; ?></a></td>
			        				<td><?php echo $this->config->item('currency_symbol') . number_format($loan->loan_amount_total, 2, '.', ','); ?></td>
			        			</tr>
			        			<?php endforeach; ?>
			        		</tbody>
			        	</table>
			        	<!-- pager -->
						<div class='search_pager'>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/first.png' class='first'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/prev.png' class='prev'/>
						    <span class='pagedisplay'></span> <!-- this can be any element, including an input -->
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/next.png' class='next'/>
						    <img src='<?php echo base_url(); ?>public/css/tablesorter/last.png' class='last'/>
						    <select class='pagesize'>
						        <option value='20'>20</option>
						        <option value='30'>30</option>
						        <option value='40'>40</option>
						    </select>
						</div>
			        	<?php else : ?>
			        	No record found. Please try again
			        	<?php endif; ?>
	        		</div>
	        	</div>
	        	
	        </div>
	        <div class="clearFix"></div>
		</div>
		<script type='text/javascript'>
			$('.search').tablesorter()
				.tablesorterPager({
				    container: $('.search_pager'),
				    updateArrows: true,
				    page: 0,
				    size: 20,
				    fixedHeight: false,
				    removeRows: false,
				    cssNext: '.next',
				    cssPrev: '.prev',
				    cssFirst: '.first',
				    cssLast: '.last',
				    cssPageDisplay: '.pagedisplay',
				    cssPageSize: '.pagesize',
				    cssDisabled: 'disabled'
			});
		</script>