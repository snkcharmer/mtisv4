<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NMP</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="<?php echo base_url()?>images/NMP.ico" />
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>dist/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="<?php echo base_url()?>plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>bootstrap/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<style type="text/css">
    html, body{
      height: 100%;
    }
    body { 
                background-image: url(<?php echo base_url()?>images/background.jpg) ;
                background-position: center center;
                background-repeat:  no-repeat;
                background-attachment: fixed;
                background-size:  cover;
                /*background-color: #999;*/
      
    }
    #regiration_form fieldset:not(:first-of-type) {
        display: none;
    }
    .form-control{
        height: 40px;
        font-size: 17px;
        text-transform: uppercase;
    }
    input.form-control:hover{
        background: #00293c;
        color: white;
    }
    .has-error{
        color:red;
    }
    .select2-selection__rendered{
        padding-top: 8px;
        text-transform: uppercase;
    }
    .select2-container--default .select2-selection--single{
        height: 40px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        top: 7px;
    }
    .checkbox label:after, 
    .radio label:after {
        content: '';
        display: table;
        clear: both;
    }

    .checkbox .cr,
    .radio .cr {
        background: white;
        position: relative;
        display: inline-block;
        border: 1px solid #a9a9a9;
        border-radius: .25em;
        width: 1.3em;
        height: 1.3em;
        float: left;
        margin-right: .5em;
    }

    .radio .cr {
        border-radius: 50%;
    }

    .checkbox .cr .cr-icon,
    .radio .cr .cr-icon {
        position: absolute;
        font-size: .8em;
        line-height: 0;
        top: 50%;
        left: 20%;
    }

    .radio .cr .cr-icon {
        margin-left: 0.04em;
    }

    .checkbox label input[type="checkbox"],
    .radio label input[type="radio"] {
        display: none;
    }

    .checkbox label input[type="checkbox"] + .cr > .cr-icon,
    .radio label input[type="radio"] + .cr > .cr-icon {
        transform: scale(3) rotateZ(-20deg);
        opacity: 0;
        transition: all .3s ease-in;
    }

    .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
    .radio label input[type="radio"]:checked + .cr > .cr-icon {
        transform: scale(1) rotateZ(0deg);
        opacity: 1;
    }

    .checkbox label input[type="checkbox"]:disabled + .cr,
    .radio label input[type="radio"]:disabled + .cr {
        opacity: .5;
    }
    div.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 0 .4em 1.4em !important;
        margin: 0 0 0 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
    }
