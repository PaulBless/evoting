<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Votes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Votes</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#reset" data-toggle="modal" class="btn btn-danger btn-md btn-flat"><i class="fa fa-refresh"></i> Reset</a>
              <!-- <a href="vote_details.php" class="btn btn-info btn-md btn-round pull-right"><i class="fa fa-calculator"></i> Vote Total Counts</a> -->
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Position</th>
                  <th>Candidate</th>
                  <th>Total Votes</th>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM `positions` ORDER BY `priority` ASC";
                  $query = $conn->query($sql);
                  while($row = $query->fetch_assoc()) {
                    $sql = "SELECT * FROM `candidates` WHERE `position_id` = '".$row['id']."'";
                    $cquery = $conn->query($sql);
                    $carray = $position = '';
                    $varray = 0;
                    while($crow = $cquery->fetch_assoc()){
                      $carray = $crow['lastname'].' '.$crow['firstname'];

                      $sql = "SELECT * FROM `votes` WHERE `candidate_id` = '".$crow['id']."'";
                      $vquery = $conn->query($sql);
                      $varray = $vquery->num_rows;
                    }                    
                    
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['description']."</td>
                          <td>".$carray."</td>
                          <td class='text-center'>".$varray."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/votes_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
