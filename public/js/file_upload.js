document.querySelector('.custom-file-input').addEventListener('change',function(e){
  console.log(document.querySelector('#inputGroupFile02'));
  var fileName = document.querySelector("#inputGroupFile02").files[0].name;
  var nextSibling = e.target.nextElementSibling
  nextSibling.innerText = fileName
})
