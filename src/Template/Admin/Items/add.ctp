 <?php ?> 
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1 > Add Item </h1>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <header>
                        <div class="icons"><i class="icon-th-large"></i></div>
                        <h5>Add Item</h5>
                        <div class="toolbar">
                            <ul class="nav">
                                <li style="margin-right:15px">
                                    <div class="btn-group"> 

                                    </div>
                                </li>

                            </ul>
                        </div>
                    </header>
                    <div id="collapseOne" class="accordion-body collapse in body">
                        <div class="col-sm-6">

                            <div class="row">
				  <?php echo $this->Form->create($items,['enctype'=>"multipart/form-data",'class' => 'form-horizontal', 'id' => 'user-validate']);?>
                                 <div class="form-group">
                                    <label class="control-label col-lg-4">  Title </label>
                                    <?php echo '<div class="col-lg-8">'.$this->Form->input('foodname', array('class'=>'form-control','required'=>true,'label' => false, 'style' => 'width:800px')).'</div>'; ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4"> Description </label>
                                    <?php echo '<div class="col-lg-8">'.$this->Form->input('description', array('class'=>'form-control','required'=>true,'label' => false,'type'=>'textarea', 'style' => 'width:800px')).'</div>'; ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4"> Price </label>
                                    <?php echo '<div class="col-lg-8">'.$this->Form->input('price', array('class'=>'form-control','required'=>true,'label' => false, 'style' => 'width:800px')).'</div>'; ?>
                                </div>
                                   <div class="form-group"> 
                                  <label class="control-label col-lg-4">Food Image </label>
                                  <div class="col-lg-8">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail" style="width: 150px; height: 150px;">
                                        </div>
                                      <div> <span class="btn btn-file btn-success"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                        <input type="file" id="image" name="image" />
                                        </span> <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                                    </div>
                                  </div>
                                </div>   
                                  <label class="control-label col-lg-4"></label>
                                <div class="col-lg-8" style="text-align:left;"> 
                                    <input type="submit" name="submit" value="Add Item" class="btn btn-primary" />
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        /*
        $("#name").keyup(function(){
                var Text = $(this).val();
                Text = Text.toLowerCase();
                var regExp = /\s+/g;
                Text = Text.replace(regExp,'-');
                $("#slug").val(Text);        
        }); 
        */
        
        $("#name").keyup(function(){
                var Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
                $("#slug").val(Text);        
        });        
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYFY2fp_meJiSEKve5pDJk9Kzr_oDOlPk&libraries=places"></script>
<script>
var input = document.getElementById('address');
var autocomplete = new google.maps.places.Autocomplete(input);
google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        var adr_address=place.adr_address;
        var address_arr=adr_address.split(",");
        
        
        for(i=0;i<address_arr.length;i++)
        {
            var str=address_arr[i];
            if(str.indexOf('region') !== -1)
            {
                var state=str.replace(/<\/?[^>]+(>|$)/g, "");
                $("#state").attr("value",state);
            }
            else if(str.indexOf('country-name') !== -1){
                
               var country=str.replace(/<\/?[^>]+(>|$)/g, "");
               $("#country").attr("value",country);
            }
            else
            {
               var city=str.replace(/<\/?[^>]+(>|$)/g, "");
               $("#city").attr("value",city);
            }
            
           
        }
        
    });
</script>