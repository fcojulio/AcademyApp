<?php
	header("Content-type: application/pdf");
	header("Content-Disposition: inline; filename=tickets1.pdf");
	@readfile('./tmp/ticket1.pdf');
?>