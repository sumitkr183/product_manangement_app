<?php
    $this->load->view('header');
?>

<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <h4 class="p-h4 text-center">Add Products</h4>

            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Product Name :</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Company Name :</label>
                    <input type="text" name="company_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Product Category :</label>
                    <select name="category" class="form-control" required>
                        <option>-- Select Category --</option>
                        <?php if(!empty($category)) : ?>
                            <?php foreach($category as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Skuno No :</label>
                    <input type="number" name="skuno" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label>Batch No :</label>
                    <input type="number" name="batch_no" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label>Product Qty :</label>
                    <input type="number" name="qty" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label>Product Price :</label>
                    <input type="number" name="price" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label>Product Size :</label>
                    <select name="size" class="form-control" required>
                        <option>-- Select Size --</option>
                        <option value="L">Large</option>
                        <option value="M">Medium</option>
                        <option value="S">Small</option>
                    </selct>
                </div>
                <div class="form-group">
                    <label>Product Image :</label>
                    <input type="file" name="file" id="product_image">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Add Products</button>
                </div>
            </form>

        </div>
    </div>
<div>


<?php
    $this->load->view('footer');
?>