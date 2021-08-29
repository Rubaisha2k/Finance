<!doctype html>
<html lang="en">
  <head>
    <title>Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        .main-heading{
            width: 100%;
            height: auto;
            text-align: center;
        }
        .journal-entries{
            margin-left : 15%;
            width: 100%;
            height: auto;
        }
    </style>
    <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
 
  </head>

  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script  src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <div class="container-fluid">
        <div class="row">
            <h3 class="alert alert-warning main-heading">Welcome to Financial Accounting</h3>
        </div>
        <div class="row">
            <div class="col-7" style="margin-left: 14%; margin-bottom: 20px;">
                <button class="btn btn-secondary"><a style="color: white" href="<?php echo base_url().'trialBal'?>" target="_blank">Create Trial Balance</a></button>
                <button class="btn btn-danger"><a style="color: white" href="<?php echo base_url().'financialStatements'?>" target="_blank">Financial Statements</a></button>
                <button class="btn btn-success" data-toggle="modal" data-target = "#closingEntry">Closing Entries</button>
                <button class="btn btn-info"><a style="color: white" href="<?php echo base_url().'postClosingTrial' ?>">Post Closing Trial Balance</a></button>
            </div>
            <div class="journal-entries">
            <?php if($this->session->flashdata('response')) :?>
            <h5 class="alert alert-success"><?php echo $this->session->flashdata('response');?></h5>

            <?php endif; ?>
                <h4 class="alert alert-warning">Journal Entries</h4>
                <table class="table table-striped" id="main_table">
                    <tr>
                    <th>Date</th>
                    <th>Entries</th>
                    <th>Debit</th>
                    <th>Credit</th>
    </tr>
                <?php 
                    if($data == null){
                        ?>
                        <tr><td colspan="4" style="text-align: center;"> No data present</td></tr>
                        <?php
                    }
                    else{
                        $j = 0;
                        foreach($data as $d){
                        ?>
                            <tr>
                            <td><?php echo $d['entry_date']?></td>
                            <td><?php 
                            foreach(json_decode($d['debit_info']) as $info){
                                echo $info.'<br>';
                            }
                            ?> <br> &nbsp &nbsp &nbsp
                            <?php foreach(json_decode($d['credit_info']) as $info){
                                echo $info.'<br>';
                            }?> <br><strong>
                            <?php echo '(' ; print_r($data[$j]['description']); echo ")"?></strong></td>
                            <td><?php foreach(json_decode($d['debit_amount']) as $amount){
                                echo $amount.'<br>';
                            }?></td>
                            <td><br><br><?php foreach(json_decode($d['credit_amount']) as $amount){
                                echo $amount.'<br>';
                            }?></td>
                            </tr>
                        <?php
                        $j++;
                        }
                    }
                ?>
                </table>
                <div class="row">
                 <form class="form-group" id="entries" method="POST" > 
                    <label>Add one entry at a time.</label>
                    <table class="table" id="mytable">
                        <tr><th>Date</th>
                        <th>Entries</th>
                        <th>Debit</th>
                        <th>Credit</th><th>Type</th></tr>
                        <tr><td><input type="date" name="date" class="form-control" placeholder="Enter Date"></td>
                        <td><input style="text-transform:capitalize" type="text" name="d_info[]" class="form-control" placeholder="Enter Debitted Info"></td>
                        <td><input type="text" name="d_amount[]" class="form-control" placeholder="Enter Debitted Amount"></td>
                        <td></td>
                        <td><select selected id="typeD" class="form-control" placeholder="Select Type">
                            <?php
                            foreach($type as $t){?>
                            <option class="form-control" value="<?php echo $t["type_id"]?>"><?php echo($t['type_name'])?>
                            <?php
                            } 
                            ?>
                        </select>       
                        </td> 
                        <td><button class="btn btn-primary" id="debit_add"><i class="fa fa-book"></i>Add To Debit</button></td>
                        <tr class="add_debit"></tr>
                        <tr><td></td>
                        <td><input style="text-transform:capitalize" type="text" class="form-control" name="c_info[]" placeholder="Enter Creditted Info"></td>
                        <td></td>
                        <td><input type="text" name="c_amount[]" class="form-control" placeholder="Enter Creditted Amount"></td>
                        <td><select selected id="typeC" class="form-control" placeholder="Select Type">
                            <?php
                            foreach($type as $t){?>
                            <option value="<?php echo $t["type_id"]?>"><?php echo($t['type_name'])?>
                            <?php
                            } 
                            ?>
                        </select>       
                        </td>
                        <td><button class="btn btn-primary" id="credit_add"><i class="fa fa-book"></i>Add To Credit</button></td>
                        <tr class="add_credit"></tr>
                        <tr>
                        <td colspan="4"><input type="text" id="desc" name="desc" class="form-control" placeholder="Enter Description"></td>
                        <td  style="text-align: right">
                        <button class="btn btn-warning" id="submit" type="submit">Enter Data</button></td>
                        </tr>
                    </table>
                    <?php if($this->session->flashdata('error')) :?>
            <h5 class="alert alert-danger error"><?php echo $this->session->flashdata('error');?></h5>
                        <?php endif; ?>
            </form>
    </div>

    </div>
    </div>
    </div>
    <?php 
            $totalRevs = 0;
            $totalExp = 0;
            $incomeSummary = 0;
          ?>
    <div id="closingEntry" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Closing Entry Journal Entry</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <table class="table" id="mytable">
        <tr><th>Date</th>
        <th>Entries</th>
        <th>Debit</th>
        <th>Credit</th></tr>
        <tr>
            <td><?php echo date('t-m-Y')?></td>
            <td><?php
            for($i = 0; $i< count($revenues); $i++){
                $revs = json_decode($revenues[$i]);
                echo $revs->account.'<br>'?>
        <?php }
            ?>
            &nbsp &nbsp &nbsp Income Summary 
            </td>
            <td><?php
            for($i = 0; $i< count($revenues); $i++){
                $revs = json_decode($revenues[$i]);
                echo $revs->value. '<br>';
                $totalRevs += $revs->value; ?>
        <?php }
            ?>
            </td>
            <td><?php foreach($revenues as $r){
                echo '<br>';
            } echo $totalRevs?></td>
        </tr>
        <tr>
        <tr>
            <td><?php echo date('t-m-Y')?></td>
            <td>Clo. Income Summary <br>
            <?php
            for($i = 0; $i< count($expenses); $i++){ ?>
                &nbsp &nbsp &nbsp
                <?php $exps = json_decode($expenses[$i]);
                echo $exps->account.'<br>'?>
        <?php }
            ?>
            </td>
            <td><?php
            for($i = 0; $i< count($expenses); $i++){
                $exps = json_decode($expenses[$i]);
                $totalExp += $exps->value;
             }
                 echo $totalExp ?></td>
            <td>
            <?php

            for($i = 0; $i< count($expenses); $i++){?>
            &nbsp &nbsp &nbsp
            <?php
                $exps = json_decode($expenses[$i]);
                echo '<br>'. $exps->value?>
        <?php }
        $incomeSummary = $totalRevs - $totalExp ;
            ?>
            </td>
        </tr>
        <tr>
            <td><?php echo date('t-m-Y')?></td>
            <td>Clo. Income Summary
                <br> &nbsp &nbsp &nbsp Owner Equity
            </td>
            <td><?php echo $incomeSummary?></td>
            <td><br> <?php echo $incomeSummary?></td>
        </tr>
        <tr>
            <?php 
            $withdrawAmount = 0;
            if(empty($withdraws)){

            }
            else{
            ?>
            <td><?php echo date('t-m-Y')?></td>
            <td>
            Owner Equity <br> &nbsp &nbsp &nbsp    
            <?php 
            foreach($withdraws as $w){
                $withdraw = json_decode($w);
                echo $withdraw->account;
            }
            ?></td>
            <td>
                <?php
                $withdraw = json_decode($withdraws[0]);
                echo $withdraw->value;
                $withdrawAmount = $withdraw->value;
                ?>
            </td>
            <td> <br>
                <?php
                $withdraw = json_decode($withdraws[0]);
                echo $withdraw->value;
                ?>
            </td>
        </tr>
        <?php }?>
        </table><?php
        $oe = $incomeSummary - $withdrawAmount;
        if($oe < 0){
            $oe = $oe*(-1);
        }
        ?>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>
    <script>
    $("#debit_add").click(function (e) {
        e.preventDefault();
        e.stopPropagation();
    var newrow = '<tr class="add_debit">\
            <td></td><td><input style="text-transform:capitalize" type="text" name="d_info[]" class="form-control" placeholder="Enter Debitted Info"></td>\
            <td><input type="text"name="d_amount[]" class="form-control" placeholder="Enter Debitted Amount"></td>\
            <td></td>\
            </tr>';
    
    $(newrow).insertAfter($('table tr.add_debit:last'));

    });
    $("#credit_add").click(function (e) {
        e.preventDefault();
        e.stopPropagation();
    var newrow = '<tr class="add_credit">\
            <td></td><td><input style="text-transform:capitalize" type="text" name="c_info[]" class="form-control" placeholder="Enter Creditted Info"></td>\
            <td></td>\
            <td><input type="text" name="c_amount[]" class="form-control" placeholder="Enter Creditted Amount"></td>\
            <td></td>\
            </tr>';
    $(newrow).insertAfter($('table tr.add_credit:last'));
});
$("#entries").on('submit', function(e){
    var debit_info = $("input[name='d_info[]']")
              .map(function(){return $(this).val();}).get();
    var credit_info = $("input[name='c_info[]']")
              .map(function(){return $(this).val();}).get();
    var debit_amount = $("input[name='d_amount[]']")
              .map(function(){return $(this).val();}).get();
    var credit_amount = $("input[name='c_amount[]']")
              .map(function(){return $(this).val();}).get();
    // e.preventDefault();
    // e.stopPropagation();
    $.ajax({
        url: "<?php echo base_url()?>dashboard",
        method : "POST",
        data : {"date": $("input[type='date']").val() ,"debit" : debit_info , "credit" : credit_info, "debit_amount" :debit_amount ,"credit_amount":credit_amount, "typeD" : $('#typeD').val(), "typeC" : $('#typeC').val(), "desc" : $("input[name='desc']").val()},
        dataType : "json",
        success : function(response){
            console.log(response)
        } 
           })
});
     </script>
  </body>
</html>