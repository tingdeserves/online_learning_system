


<div class="container">
  <div class="col-12 mt-5 mb-5">
    <h2 class="text-center mt-5 mb-5">search results </h2>
    <!-- test -->
    <!--<h3 id="test1" style="color:red"><?php //print_r( $data); ?></h3>
    <h3 id="test2" style="color:red"></h3>-->
    <!-- test end -->
    <div class="bd-example-snippet bd-code-snippet"><div class="bd-example">
        <table class="table table-striped" id="courses-table">
          <thead>
          <tr class="table-primary">
            <th scope="col">Id</th>
            <th scope="col">Course name</th>

          </tr>
          </thead>
          <tbody>

          <!--<tr>
            <th scope="row">1</th>  
            <td><a href="#">infs7202</a></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td><a href="#">infs3202</a></td>
          </tr>-->

          </tbody>
        </table>
    </div></div>
</div>
</div>


<script>
  // Get the data passed from the PHP controller
  <?php if (isset($data) && isset($data[0]) &&isset($data[0]["course_id"])) { ?>
  //document.getElementById("test2").innerHTML= "good";  //test
  var data = <?php echo json_encode($data); ?>;
    //console.log('data:', data);   //test
    //document.getElementById("test2").innerHTML= data[0].course_id;   //test
<?php } else{?>
    //document.getElementById("test2").innerHTML= "no data";  //test
    <?php }?>
  //forEach loop each item
  data.forEach(function(item) {
    // create tr
    var row = document.createElement('tr');

    // create th
    var idCell = document.createElement('th');
    idCell.innerHTML = item.course_id;

    // create td and a
    var nameCell = document.createElement('td');
    var a_tag=document.createElement('a');
    a_tag.innerHTML = item.course_name;
    a_tag.href="<?php echo base_url()."course_detail/" ?>" + item.course_id;

    // structure - append th td and a in tr
    row.appendChild(idCell);
    row.appendChild(nameCell);
    nameCell.appendChild(a_tag);

    // append the tr to the end of the table
    document.querySelector('#courses-table tbody').appendChild(row);
  });

</script>