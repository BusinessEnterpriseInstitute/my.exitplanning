var countUserAttributes = 0;
var countRoleAttributes = 0;
var countUrlAttributes = 0;
var countRole = 0;
var countUrl = 0;

document.addEventListener('DOMContentLoaded', function(){
   
    var existingVariable1 = jQuery('select[name^=user_profile_attr_name]');
     countUserAttributes = existingVariable1.length;
    var existingVariable2 = jQuery('select[name^=user_sp_role_name]');
     countRoleAttributes = existingVariable2.length;
    var existingVariable3 = jQuery('select[name^=role_class]');
     countUrlAttributes = existingVariable3.length;

     countRole = countRoleAttributes;
     countUrl = countUrlAttributes;

    if (countUserAttributes == 0)
        add_user_attribute();
    if (countRoleAttributes == 0)
        add_role();         
    if (countUrlAttributes == 0)
        add_url();

});

function add_user_attribute(){

    var sel = '<div class="row userAttr" style="padding-bottom:1%;" id="uparow_' + countUserAttributes + '"><div style="width:20%;display:inline-block;"><input type="text" name="user_profile_attr_name[' + countUserAttributes + ']" value="" class="form-text" /></div><div style="width:20%;display:inline-block;"><input type="text" name="user_profile_attr_value[' + countUserAttributes + ']" value="" class="form-text" /></div></div>';
    
    if(countUserAttributes!=0){ 
        jQuery(sel).insertAfter(jQuery("#uparow_" +(countUserAttributes-1)));
        countUserAttributes += 1;
    }
    else{
        jQuery(sel).insertAfter(jQuery("#before_attr_list_upa"));
        countUserAttributes += 1;
    }
}

function remove_user_attribute(){

    if(countUserAttributes != 0){
        countUserAttributes -= 1;
        jQuery("#userProfileAttrDiv .userAttr:last").remove();
    }
}

function add_role(){ 
    str = document.getElementById('role_string').innerHTML;

     var sel = '<div class="row userRole" style="padding-bottom:1%;" id="role_' + countRole + '"><div style="width:25%;display:inline-block;"><select name="user_sp_role_name[]" value="" class="form-control sp_role_class">' + str + '</select></div><div style="width:45%;display:inline-block;margin-left:4px;"><input type="text" name="user_idp_role_name[]" placeholder="semi-colon(;) separated" value="" class="form-text"/></div><div style="width:25%;display:inline-block;margin-left:4px;"><input type="button" style="width:10%;" value="-" class="btn btn-danger" id="'+countRole+'" onclick="remove_role(this.id);"/></div></div>';
     if(countRoleAttributes!=0){ 
         jQuery(sel).insertAfter(jQuery("#userSpRoleDiv .userRole:last"));
         countRoleAttributes += 1;
     }
     else{
         jQuery(sel).insertAfter(jQuery("#before_role_list_upa"));
         countRoleAttributes += 1;
     }
     countRole+=1;
 }

 function remove_role(id){
     if(countRoleAttributes != 0){
         countRoleAttributes -= 1;
         jQuery("#role_"+id).remove();
     }
}

function add_url(){ 
    str = document.getElementById('role_string').innerHTML;
     var sel = '</br><div class="row logUrl" style="padding-bottom:1%;" id="url_' + countUrl + '"><div style="width:68%;display:inline-block;"><select name="role_class[]" value="" class="form-control sp_role_class">' + str + '</select></div><div style="width:25%;display:inline-block;margin-left:25px;"><input type="button" style="width:10%;" value="-" class="btn btn-danger" id="'+countUrl+'" onclick="remove_url(this.id);"/></div></br></br><div style="width:76%;display:inline-block;margin-left:4px;"><input type="text" name="login_url[]" value="" class="form-text" placeholder="Enter Custom Login Url"/></div></br></br><div style="width:76%;display:inline-block;margin-left:4px;"><input type="text" name="logout_url[]" value="" class="form-text" placeholder="Enter Custom Logout Url"/></div></div>';
     if(countUrlAttributes!=0){ 
         jQuery(sel).insertAfter(jQuery("#logUrlDiv .logUrl:last"));
         countUrlAttributes += 1;
     }
     else{
         jQuery(sel).insertAfter(jQuery("#before_log_url_upa"));
         countUrlAttributes += 1;
     }
     countUrl+=1;
 }

 function remove_url(id){
     if(countUrlAttributes != 0){
         countUrlAttributes -= 1;
         jQuery("#url_"+id).remove();
     }
  }


       