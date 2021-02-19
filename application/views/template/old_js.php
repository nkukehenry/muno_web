

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url() ?>public/jquery/jquery-1.6.4-min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>public/css/jquery-ui/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url() ?>public/jquery/jquery-ui-1.8.16.custom.min.js"></script>

<!-- Color Box -->
<script type="text/javascript" src="<?php echo base_url() ?>public/jquery/plugins/colorbox/jquery.colorbox-min.js"></script>
<link type="text/css" href="<?php echo base_url(); ?>public/jquery/plugins/colorbox/colorbox.css" rel="stylesheet" />

<!-- Table Sorter -->
<link type="text/css" href="<?php echo base_url(); ?>public/css/tablesorter/style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url() ?>public/jquery/plugins/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/jquery/plugins/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/jquery/plugins/jquery.tablesorter.widgets.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $( '.button_edit' ).button({ icons: {primary:'ui-icon-pencil'} });
        $( '.button_add' ).button({ icons: {primary:'ui-icon-plus'} });
        $( '.button_back' ).button({ icons: {primary:'ui-icon-triangle-1-w'} });
        //$( '.tablesorter' ).tablesorter({widgets: ['zebra']}); //make table sortable
        $( '.datepicker' ).datepicker({ dateFormat: 'yy-mm-dd' }); //make datepicker
        //$( '.tablesorter' ).tablesorterPager({container: $(".pager")}); //paginate
    });
</script>