</style>
<body>
    <div class="row" style="background-color: rgba(255,255,255,0.9);"> 
        <div class="row progress" style="height: 25px;">
            <div  class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <h3 style="float: left;margin-left: 10px;"><a href="<?php echo base_url()?>Home/" class="btn btn-primary bhome" ><i style="" class="glyphicon glyphicon-circle-arrow-left"></i> Back to Home</a></h3>
        
        <div class="container" style="/*margin-top: 30px;margin-bottom: 30px;border:2px solid #d6cfcf;background: white;*/border-radius: 5px;"> 
             
            
           
            <div style="height: 30px;">
                <h1 style="text-align: center;font-weight: bold;">Registration Form</h1>
            </div>
            <br><br>
            <div class="scheduler-border" style="background: #00293c;color: white;border-radius: 5px;"> 
                <h5 style="padding-top: 5px;"><b>Instructions: </b>Fill up all required field and check all necessary boxes. field with <span style="color: red;">asterisk (*)</span> is a required field</h5>
            </div>
            
            <form id="regiration_form" action=""  method="post">
                <input type="hidden" id="flag" value="<?php echo $flag;?>">
                <input type="hidden" id="locid" value="">
                <input type="hidden" id="trid" value="">
                <input type="hidden" id="csid" value="">
                <input type="hidden" id="schoolid" value="">
                <input type="hidden" id="cpid" value="">
                <input type="hidden" id="seid" value="">
                <fieldset>
                    <h2>Step 1: General Information</h2>
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="form-group">
                                <input type="text" class="form-control"  name="fname" id="fname" placeholder="First_name" value="<?php if(isset($rec['fname'])){echo $rec['fname'];}?>" required />
                                <label class="control-label">First Name <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div> 
                        <div class="col-xs-3">   
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last_name" value="<?php if(isset($rec['lname'])){ echo $rec['lname'];}?>" required  />
                                    <label class="control-label">Last Name <span style="font-size: 17px;color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="ext" id="ext" placeholder="Extension (Jr, Sr, II, III, etc.)" value="<?php if(isset($rec['suffix'])){ echo $rec['suffix'];}?>" />
                                    <label class="control-label">Extension (Jr, Sr, II, III, etc.) <span style="font-size: 12px;color: red;">(Optional)</span></label>
                                </div>
                            </div>
                        </div>
                         <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="mname" id="mname" placeholder="Middle_name" value="<?php if(isset($rec['mname'])){ echo $rec['mname'];}?>" />
                                <label class="control-label">Middle Name <span style="font-size: 12px;color: red;"></span></label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <div class ="radio">
                                    <label style="font-size: 1.1em;font-weight: bold;">
                                        <input type="radio" name="optgender" value="M" <?php if(isset($rec['sex'])){if($rec['sex'] == 'M'){echo "checked";}}?> required />
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        Male
                                    </label>
                                    <label style="font-size: 1.1em;font-weight: bold;">
                                        <input type="radio" name="optgender"  value="F" <?php if(isset($rec['sex'])){if($rec['sex'] == 'F'){echo "checked";}}?>>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        Female
                                    </label>
                                </div>
                                <label class="control-label">Gender <span style="font-size: 17px;color: red;">*</span></label>    
                            </div>
                        </div> 
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="citi" id="citi" value="Filipino" placeholder="Citizenship" required />
                                <label class="control-label">Citizenship <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <select class="form-control" name="cstatus" id="cstatus" required>
                                   <option value="">Select ....</option>
                                   <option value="1" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '1'){echo "selected";}}?> >Single</option>
                                   <option value="2" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '2'){echo "selected";}}?> >Married</option>
                                   <option value="3" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '3'){echo "selected";}}?> >Widow(er)</option>
                                   <option value="4" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '4'){echo "selected";}}?> >Separated </option>
                                   <option value="5" <?php if(isset($rec['civstatid'])){if($rec['civstatid'] == '5'){echo "selected";}}?> >Annuled</option>
                                   <!-- <option value="6" <?php //if(isset($rec['civstatid'])){ if($rec['civstatid'] == '6'){echo "selected";}}?> >Others</option> -->
                                </select>
                                <label class="control-label">Civil Status <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="date" class="form-control" name="bdate" id="bdate" value="<?php if(isset($rec['bdate'])){ echo $rec['bdate'];}?>" placeholder="Birthdate" required />
                                <label class="control-label">Birthdate <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-xs-12">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="bplace" id="bplace" value="<?php if(isset($rec['bplace'])){ echo $rec['bplace'];}?>" placeholder="Birthplace" required />
                                <label class="control-label">Birthplace <span style="font-size: 17px;color: red;">*</span> <small>(Complete address)</small></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 style="font-weight: 600;padding: 10px;font-size: 18px;">Complete Mailing Address</h5>
                    </div>
                    <div class="row">
                        <div class="col-xs-3"> 
                            <div class="form-group">
                                <select class="form-control mcid" name="mcid" id="mcid" style="height: 50px;width: 100%;" required>
                                   <option value="">Select ....</option>
                                   <?php
                                    //if($flag == 1){
                                    foreach($mun->result_array() as $value) {?>
                                    <option value="<?php echo $value['idnum']?>" <?php if(isset($rec['locid'])){if($rec['locid'] == $value['idnum']){echo "selected";}}?>><?php echo $value['municipal']?></option>
                                    <?php
                                   // }
                                    }
                                    ?>
                                </select>
                                <label class="control-label">Municipality/City <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3"> 
                            <div class="form-group">
                                <input type="text" class="form-control regid" name="regid" id="regid" value="<?php if(isset($rec['region'])){ echo $rec['region'];}?>" placeholder="Region" required readonly />
                                <!-- <select class="form-control regid" name="regid" id="regid" style="width: 100%;" required>
                                   <option value="">Select ....</option>
                                    <?php
                                    //foreach ($reg->result_array() as $key) {?>
                                        <option value="<?php //echo $key['region']?>" <?php //if(isset($rec['region'])){if($rec['region'] == $key['region']){echo "selected";}}?>><?php// echo $key['region']?></option>
                                    <?php
                                   // }
                                   ?>
                                </select> -->
                                <label class="control-label">Region <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>  
                        <div class="col-xs-3"> 

                            <div class="form-group">
                                <input type="text" class="form-control provid" name="provid" id="provid" value="<?php if(isset($rec['province'])){ echo $rec['province'];}?>" placeholder="Province" required readonly />
                                <!-- <select class="form-control provid" name="provid" id="provid" style="height: 50px;width: 100%;" required>
                                   <option value="">Select ....</option>
                                    <?php
                                    //if($flag == 1){
                                   // foreach($prov->result_array() as $value) {?>
                                    <option value="<?php //echo $value['province']?>" <?php //if(isset($rec['province'])){if($rec['province'] == $value['province']){echo "selected";}}?>><?php// echo $value['province']?></option>
                                    <?php
                                   // }
                                   // }
                                    ?>
                                </select>-->
                                <label class="control-label">Province <span style="font-size: 17px;color: red;">*</span></label>
                            </div> 
                        </div> 
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="pcode" id="pcode" value="<?php if(isset($rec['pcode'])){ echo $rec['pcode'];}?>" placeholder="Postal Code" readonly />
                                <label class="control-label">Postal Code / Zip Code  <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-xs-12">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" id="address" value="<?php if(isset($rec['comadd'])){ echo $rec['comadd'];}?>" placeholder="House No./Street / Barangay" />
                                <label class="control-label">House No./Street / Barangay  <span style="font-size: 12px;color: red;">(Optional)</span></label>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <h5 style="font-weight: 600;padding: 10px;font-size: 18px;">Contact Numbers</h5>
                    </div> 
                    <div class="row">
                        <div class="col-xs-4">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="lnumber" id="lnumber" value="<?php if(isset($rec['landline'])){ echo $rec['landline'];}?>" placeholder="(Area Code) Landline Number" />
                                <label class="control-label">(Area Code) Landline Number (<span style="font-size: 12px;color: red;">Optional</span>)</label>
                            </div>
                        </div> 
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" onkeypress='validate(event)' name="mnumber1" id="mnumber1" value="<?php if(isset($rec['mobile'])){ echo $rec['mobile'];}?>" placeholder="Mobile No." required />
                                <label class="control-label">Mobile No. 1 <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" onkeypress='validate0(event)' name="mnumber2" id="mnumber2" placeholder="Mobile No." />
                                <label class="control-label">Mobile No. 2 (<span style="font-size: 12px;color: red;">Optional</span>)</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5 style="font-weight: 600;padding: 10px;font-size: 18px;">Social Media Account</h5>
                    </div> 
                    <div class="row">
                         <div class="col-xs-4">    
                            <div class="form-group">
                                <input style="text-transform: none;" type="email" class="form-control" name="user_email" id="user_email" value="<?php if(isset($rec['eadd'])){ echo $rec['eadd'];}?>" placeholder="Email Address" />
                                <label class="control-label">Email Address (<span style="font-size: 13px;color: red;">Optional</span>)</label>
                            </div>
                        </div>
                        <div class="col-xs-4">    
                            <div class="form-group">
                                <input style="text-transform: none;" type="text" class="form-control" name="fbacc" id="fbacc" placeholder="Facebook Account" />
                                <label class="control-label">Facebook Account (<span style="font-size: 13px;color: red;">Optional</span>)</label>
                            </div>
                        </div>
                    </div>    
                   <hr>
                    <button type="button" class="next btn btn-danger pull-right" data-label="ginsave" style="height: 50px;font-size: 18px;">Save and Continue <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
                    <br><br><br><br>
                </fieldset>
                <fieldset>
                    <h2> Step 2: Highest Educational Attainment</h2>
                    <hr>
                    <h3 style="font-size: 15px;">NOTE: If the course name and school name are not listed in the select field. Please click <b>add course or add school button</b> to add.</h3>
                    <div class="row">
                        <div class="col-xs-10">    
                            <div class="form-group">
                                <select class="form-control courseid" name="courseid" id="courseid" style="height: 50px;width: 100%;" required>
                                    <option value="">Select ....</option>
                                    <?php
                                    foreach ($course->result_array() as $key) {?>
                                        <option value="<?php echo $key['courseid']?>" <?php if(isset($rec['courseid'])){if($rec['courseid'] == $key['courseid']){echo "selected";}}?>><?php echo $key['course']?></option>
                                    <?php
                                    }
                                   ?>
                                </select>
                                <label class="control-label">Course/s Taken <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label style="height: 20px;"></label>
                                <a href="#" data-toggle="modal" data-target="#Addcourse"><i class="fa fa-plus-circle"></i> Addcourse.....</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-10">    
                            <div class="form-group">
                                <select class="form-control schlid" name="schlid" id="schlid" style="height: 50px;width: 100%;" required>
                                   <option value="">Select ....</option>
                                    <?php
                                    foreach ($schl->result_array() as $key) {?>
                                        <option value="<?php echo $key['schoolid']?>" <?php if(isset($rec['schoolid'])){if($rec['schoolid'] == $key['schoolid']){echo "selected";}}?>><?php echo $key['school'].' - '.$key['address']?></option>
                                    <?php
                                    }
                                   ?>
                                </select>
                                <label class="control-label">School Graduated <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label style="height: 20px;"></label>
                                <a href="#" data-toggle="modal" data-target="#Addschool"><i class="fa fa-plus-circle"></i> Addschool.....</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="schladdress" id="schladdress" value="<?php if(isset($rec['address'])){ echo $rec['address'];}?>" placeholder="Address" readonly required />
                                <label class="control-label">School Address <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="previous btn btn-primary" name="previous" style="height: 50px;font-size: 18px;" data-label="ginsave"><i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-left"></i> Previous </button>
                    <button type="button" class="next btn btn-danger pull-right" data-label="heasave" style="height: 50px;font-size: 18px;">Save and Continue <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
                    <br><br>
                </fieldset>
                <fieldset>
                    <h2>Step 3: Contact Person in case of Emergency</h2>
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="fullname" id="fullname" value="<?php if(isset($rec['emname'])){ echo $rec['emname'];}?>" placeholder="Fullname" required />
                                <label class="control-label">Fullname <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="rel" id="rel" value="<?php if(isset($rec['emrelation'])){ echo $rec['emrelation'];}?>" placeholder="Relationship" required />
                                <label class="control-label">Relationship <small>(Spouse, Parent, Brother, Sister, etc.)</small> <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="telnum" id="telnum" placeholder="Landline Number" />
                                <label class="control-label">Telephone Number (<span style="font-size: 12px;color: red;">Optional</span>)</label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="mob1" id="mob1" onkeypress='validate1(event)' value="<?php if(isset($rec['emphone'])){ echo $rec['emphone'];}?>" placeholder="Mobile No." />
                                <label class="control-label">Mobile No. 1 (<span style="font-size: 12px;color: red;">Optional</span>)</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="mob2" id="mob2" onkeypress='validate2(event)' placeholder="Mobile No." />
                                <label class="control-label">Mobile No. 2 (<span style="font-size: 12px;color: red;">Optional</span>)</label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="email" class="form-control" name="emailadd" id="emailadd" placeholder="Email Address" />
                                <label class="control-label">Email Address (<span style="font-size: 12px;color: red;">Optional</span>)</label>
                            </div>
                        </div>
                        <div class="col-xs-6">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="caddress" id="caddress" value="<?php if(isset($rec['emaddr'])){ echo $rec['emaddr'];}?>" placeholder="Address" required />
                                <label class="control-label">Complete Address <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="previous btn btn-primary" name="previous" style="height: 50px;font-size: 18px;"><i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-left"></i> Previous </button>
                    <button type="button" class="next btn btn-danger pull-right" data-label="cpcesave" style="height: 50px;font-size: 18px;">Save and Continue <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
                    <br><br>
                </fieldset>
                <fieldset>
                    <h2> Step 4: Latest Shipboard Experience <span style="color: red;font-size: 13px;">(Optional)</span></h2>
                    <hr>
                    <h3 style="font-size: 15px;">NOTE: If the License, Rank and Employeer name are not in the select field. Please click <b>others button</b> to add.</h3>
                    <div class="row">
                        <div class="col-xs-4">    
                            <div class="form-group">
                               <select class="licid form-control" name="licid" id="licid" style="height: 50px;width: 100%;" >
                                   <option value="">Select ....</option>
                                    <?php
                                    foreach ($lic->result_array() as $key) {?>
                                        <option value="<?php echo $key['licid']?>"><?php echo $key['license']?></option>
                                    <?php
                                    }
                                   ?>
                                </select>
                                <label class="control-label">License <span style="font-size: 17px;color: red;">*</span> &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#AddLicense"><i class="fa fa-plus-circle"></i> Others</a></label>
                            </div>
                        </div>
                        <div class="col-xs-4">    
                            <div class="form-group">
                                <select class="form-control rankid" name="rankid" id="rankid" style="height: 50px;width: 100%;" >
                                   <option value="">Select ....</option>
                                    <?php
                                    foreach ($rank->result_array() as $key) {?>
                                        <option value="<?php echo $key['rankid']?>"><?php echo $key['rank']?></option>
                                    <?php
                                    }
                                   ?>
                                </select>
                                <label class="control-label">Rank on Board <span style="font-size: 17px;color: red;">*</span> &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#AddRank"><i class="fa fa-plus-circle"></i> Others</a></label>
                            </div>
                        </div>
                        <div class="col-xs-4">    
                            <div class="form-group">
                                <input type="date" class="form-control" name="datedis" id="datedis" placeholder="Date" />
                                <label class="control-label">Date of Disembarkation <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-xs-4">    
                            <div class="form-group">
                                <select class="form-control employid" name="employid" id="employid" style="height: 50px;width: 100%;" >
                                   <option value="">Select ....</option>
                                    <?php
                                    foreach ($employer->result_array() as $key) {?>
                                        <option value="<?php echo $key['employid']?>"><?php echo $key['name']?></option>
                                    <?php
                                    }
                                   ?>
                                </select>
                                <label class="control-label">Employeer <span style="font-size: 17px;color: red;">*</span> &nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#AddEmployeer"><i class="fa fa-plus-circle"></i> Others</a></label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-4">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="sprin" id="sprin" placeholder="Owner of Ship " />
                                
                                <label class="control-label">Manning Company <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-4">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="lnum" id="lnum" placeholder="Landline Number" />
                                <label class="control-label">(Area code)Landline Number <span style="font-size: 12px;color: red;">(Optional)</span></label>
                            </div>
                        </div>
                        <div class="col-xs-4">    
                            <div class="form-group">
                                <input type="number" class="form-control" name="mnum" id="mnum" placeholder="Mobile No." />
                                <label class="control-label">Mobile Number <span style="font-size: 12px;color: red;">(Optional)</span></label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="previous btn btn-primary" name="previous" style="height: 50px;font-size: 18px;"><i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-left"></i> Previous </button>
                    <button type="button" class="next btn btn-danger pull-right" data-label="lsesave" style="height: 50px;font-size: 18px;">Save and Continue <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
                    <br><br>
                </fieldset>
                <fieldset>
                    <h2> Step 5: Training Course you wish to Enroll</h2>
                    <hr>
                    <h3 style="font-size: 15px;">NOTE: If sponsor name are not in the select field. Please click <b>others button</b> to add.</h3>
                    <div class="row">
                        <div class="col-xs-6">    
                            <div class="form-group">
                                <select class="form-control modid" name="modid" id="modid" style="width: 100%;" required>
                                   <option value="">Select ....</option>
                                    <?php
                                    foreach ($mod->result_array() as $key) {?>
                                        <option value="<?php echo $key['modcode']?>"><?php echo '<b>'.$key['module'].'</b> - '.$key['descriptn']?></option>
                                    <?php
                                    }
                                   ?>
                                </select>
                                <label class="control-label">Module/Course <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-6">    
                            <div class="form-group">
                                <select class="form-control sponsor" name="sponsor" id="sponsor" style="width: 100%;" required>
                                   <option value="">Select ....</option>
                                    <?php
                                    foreach ($sponsor->result_array() as $key) {?>
                                        <option value="<?php echo $key['sponid']?>"><?php echo '<b>'.$key['sptypename'].'</b>'?></option>
                                    <?php
                                    }
                                   ?>
                                </select>
                                <label class="control-label">Sponsor <span style="font-size: 17px;color: red;">*</span> &nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#AddSponsor"><i class="fa fa-plus-circle"></i> Others</a></label>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="displaysched" style="font-size: 17px;color: red;">Click to view list of schedule</a>
                    <div class="row schedule_01">
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <select class="form-control" name="code" id="code" style="height: 50px;width: 100%;" required>
                                    <option value="">Select ....</option>  
                                </select>
                                <label class="control-label">Start Date <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="edate" id="edate" placeholder="end date" required readonly />
                                <input type="hidden" name="sdate" id="sdate" />
                                <label class="control-label">End Date <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                                <input type="text" class="form-control" name="venue" id="venue" placeholder="Venue" required readonly />
                                <input type="hidden" name="venid" id="venid" />
                                <input type="hidden" name="batch" id="batch" />
                                <label class="control-label">Venue<span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                        <div class="col-xs-3">    
                            <div class="form-group">
                               <input type="text" class="form-control" name="fee" id="fee" placeholder="fee" readonly required/>
                                <label class="control-label">Fee <span style="font-size: 17px;color: red;">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary pull-right savetcesave" type="button" data-label="tcesave" style="margin-right: 0px;height: 50px;font-size: 15px;">Add Schedule <i class="fa fa-plus-circle"></i></button>
                            <div class="" style="margin-left: 0px;margin-right: 17px;width: 45%;
                                padding: 20px 0px 20px 10px;
                                border: solid 1px #00293c;
                                border-radius: 5px;">
                                <b>NOTE:</b> <i>Please don't forget to click add schedule after selecting courses</i>
                            </div>
                        </div>    
                    </div>
                    <div style="clear:both;"></div>
                    <div style="margin-top: 20px;">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hovered">
                                <thead style="background: #00293c;color: white;">
                                    <tr>
                                        <th>Module</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Sponsor</th>
                                        <th>Venue</th>
                                        <th>fee</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="data-insert">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="margin-top: 20px;">
                        <div>
                            <div class ="checkbox">
                                <label style="font-size: 1.1em;font-weight: bold;">
                                    <input type="checkbox" name="certifyme" value="1" required />
                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                    I certify that the foregoing are true and correct to the best of my knowledge and belief.
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="previous btn btn-primary" name="previous" style="height: 50px;font-size: 18px;"><i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-left"></i> Previous </button>
                    <button type="button" class="done btn btn-danger pull-right" style="height: 50px;font-size: 18px;">Finish <i style="font-size: 18px;" class="glyphicon glyphicon-circle-arrow-right"></i></button>
                    <br><br>
                </fieldset>
            </form> 
        </div>
        <p style="font-size: 19px;text-align: center;color: black;padding-bottom: 50px;"> <span>By using this system, you agree to our <!--a href="<?php //echo base_url()?>termsofservice" target="_blank"  style="color:red;">Terms of Services </a--> <a href="<?php echo base_url()?>nea/policy" target="_blank" style="color:red;">Privacy Policy</a></span></p>
    </div> 

     <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>plugins/select2/select2.min.js"></script>

    <script src="<?php echo base_url()?>dist/sweetalert/sweetalert-dev.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url()?>bootstrap/js/bootstrap.min.js"></script>    
    <?php $this->load->view("include/registration_js") ?>
    <?php $this->load->view("include/registration_modal") ?>
</body>
    
