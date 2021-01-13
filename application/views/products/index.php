<?php
    $this->load->view('header');
?>

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="products_cover">
                    <div class="products_logo">
                        <span>INVENTORY APP</span>
                    </div>                    
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="products_add">
                    <a href="<?= base_url() ?>add-products" class="btn btn-primary">NEW PRODUCTS</a>
                <div>
            </div>
           
            <div class="col-md-12">
                <div class="table-responsive" style="margin-top: 5rem;">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Product Name</th>
                                <th>Company</th>
                                <th>Category</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($products)) : ?>
                                <?php foreach($products as $product) : ?>
                                    <tr>
                                        <td><?= $product['id'] ?></td>
                                        <td><?= $product['name'] ?></td>
                                        <td><?= $product['company_name'] ?></td>
                                        <td><?= $this->ProductsModel->getField('name','products_category',$product['product_category']) ?></td>
                                        <td>
                                            <button type="button" onclick="getProducts(<?= $product['id'] ?>)" class="btn btn-default">View Product</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

<?php
    $this->load->view('footer');
?>