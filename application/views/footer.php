    
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="productName">Product Name</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="product_image">
                <img src="" id="product_image">
            </div>
            <h4>Company : <span id="companyName"></span></h4>    
            <h4>Price : <span id="price"></span></h4>
            <h4>Quantity : <span id="qty"></span></h4>
            <h4>Size : <span id="size"></span></h4>
            <h4>Stock : <span id="stock"></span></h4>
        </div>    
        </div>
    </div>
    </div>
    
    <script>
        const baseURL = '<?= base_url() ?>';
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <?php if($this->session->flashdata('error')) : ?>
        <script>
            iziToast.show({
            title: 'Error :',
            message: '<?= $this->session->flashdata('error') ?>',
            timeout: 60000,
            theme: 'dark',
            position: 'bottomRight',
            backgroundColor: '#ff5050',
        });
        </script>
    <?php endif; ?>

    <?php if($this->session->flashdata('success')) : ?>
        <script>
            iziToast.show({
            title: 'Success :',
            message: '<?= $this->session->flashdata('success') ?>',
            timeout: 60000,
            theme: 'dark',
            position: 'bottomRight',
            backgroundColor: '#23e869'
        });
        </script>
    <?php endif; ?>


        <script>
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>

        <script>
            function getProducts(id)
            {
                $.ajax({
                    method: 'POST',
                    url: baseURL+'view-product',
                    data: {id:id},
                    success: function(data){               
                        let response = jQuery.parseJSON(data);
                        
                        console.log(response);
                        if(response.status === true){

                            $('#productName').html(response.data.name);
                            $('#companyName').html(response.data.company_name);
                            $('#price').text(response.data.price);
                            $('#qty').text(response.data.quantity);
                            $('#size').text(response.data.size);

                            var stock = '';
                            if(response.data.status == 1){
                                stock = '<i style="color: green">In Stock</i>';
                            }else{
                                stock = '<i style="color: red">Out of Stock</i>';
                            }

                            $('#stock').html(stock);
                            
                            
                            $('#product_image').attr('src',response.data.image);

                            $('#exampleModal').show();
                        }else{
                                iziToast.show({
                                title: 'Error :',
                                message: response.message,
                                timeout: 60000,
                                theme: 'dark',
                                position: 'bottomRight',
                                backgroundColor: '#ff5050',
                            });
                        }
                    }
                })
            }

            $('.close').click(function(){
                $('#exampleModal').hide();
            });
        </script>

    </body>

</html>