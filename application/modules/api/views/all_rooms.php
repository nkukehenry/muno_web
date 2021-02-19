<?php

$rooms= Modules::run("rooms/getAll");

//print_r($rooms);

?>

  <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Rooms List</h5>
                   
                    </div>
                    <div class="ibox-content">

                          <div class="">
            <a  href="javascript:void(0);" class="btn btn-primary ">Add a room</a>
            </div>

                    <table class="table table-striped table-bordered table-hover dataTable" >
                    <thead>
                 
                    <tr>
                    	<th>#</th>
                        <th>Room</th>
                        <th>Building</th>
                        <th width=20%></th>
                    </tr>
                </thead>

                <tbody>

                	<?php
                	$no=1; 
                	foreach($rooms as  $room): ?>

                    <tr>
                    	<td><?php echo $no; ?></td>
                        <td><?php echo $room->room_name; ?></td>
                        <td><?php echo $room->building_name; ?></td>
                        	<td>
                        		<a href="" data-toggle="modal" data-target="#details<?php echo $room->room_id; ?>"><i class="fa fa-eye"></i> Edit</a>

                        		|

                        		<a href="" data-toggle="modal" data-target="" class="text-danger"><i class="fa fa-trash"></i> Delete</a>
                        		

                        	</td>
                    </tr>

                <?php 
                  $no++;
                  include("details_modal.php");
                endforeach; 
                ?>

             </tbody>  

             <tfoot>
             	


             </tfoot>
                   
                    </table>

                    </div>
                </div>
            </div>
            </div>