<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="dashboard.php">qPulse</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="dashboard.php">Dashboard&nbsp;<span class="badge" id="openjobsbadgewidget"></span></a></li>
				<li><a href="jobs.php">Jobs</a></li>
				<li><a href="pois.php">Persons Of Interest</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Enforcement<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="fines.php">Fines</a></li>
						<li><a href="warrants.php">Warrants</a></li>
						<li><a href="arrests.php">Arrests</a></li>
					</ul>
				</li>
				<li><a href="officers.php">Officers</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Regional Operations<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="job_codes.php">Job Codes</a></li>
						<li><a href="stations.php">Stations</a></li>
						<li><a href="offences.php">Offences</a></li>
					</ul>
				</li>
				<li><a href="../controller/logout_process.php">Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
