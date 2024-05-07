<div class="modal fade" id="batch">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<span class="fa fa-dashcube"></span> Manage Batches
				</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-content container">
				<div class="row">
					<div class="col-md-6">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
							<div class="form-group">
								<label>Enter Batch Name</label>
								<input type="text" name="batch" class="form-control">
							</div>
							<div class="form-group">
								<label>Enter Batch Year</label>
								<input type="text" name="year" class="form-control">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-info" name="makeBatch"><span class="fa fa-plus"></span> Add Batch</button>
							</div>
						</form>
					</div>
					<div class="col-md-6 mt-4">
						<table class="table table-dark table-striped">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Year</th>
								<th>Delete Batch</th>
							</tr>
							<?php
							$X = 0;
									display_batch("batch");
									while($row = $query->fetch_assoc()):
										$X += 1;
								?>
							<tr>
								<td><?php echo $X; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['year']; ?></td>
								<td><a href="<?php echo $_SERVER['PHP_SELF'] ?>?del_id=<?php echo $row['id'] ?>" class = "text-white">
								<span class="fa fa-trash"></span> Delete
								</a></td>
								
								
							</tr>
							<?php endwhile; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade " id="makeUser">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<span class="fa fa-user-plus"></span> Add Corp Members
				</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Full Name</label>
						<input type="text" name="fullname" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email Address</label>
						<input type="text" name="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Gender</label>
						<select name="gender" class="form-control">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>

					<div class="form-group">
						<label>Batch</label>
						<select class="form-control" name="batch">
							<?php
								display_batch("batch");
								while($row = $query->fetch_assoc()):
							?>
							<option value="<?php echo $row['name'] ?>"><?php echo $row['name']; ?></option>
							<?php
								endwhile;
							?>
						</select>
					</div>

					<div class="form-group">
						<label>State of Origin</label>
						<select id="states" class="form-control" name="state"></select>
						<label>LGA of Origin</label>
						<select id="lgas" class="form-control" name="lga"></select>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" name="cpassword" class="form-control" required>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" name="create_user" class="btn btn-primary btn-block">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="group">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<span class="fa fa-dashcube"></span> Manage CDS Groups
				</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-content container">
				<div class="row">
					<div class="col-md-6">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
							<div class="form-group">
								<label>Enter Group Name</label>
								<input type="text" name="group" class="form-control">
							</div>
							<!-- <div class="form-group">
								<label>Enter Batch Year</label>
								<input type="text" name="year" class="form-control">
							</div> -->
							<div class="form-group">
								<button type="submit" class="btn btn-info" name="makeGroup"><span class="fa fa-plus"></span> Add Group</button>
							</div>
						</form>
					</div>
					<div class="col-md-6 mt-4">
						<table class="table table-dark table-striped">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Delete Group</th>
							</tr>
							<?php
							$X = 0;
									display_batch("groups");
									while($row = $query->fetch_assoc()):
										$X += 1;
								?>
							<tr>
								<td><?php echo $X; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><a href="<?php echo $_SERVER['PHP_SELF'] ?>?del_group_id=<?php echo $row['id'] ?>" class = "text-white">
								<span class="fa fa-trash"></span> Delete
								</a></td>
								
								
							</tr>
							<?php endwhile; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>