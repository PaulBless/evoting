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
        Positions
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Positions</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='jq-toast-wrap top-right'>
              <div class='jq-toast-single jq-has-icon jq-icon-info' style='text-align: left; display: none;'><span class='jq-toast-loader jq-toast-loaded' style='-webkit-transition: width 2.6s ease-in; -o-transition: width 2.6s ease-in; transition: width 2.6s ease-in;  background-color: #f0643b;'></span><span class='close-jq-toast-single'>×</span><h2 class='jq-toast-heading'>Error!</h2>
              ".$_SESSION['error']."
              </div>
            </div>
          ";
          unset($_SESSION['error']);
        }

        if(isset($_SESSION['success'])){
          echo "
          <div class='alert alert-success alert-dismissible' style='-webkit-transition: width 2.6s ease-in; -o-transition: width 2.6s ease-in; transition: width 2.6s ease-in; '><span class='jq-toast-loader jq-toast-loaded' style='-webkit-transition: width 2.6s ease-in; -o-transition: width 2.6s ease-in; transition: width 2.6s ease-in;  background-color: #f0643b;'></span>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
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
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Add New Position </a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Description</th>
                  <th>Maximum Vote</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM positions ORDER BY priority ASC";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['description']."</td>
                          <td>".$row['max_vote']."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>
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
  <?php include 'includes/positions_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

<script type="text/javascript">
  $(document).ready(function(){
    $('.add-position').submit(function(e)
    // {
    //   e.preventDefault();
    //   alert('submit');
    //   var data = $(this).serialize();
    //   $.ajax({
    //     url: 'positions_add.php',
    //     method: 'POST',
    //     data: data,
    //     success: function(res){
    //       alert(res);
    //       if(res === "added"){
    //         $.toast({
    //             heading: "Success",
    //             text: "The Position was added successfully!",
    //             position: "top-right",
    //             loaderBg: "#5ba035",
    //             icon: "success",
    //             stack: "1"
    //         });
    //       }else if( res === "failed"){
    //         $.toast({
    //           heading: "Error",
    //           text: "Sorry... connection to server lost, please check!",
    //           position: "top-right",
    //           loaderBg: "#bf441d",
    //           icon: "error",
    //           stack: "1"
    //         });
    //       }else{
    //         $.toast({
    //           heading: "Error",
    //           text: "Sorry... could not process the request!",
    //           position: "top-right",
    //           loaderBg: "#bf441d",
    //           icon: "error",
    //           stack: "1"
    //         });
    //       }
    //     },
    //     error:function(){}
    //   });

    // });

  })
</script>

<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

 

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'positions_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_description').val(response.description);
      $('#edit_max_vote').val(response.max_vote);
      $('.description').html(response.description);
    }
  });
}

</script
</body>
</html>
