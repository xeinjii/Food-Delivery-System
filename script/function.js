function myfunction(){
    var field = document.getElementById("password");
    var fieldd = document.getElementById("cpassword");
      var showPass = document.getElementById("showpassword");
      if(showPass.checked){
          field.type='text';
          fieldd.type='text';
       }
       else{
          field.type='password';
          fieldd.type='password';
      }
   }

   document.getElementById('search-bar').addEventListener('keyup', function() {
    const searchString = this.value.toLowerCase();
    const products = document.querySelectorAll('.product-item');

    products.forEach(product => {
        const title = product.querySelector('.card-title').textContent.toLowerCase();
        if (title.includes(searchString)) {
            product.style.display = '';
        } else {
            product.style.display = 'none';
        }
    });
});
