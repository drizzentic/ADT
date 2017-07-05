	<table align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td> 
				<form id="migration_frm" action="<?= base_url().'migrate/editt/start_migration';?>" method="POST">
				  	<input type='hidden' name="issubmit" value="1">
					<!-- Tabs -->
			  		<div id="wizard" class="swMain">
			  			<!--Top section-->
			  			<ul>
			  				<li>
				  				<a href="#step-1">
					                <span class="stepNumber">1</span>
					                <span class="stepDesc">
					                   	Source DB<br />
					                   	<small>Fill source database details</small>
					                </span>
				            	</a>
			            	</li>
			  				<li>
				  				<a href="#step-2">
					                <span class="stepNumber">2</span>
					                <span class="stepDesc">
					                   	Target DB<br />
					                   	<small>Fill target database details</small>
					                </span>
				            	</a>
				            </li>
			  				<li>
			  					<a href="#step-3">
					                <span class="stepNumber">3</span>
					                <span class="stepDesc">
					                   	Facility Details<br />
					                   	<small>Fill your facility details</small>
					                </span>
			             		</a>
			             	</li>
			  				<li>
			  					<a href="#step-4">
					                <span class="stepNumber">4</span>
					                <span class="stepDesc">
					                   	Table Details<br />
					                   	<small>Select tables to migrate</small>
					                </span>
					            </a>
					   		</li>
			  			</ul>
				  		<!--source_details-->
				  		<div id="step-1">	
				            <h2 class="StepTitle">Step 1: Source DB Details</h2>
				            <table cellspacing="3" cellpadding="3" align="center">
			          			<tr>
			                    	<td align="center" colspan="3">&nbsp;</td>
			          			</tr>        
			          			<tr>
			                    	<td align="right">Hostname :</td>
			                    	<td align="left">
			                    	 	<input type="text" id="source_hostname" name="source_hostname" value="<?= $source_hostname;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_source_hostname"></span>&nbsp;</td>
			          			</tr>
			          			<tr>
			                    	<td align="right">Port :</td>
			                    	<td align="left">
			                    	 	<input type="text" id="source_port" name="source_port" value="<?= $source_port;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_source_port"></span>&nbsp;</td>
			          			</tr>
				          		<tr>
			                    	<td align="right">User :</td>
			                    	<td align="left">
			                    		<input type="text" id="source_username" name="source_username" value="<?= $source_username;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_source_username"></span>&nbsp;</td>
				          		</tr> 
				                <tr>
			                    	<td align="right">Password :</td>
			                    	<td align="left">
			                    		<input type="password" id="source_password" name="source_password" value="<?= $source_password;?>" class="txtBox">
			                     	 </td>
			                    	<td align="left"><span id="msg_source_password"></span>&nbsp;</td>
			          			</tr>
			          			<tr>
			                    	<td align="right">Database Name :</td>
			                    	<td align="left">
			                    		<input type="text" id="source_database" name="source_database" value="<?= $source_database;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_source_database"></span>&nbsp;</td>
				          		</tr> 
				          		<tr>
			                    	<td align="right">Database Driver :</td>
			                    	<td align="left">
			                    		<input type="text" id="source_driver" name="source_driver" value="<?= $source_driver;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_source_driver"></span>&nbsp;</td>
				          		</tr>                                    			
				  			</table>          			
				        </div>
				        <!--target_db_details-->
				  		<div id="step-2">
				            <h2 class="StepTitle">Step 2: Target DB Details</h2>	
				            <table cellspacing="3" cellpadding="3" align="center">
			          			<tr>
			                    	<td align="center" colspan="3">&nbsp;</td>
			          			</tr>        
			          			<tr>
			                    	<td align="right">Hostname :</td>
			                    	<td align="left">
			                    	 	<input type="text" id="target_hostname" name="target_hostname" value="<?= $target_hostname;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_target_hostname"></span>&nbsp;</td>
			          			</tr>
			          			<tr>
			                    	<td align="right">Port :</td>
			                    	<td align="left">
			                    	 	<input type="text" id="target_port" name="target_port" value="<?= $target_port;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_target_port"></span>&nbsp;</td>
			          			</tr>
				          		<tr>
			                    	<td align="right">User :</td>
			                    	<td align="left">
			                    		<input type="text" id="target_username" name="target_username" value="<?= $target_username;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_target_username"></span>&nbsp;</td>
				          		</tr> 
				                <tr>
			                    	<td align="right">Password :</td>
			                    	<td align="left">
			                    		<input type="password" id="target_password" name="target_password" value="<?= $target_password;?>" class="txtBox">
			                     	 </td>
			                    	<td align="left"><span id="msg_target_password"></span>&nbsp;</td>
			          			</tr>
			          			<tr>
			                    	<td align="right">Database Name :</td>
			                    	<td align="left">
			                    		<input type="text" id="target_database" name="target_database" value="<?= $target_database;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_target_database"></span>&nbsp;</td>
				          		</tr> 
				          		<tr>
			                    	<td align="right">Database Driver :</td>
			                    	<td align="left">
			                    		<input type="text" id="target_driver" name="target_driver" value="<?= $target_driver;?>" class="txtBox">
			                      	</td>
			                    	<td align="left"><span id="msg_target_driver"></span>&nbsp;</td>
				          		</tr>                                    			
				  			</table>         
				        </div>                      
				  		<!--facility_details-->
				  		<div id="step-3">
				            <h2 class="StepTitle">Step 3: Facility Details</h2>	
				            <table cellspacing="3" cellpadding="3" align="center">
				          		<tr>
				                    <td align="center" colspan="3">&nbsp;</td>
				          		</tr>        
				          		<tr>
				                    <td align="right">Facility :</td>
				                    <td align="left">
				                    	<select id="facility" name="facility" class="txtBox">
				                    		<option value="">Select one</option>
				                    	</select>
				                    </td>
				                    <td align="left"><span id="msg_facility"></span>&nbsp;</td>
				          		</tr>
				          		<tr>
				                    <td align="right">Store :</td>
				                    <td align="left">
				                    	<select id="store" name="store" class="txtBox">
				                    		<option value="">Select one</option>
				                    	</select>
				                    </td>
				                    <td align="left"><span id="msg_store"></span>&nbsp;</td>
				          		</tr>          			                                 			
				  			</table>               				          
				        </div>
				  		<!--table_details-->
				  		<div id="step-4">
				            <h2 class="StepTitle">Step 4: Table Details</h2>	
				            <table cellspacing="3" cellpadding="3" align="center" width="90%">      
			          			<tr>
			          				<td align="center">
			          					<table id="migration_tbl" class="display select" cellspacing="0" width="100%">
							              	<thead>
								                <tr>
													<th class="check_all_heading">
														<div class="block">
														   	<input name="select_all" value="1" type="checkbox" class="check_all_input">
															<label>Select All</label>
														</div>
													</th>
													<th>TableName</th>
													<th>Progress</th>
								                </tr>
							              	</thead>
							            </table>
			          				</td>
			                    </tr>                               			
				  			</table>                 			
				        </div>
				  	</div><!-- </tabs>-->  		
				</form> 		
			</td>
		</tr>
	</table>