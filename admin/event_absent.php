<?php //? ----- Author: Austin Maps ------ ?>
<?php include 'server/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> CKC Event Management System|Event Absent</title>
  	<!-- Tell the browser to be responsive to screen width -->

    <link rel="icon" href="../images/logo.png" sizes="16x16" type="image/png">
    <link rel="stylesheet" type="text/css" href="../dist/table/bootstrap/css/bootstrap.min.css">

  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="../dist/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
 
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="../dist/bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="../dist/dist/css/AdminLTE.min.css">
  	<!-- DataTables -->
    <link rel="stylesheet" href="../dist/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../dist/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../dist/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../dist/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/dist/css/skins/_all-skins.min.css">
  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->

  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'includes/navbar.php'; ?>
      <?php include 'sidebar/absent_sidebar.php'; ?>
    



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   Event Absent
                 
                </h1>
                <ol class="breadcrumb">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="user_account.php"><i class = "fa fa-times"></i>User Account</a></li>

      
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
            <?php  
            if(isset($_GET['delete']) && $_GET['delete'] == 'danger'){
              echo '<div class = "alert alert-danger" style = "font-size:20px;text-align:center;"><strong><i class = "fa fa-trash"></i>  Successfully! Deleted</strong>  </div> ';
            }elseif(isset($_GET['edit']) && $_GET['edit'] == 'success'){
              echo '<div class = "alert alert-success" style = "font-size:20px;text-align:center;"><strong><i class = "fa fa-check"></i> Successfully! Updated</strong></div>';
            }             
            
            ?>


                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                        <div class="box-header">
                        <div class = "col-xs-3">
                        <form action = "print_absent.php" method = "post">
                        <select name = "event_name" class = "form-control" id = "event" required>
                        <option value = "">----Choose Event----</option> 
                        <?php
                        $sql = "SELECT * FROM event";
                        $query = $db->query($sql);
                        while($row = $query->fetch_assoc()){
                          echo "
                          <option value = '".$row['event_id']."'>".$row['title']."</option>
                          ";
                        }
                        ?>
                        </select>
                       
                      
                        </div>
                        <button type = "submit" name = "event" class = "btn btn-success btn-flat"><i class = "fa fa-print"></i></button>
                        </form>
            </div
                            <div class="box-body">
        <table id="example1" class="table table-bordered">
          <thead>
  
      
            <th>Name</th>
            <th>Course&Year</th>
            <th>Event Title</th>
            <th>Event Datetime</th>
     
          </thead>
        
        <?php 
        $sql = "SELECT user_info.fname, user_info.mname, user_info.lname, user_info.course,
         user_info.year_level, event.title, event.Date, event.start_time, event.end_time
         FROM event_absent LEFT JOIN user_info ON user_info.School_ID = event_absent.stud_id
          LEFT JOIN event ON event.event_id = event_absent.event_id";
          $query = $db->query($sql);
          while($row = $query->fetch_assoc()){
               $date = date('F d Y', strtotime($row['Date']));
               $start = date('g:i A', strtotime($row['start_time']));
               $end = date('g:i A', strtotime($row['end_time']));
                 echo "<tr>";           
                  if(empty($row['mname'])){
                    echo "
                    <td>".$row['lname'].', '.$row['fname']."</td>
                    ";
                  }else{
                    echo "
                    <td>".$row['lname'].', '.$row['fname'].' '.$row['mname']. '.'."</td>
                    ";
                  }
                    echo "
                    <td>".$row['course']. '-'.$row['year_level']."</td>
                     <td>".$row['title']."</td>
                    <td>".$date. ' / '.$start. '-'.$end."</td>
                  
                    </tr>
                  
                    ";
                  } 
                  ?>
        </table>                      
                        </div>
                    </div>
                </div>
            </section>
        </div>
      
<?php include 'includes/footer.php'; ?>


<script>
var d = new Date();

document.getElementById("dates").innerHTML = " Capstone Project &copy; "+ d.getFullYear();
</script>


    </div>


    <!-- jQuery 3 -->
    <script src="../dist/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../dist/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../dist/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../dist/plugins/iCheck/icheck.min.js"></script>
    <!-- Moment JS -->
    <script src="../dist/bower_components/moment/moment.js"></script>
    <!-- DataTables -->
    <script src="../dist/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../dist/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- ChartJS -->
    <script src="../dist/bower_components/chart.js/Chart.js"></script>
    <!-- ChartJS Horizontal Bar -->
    <script src="../dist/bower_components/chart.js/Chart.HorizontalBar.js"></script>
    <!-- daterangepicker -->
    <script src="../dist/bower_components/moment/min/moment.min.js"></script>
    <script src="../dist/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../dist/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../dist/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- Slimscroll -->
    <script src="../dist/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../dist/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/dist/js/adminlte.min.js"></script>
    <script>
$(document).ready(function(){
  //inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
      $('.alert').hide();
    })
});
</script>
 <script>
    $(function(){
    	/** add active class and stay opened when selected */
    	var url = window.location;

    	// for sidebar menu entirely but not cover treeview
    	$('ul.sidebar-menu a').filter(function() {
    	    return this.href == url;
    	}).parent().addClass('active');

    	// for treeview
    	$('ul.treeview-menu a').filter(function() {
    	    return this.href == url;
    	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

    });
    </script>
    <!-- Data Table Initialize -->
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
        })
      })
    </script>

<!-- Data Table Initialize -->

    
    
   
    <!-- Date and Timepicker -->
    <script>
    $(function(){
      //Date picker
      $('#datepicker_add').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })
      $('#datepicker_edit').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })
    });
    </script>


    	<script type="text/javascript">
			//modal function
			jQuery(function($) {
				$('.modal.aside').ace_aside();
				$('#aside-inside-modal').addClass('aside').ace_aside({container: '#my-modal > .modal-dialog'});
				$(document).one('ajaxloadstart.page', function(e) {
					$('.modal.aside').remove();
					$(window).off('.aside')
				});
			})

			//alert fucntion
			function onReady(callback) {
            	var intervalID = window.setInterval(checkReady, 1000);

            	function checkReady() {
                	if (document.getElementsByTagName('body')[0] !== undefined) {
                    	window.clearInterval(intervalID);
                    	callback.call(this);
                	}
            	}
        	}

	        function show(id, value) {
	            document.getElementById(id).style.display = value ? 'block' : 'none';
	        }
	        onReady(function() {
	            show('wrapper', true);
	            show('loader', false);
	        });
	        window.setTimeout(function() {
	            $(".alert").fadeTo(500, 0).slideUp(500, function(){
	                $(this).remove(); 
	            });
	        }, 4000);

    
    </script>




<!-- generate datatable on our table -->




</body>

</html>
