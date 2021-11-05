document.addEventListener('DOMContentLoaded', function(){
  if(document.getElementById('mo_saml_edit_backdoor')!=null){
  document.getElementById('mo_saml_edit_backdoor').onclick = function() {
  let v=document.getElementById('miniorange_saml_backdoor_table');
  v.hidden=!v.hidden;
  if(v.hidden)
  {
    var save_btn=document.getElementById('mo_saml_save_config_btn');
    save_btn.click();

    document.getElementById('mo_saml_edit_backdoor').innerHTML='Edit';
  }
  else
    document.getElementById('mo_saml_edit_backdoor').innerHTML='Save';

}


document.getElementById('miniorange_saml_backdoor_textbox1').onkeyup = function() {
  let backdoor_textbox=document.getElementById('miniorange_saml_backdoor_textbox1');
  let base_url=document.getElementById('miniorange_saml_backdoor_base_url_to_append');
  let backdoor_url=document.getElementById('mo_saml_backdoor_url');
  backdoor_url.innerText=base_url.innerText+backdoor_textbox.value;
}
}
});
