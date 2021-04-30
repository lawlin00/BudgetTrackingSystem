<?php include 'Layout2.php' ?>

<div class="d-flex justify-content-center">
  <div class="form-custom w-50 p-3">
  <form action="#" class="" name="formtemplate">
    <div class="form-group">
   <label for="exampleInputEmail1">Email address</label>
   <span class="input-group-addon">@</span>
   <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>

   <small id="emailHelp" class="form-text text-muted text-white">We'll never share your email with anyone else.</small>
   <div class="valid-feedback">Valid.</div>
   <div class="invalid-feedback">Please fill out this field.</div>
 </div>
 <div class="form-group">
   <label for="exampleInputPassword1">Password</label>
   <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
   <small id="passwordHelpBlock" class="form-text text-muted">
  Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
</small>

 </div>
 <div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control form-control-lg" id="exampleFormControlSelect1" required>
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>
  <div class="form-group">
     <label for="exampleFormControlFile1">Example file input</label>
     <input type="file" class="form-control-file form-control-lg" id="exampleFormControlFile1">
   </div>

   <div class="form-check">
     <input class="form-check-input ml-auto" type="checkbox" value="" id="defaultCheck1" required>
     <label class="form-check-label" for="defaultCheck1">
       Default checkbox
     </label>
   </div>
   <div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" required>
  <label class="form-check-label" for="exampleRadios1">
    Default radio
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" required>
  <label class="form-check-label" for="exampleRadios2">
    Second default radio
  </label>
</div>

  <button type="submit" class="btn btn-primary right">Submit</button>
</div>

  </form>
  </div>
</div>


<?php include 'footer.php' ?>
