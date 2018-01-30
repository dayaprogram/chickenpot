<?php 
?>

<div id="content">
    <div class="inner" style="min-height: 700px;">
        <div class="row">
            <div class="col-lg-12">
                <h1> Profit Analytics </h1>
            </div>
        </div>
        <hr />

        
        <!--BLOCK SECTION -->
        <div class="row">
            <div class="col-lg-12">
                <div style="text-align: center;"> 
                    <a class="quick-btn" href="javascript:void(0)"> <i class="fa fa-shopping-cart" aria-hidden="true" ></i> <span> Sales </span> 
                        <span class="label label-success"><?php echo $sum;?></span>  </a>
                     
<!--                    <a class="quick-btn" href="<?php echo $this->Url->build(["controller" => "Treatments", "action" => "index"]); ?>"> <i class="fa fa-stethoscope" style="font-size:30px;"></i> <span> Treatments </span> 
                        <span class="label label-success">456</span> </a> 
                    <a class="quick-btn" href="<?php echo $this->Url->build(["controller" => "Medicines", "action" => "index"]); ?>"> <i class="fa fa-medkit" style="font-size:30px;"></i> <span> Medicine </span>  
                        <span class="label label-success">456</span> </a> -->

                        
            </div>
        </div>
        </div>     
            
        <!--END BLOCK SECTION -->        
        
        <hr />
        
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
<!--                    <header>
                        <h5>Simple Table</h5>
                        <div class="toolbar">
                            <div class="btn-group"> 
                                <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm accordion-toggle minimize-box"> 
                                <i class="icon-chevron-up"></i> </a> </div>
                        </div>
                    </header>-->
                    <div >
                          <form class="form-inline" id='ChartForm'>
                            <div class="form-group">
                              <label for="email"></label>
                              <select name="type" class="form-control" id='type' onchange="generate_chart();">
                                  <option value="daily">Daily</option>    
                                  <option value="monthly">Monthly</option> 
                                  <option value="yearly">Yearly</option>    
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="pwd">Start Date:</label>
                              <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo gmdate('01/m/Y'); ?>">
                            </div>
                            <div class="form-group">
                              <label for="pwd">End Date:</label>
                              <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo gmdate('d/m/Y'); ?>">
                            </div>
                              <button type="button" onclick="generate_chart()" class="btn btn-default" style=" margin-top:26px;">Search</button>   
  
                        </form>
                    </div>
                </div>
               
            </div>
           
        </div>
        
        
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
<!--                    <header>
                        <h5>Simple Table</h5>
                        <div class="toolbar">
                            <div class="btn-group"> 
                                <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm accordion-toggle minimize-box"> 
                                <i class="icon-chevron-up"></i> </a> </div>
                        </div>
                    </header>-->
                    <div id="myDiv" style=" height:100%; width:100%; margin-left:4px;">
                        
                    </div>
                </div>
               
            </div>
           
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
<!--                    <header>
                        <h5>Simple Table</h5>
                        <div class="toolbar">
                            <div class="btn-group"> 
                                <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm accordion-toggle minimize-box"> 
                                <i class="icon-chevron-up"></i> </a> </div>
                        </div>
                    </header>-->
                    <div id="sortableTable" class="body collapse in">
                        <table class="table table-bordered sortableTable responsive-table">
                            <thead>
                                <tr>
                                    <th>#<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                    <th>Name<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                    <th>Email<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                    <th>Date<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                    <th>Amount<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i></th>
                                </tr>
                            </thead>
                            <tbody id="table_content">
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
           
        </div>
        
     
        
        <!--TABLE, PANEL, ACCORDION AND MODAL  --> 
        <?php ?>
    </div>
</div>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script> 
<script>
    $(function(){
        $('#start_date').datepicker({ format: 'dd/mm/yyyy' });
        $('#end_date').datepicker({ format: 'dd/mm/yyyy' });
        generate_chart('daily');
        
        
        
    })
    function generate_chart()
    {
        $.post("<?php echo $this->request->webroot?>admin/orders/chart_type",$("#ChartForm").serialize(),function(data)
        {
        var range=[0,1];
        var table="";
        var jsonData = data.order_history;
        if(jsonData.length>0)
        {
        $.each(jsonData, function( index, value ) {
        index=parseInt(index);
        index++;    
        table+="<tr><td>"+index+"</td><td>"+value.name+"</td><td>"+value.email+"</td><td>"+value.date+"</td><td>"+value.amt+"</td></tr>";    
            
        });
      }
      else
      {
        table="<tr><td colspan=5>No Transaction Found</td></tr>";    

      }

        
        
        
        var trace1 = {
        name: 'Rest of world', 
        marker: {color: 'rgb(55, 83, 109)'}, 
        type: 'bar',
        offset:0
      };
      trace1.x=data.x;
      trace1.y=data.y;
      var flag=data.flag;
      

    var data = [trace1];

            var layout = {
          title: 'Sales Report',
          xaxis: {
              tickfont: {
              size: 11, 
              color: '#38a1d8',
              
            },
            //tickFormat:function(d){ console.log(d);}
        
            }, 
          yaxis: {
            title: 'GBP',
            titlefont: {
              size: 16, 
              color: 'rgb(107, 107, 107)'
            },
            
            tickfont: {
              size: 14, 
              color: "rgb(107, 107, 107)"
            },
            
          }, 
          legend: {
            x: 0, 
            y: 1.0, 
            bgcolor: 'rgba(255, 255, 255, 0)',
            bordercolor: 'rgba(255, 255, 255, 0)'
          }, 
          barmode: 'group', 
          bargap: 0.15, 
          bargroupgap: 0,
        };
        if(flag==0)
        {
         layout.yaxis.range=range; 
        }
        Plotly.newPlot('myDiv', data, layout,{displayModeBar: false});
        $("#table_content").html(table);
          
        },"json");
        
    }
</script>
<style>
.table-condensed
    {
        color:#fff
    }    
.datepicker thead tr:first-child th:hover,.datepicker td.day:hover
{
    color:#000;
}
</style>
<!--END PAGE CONTENT -->