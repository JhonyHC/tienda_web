<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
<div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h1>Edit Product</h1>
                        <p>Fill the fields.</p>
                        <form method="POST" action="products/{{ $product->id }}" class="requires-validation" novalidate>
                            @csrf
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="name" id="name" value="{{old('name') ?? $product->name}}" placeholder="Product Name" required>
                                <!-- <div class="valid-feedback">Username field is valid!</div>
                                <div class="invalid-feedback">Username field cannot be blank!</div> -->
                                @error('name')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="number" name="price" id="price" value="{{$price ?? ''}}" placeholder="Product Price" required>
                                <!-- <div class="valid-feedback">Username field is valid!</div>
                                <div class="invalid-feedback">Username field cannot be blank!</div> -->
                                @error('price')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <select class="form-select mt-3" name="category" required>
                                      <option selected disabled value="">Option</option>
                                      <option value="toys">Toys</option>
                                      <option value="material">Material</option>
                                      <option value="clothes">Clothes</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                                <!-- <div class="valid-feedback">You selected a position!</div>
                                <div class="invalid-feedback">Please select a position!</div> -->
                            </div>

                            <div class="col-md-12 mb-3">
                               <input class="form-control" type="text" name="description" placeholder="Description">
                               <!-- <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">Username field cannot be blank!</div> -->
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="number" name="stock" id="stock" value="{{$stock ?? ''}}" placeholder="Product Stock" required>
                                <!-- <div class="valid-feedback">Username field is valid!</div>
                                <div class="invalid-feedback">Username field cannot be blank!</div> -->
                                @error('stock')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>

                           <!-- <div class="col-md-12">
                                <select class="form-select mt-3" required>
                                      <option selected disabled value="">Position</option>
                                      <option value="jweb">Junior Web Developer</option>
                                      <option value="sweb">Senior Web Developer</option>
                                      <option value="pmanager">Project Manager</option>
                               </select>
                                <div class="valid-feedback">You selected a position!</div>
                                <div class="invalid-feedback">Please select a position!</div>
                           </div> -->


                           <!-- <div class="col-md-12">
                              <input class="form-control" type="password" name="password" placeholder="Password" required>
                               <div class="valid-feedback">Password field is valid!</div>
                               <div class="invalid-feedback">Password field cannot be blank!</div>
                           </div>
 -->

                           <!-- <div class="col-md-12 mt-3">
                            <label class="mb-3 mr-1" for="gender">Gender: </label>

                            <input type="radio" class="btn-check" name="gender" id="male" autocomplete="off" required>
                            <label class="btn btn-sm btn-outline-secondary" for="male">Male</label>

                            <input type="radio" class="btn-check" name="gender" id="female" autocomplete="off" required>
                            <label class="btn btn-sm btn-outline-secondary" for="female">Female</label>

                            <input type="radio" class="btn-check" name="gender" id="secret" autocomplete="off" required>
                            <label class="btn btn-sm btn-outline-secondary" for="secret">Secret</label>
                               <div class="valid-feedback mv-up">You selected a gender!</div>
                                <div class="invalid-feedback mv-up">Please select a gender!</div>
                            </div> -->

                        <!-- <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                          <label class="form-check-label">I confirm that all data are correct</label>
                         <div class="invalid-feedback">Please confirm that the entered data are all correct!</div>
                        </div> -->
                  

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>